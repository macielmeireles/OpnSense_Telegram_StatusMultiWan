#!/usr/local/bin/php
<?php

/**
 * Author: Maciel Meireles
 * Date: 19/10/2023
 * Version: 0.6 (beta)
 * Description: Monitors gateway statuses (up to 4) and generates an exit code based on the combination of gateway statuses. It also provides a summary of all gateways at the end.
 * Credits: Luciano Rodrigues (pfSense Ninja Course).
 */

define("MAX_GATEWAYS", 4);
define("EXIT_CODE_TOO_MANY_GATEWAYS", 256);
define("SHOW_DETAILS", true);
define("SEND_TELEGRAM", true);

// Set to use icons instead of text for status
define("USE_ICONS", true);

// Define symbols for each status
define("STATUS_ICON_ONLINE", "🟢");
define("STATUS_ICON_PACKET_LOSS", "🟡");
define("STATUS_ICON_OFFLINE", "🔴");
define("STATUS_ICON_UNKNOWN", "❓");

// Define the path to the sendTelegram.sh script
define("TELEGRAM_SCRIPT_PATH", "/usr/local/opnsense/scripts/OPNsense/Monit/sendTelegram.sh");

// Array of gateways to be ignored in monitoring
$ignoredGateways = ["NOME_DO_GATEWAY_PARA_IGNORAR"];

require_once('config.inc');
require_once('interfaces.inc');
require_once('util.inc');

$gatewayStatuses = getGatewayStatuses();
$statusNumeric = getStatusNumeric($gatewayStatuses);
$statusBinary = getStatusBinary($gatewayStatuses);
$statusExit = bindec($statusBinary);

// Remove ignored gateways from the status calculation
foreach ($ignoredGateways as $ignoredGateway) {
    if (array_key_exists($ignoredGateway, $gatewayStatuses)) {
        unset($gatewayStatuses[$ignoredGateway]);
    }
}

// Lock file for reading and writing
$lockFile = fopen(__DIR__ . '/last_status.txt', 'c+');
if (flock($lockFile, LOCK_EX)) {
    $lastStatusExit = intval(fread($lockFile, 1024));

    if ($lastStatusExit !== $statusExit || !file_exists(__DIR__ . '/last_status.txt')) {
        sendTelegram($statusNumeric, $statusBinary, $statusExit, $gatewayStatuses);
        fseek($lockFile, 0);
        // Store the variable name and value for statusExit
        fwrite($lockFile, "statusExit=" . $statusExit);
        // Store the names of gateways and their current statuses
        foreach ($gatewayStatuses as $gateway => $details) {
            fwrite($lockFile, "\n{$gateway}={$details['status']}");
        }
    }

    flock($lockFile, LOCK_UN);
}

fclose($lockFile);

printStatusCodes($statusNumeric, $statusBinary, $statusExit, $gatewayStatuses);

function getGatewayStatuses() {
    $gatewayStatuses = return_gateways_status(true);

    if (count($gatewayStatuses) > MAX_GATEWAYS) {
        echo "More than " . MAX_GATEWAYS . " gateways are not supported by this script.";
        exit(EXIT_CODE_TOO_MANY_GATEWAYS);
    }

    return $gatewayStatuses;
}

function getStatusNumeric($gatewayStatuses) {
    $statusNumeric = "";
    foreach ($gatewayStatuses as $status) {
        $statusNumeric .= getStatusNumber($status['status']);
    }

    return $statusNumeric;
}

function getStatusBinary($gatewayStatuses) {
    $statusBinary = "";
    foreach ($gatewayStatuses as $status) {
        $statusBinary .= getStatusBinaryCode($status['status']);
    }

    return $statusBinary;
}

function getStatusNumber($status) {
    $statusMapping = [
        'none' => '0',
        'loss' => '1',
        'down' => '2',
    ];

    return $statusMapping[$status] ?? '3';
}

function getStatusBinaryCode($status) {
    $statusMapping = [
        'none' => '00',
        'loss' => '01',
        'down' => '10',
    ];

    return $statusMapping[$status] ?? '11';
}

function translateStatusNumeric($statusNumeric) {
    // Using icons instead of text for status
    if (USE_ICONS) {
        $statusTranslation = [
            '0' => STATUS_ICON_ONLINE,
            '1' => STATUS_ICON_PACKET_LOSS,
            '2' => STATUS_ICON_OFFLINE,
        ];
    } else {
        // Using default text for status
        $statusTranslation = [
            '0' => 'online',
            '1' => 'packet loss',
            '2' => 'offline',
        ];
    }

    return $statusTranslation[$statusNumeric] ?? STATUS_ICON_UNKNOWN;
}

function printStatusCodes($statusNumeric, $statusBinary, $statusExit, $gatewayStatuses) {
    if (SHOW_DETAILS) {
        foreach ($gatewayStatuses as $gateway => $details) {
            echo "{$gateway}: " . translateStatusNumeric(getStatusNumber($details['status'])) . "\n";
        }
    }

    echo "\n";

    echo "Exit Status: {$statusExit}\n";
}

function sendTelegram($statusNumeric, $statusBinary, $statusExit, $gatewayStatuses) {
    // Create a message with the status of each gateway
    $message = "Gateway Status\n";

    foreach ($gatewayStatuses as $gateway => $details) {
        $message .= "{$gateway}: " . translateStatusNumeric(getStatusNumber($details['status'])) . "\n";
    }

    // Add the exit status to the message
    $message .= "\n";

    // Send the message using the Telegram script
    shell_exec(TELEGRAM_SCRIPT_PATH . " \"$message\"");
}

function getLastStatusExit() {
    if (file_exists(__DIR__ . '/last_status.txt')) {
        return file_get_contents(__DIR__ . '/last_status.txt');
    } else {
        return null;
    }
}

?>
