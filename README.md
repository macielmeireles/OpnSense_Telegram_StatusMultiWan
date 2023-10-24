# OpnSense Multi-WAN Gateway Status <br />
######################################################################## <br />
(En) OpnSense Multi-WAN Gateway Status <br />
######################################################################## <br />

This script is a PHP-based gateway monitoring tool designed for use with the opnSense firewall. It monitors the status of multiple gateways and sends notifications via Telegram when the status changes. Here’s a brief overview of its functionality: <br />

Gateway Monitoring: The script monitors the status of each gateway and assigns a status code based on its current state. It supports up to four gateways. <br />

Status Tracking: The script tracks the status of each gateway and compares it with the previous state. If there’s a change in status, it triggers a notification. <br />

Telegram Integration: The script integrates with Telegram via the sendTelegram.sh script. It sends a message to a specified Telegram group whenever there’s a change in gateway status. <br />

Customization: The script allows for customization such as setting the polling interval for monitoring, enabling email notifications, and more. <br />

Exit Status: The script provides an exit status that can be used by other programs or scripts to take further action based on the gateway statuses. <br />

Please note that you need to manually set the bot token and group ID in the sendTelegram.sh file for the Telegram integration to work. You can obtain these from your Telegram bot and group settings respectively. <br />

For more details on how to get your bot token in Telegram or how to get your chat ID in Telegram, you can refer to these links. <br />


# Installation Guide (English)

**1. Download Files and Set Permissions:**
- **1.1 Download Files:** Download the main files, `gateway_multiwan` and `sendTelegram.sh`, and save them in the default service Monit folder at `/usr/local/opnsense/scripts/OPNsense/Monit`.
    - **a. gateway_multiwan:** This is a PHP code responsible for executing the monitoring.
    - **b. sendTelegram.sh:** This is responsible for the script's communication with the API.
- **1.2 Set Permissions:** After downloading, place the files in the Monit service folder with +x permission using the command `chmod +x gateway_multiwan sendTelegram.sh`.

**2. Telegram Steps:**
- **2.1 Create a Telegram Group:** Open the Telegram app and tap on the pencil icon to write a new message. Select "New Group" and choose the contacts you want to invite. Customize the group's name and photo, then tap "Create".
- **2.2 Create a Telegram Bot:** Open a chat with "BotFather", the official Telegram bot. Type "/newbot" to start creating the bot. Choose a name for the bot and a username that ends with "bot", without spaces⁴.
- **2.3 Add Bot to Group:** Go to the group and tap on the top bar to access options. Find and select "Add Members". Search for your bot in the contact list and add it to the group⁸.
- **2.4 Add Yourself to Group:** Go to the group and tap on the top bar to access options. Find and select "Add Members". Search for your contact in the list and add it to the group.

**3. Setup sendTelegram.sh file:**
- **3.1 Configure Token and Group ID:** Open `sendTelegram.sh` in a text editor. Locate lines where token and group ID are set, usually identified by variables like `TOKEN` and `CHAT_ID`. Replace existing values with information you obtained from BotFather and your Telegram group⁹.

**4. Enable Monit Service (opnSense):**
- **4.1 Enable Monit:** Access opnsense, go to Services, Monit, Services, and click on enable monit.
- **4.2 Set Polling Interval:** Change the Polling Interval to a value you prefer for monitoring, I suggest 10 seconds (just type 10).

**5. Enable Script (no opnSense):**
- **5.1 Duplicate Item:** Go to Service Settings, find and select the item gateway_alert, then click on the icon on its right side to duplicate it.
- **5.2 Enable Service Checks:** Click on enable service checks.
- **5.3 Set Name:** In the name field, type a name, for example: "gateway_multiwan".
- **5.4 Set Path:** In the path field, replace "gateway_alert" with "gateway_multiwan", so it becomes: `/usr/local/opnsense/scripts/OPNsense/Monit/gateway_multiwan`.
- **5.5 Set Tests:** In Tests field, uncheck "NonZeroStatus" and check "ChangedStatus".
- **5.6 Save & Apply:** Save your changes and apply them.

For more details on how to get your bot token in Telegram⁴ or how to get your chat ID in Telegram⁸, you can refer to these links.

(1) How to Generate a Token for Telegram Bot API | Geek Culture - Medium. https://medium.com/geekculture/generate-telegram-token-for-bot-api-d26faf9bf064 <br />
(2) How to Find a Chat ID in Telegram - Alphr. https://www.alphr.com/find-chat-id-telegram/ <br />
(3) How to obtain Telegram chat_id for a specific user?. https://stackoverflow.com/questions/31078710/how-to-obtain-telegram-chat-id-for-a-specific-user <br />
(4) How To Create Telegram Bot Step by Step | Part1:bot token. https://www.youtube.com/watch?v=aNmRNjME6mE <br />
(5) How to get Telegram Bot Token. https://www.youtube.com/watch?v=MZixi8oIdaA <br />
(6) Get Telegram bot token. https://www.youtube.com/watch?v=a5_KFJkor9U <br />
(7) How to get Telegram bot API token | SiteGuarding. https://www.siteguarding.com/en/how-to-get-telegram-bot-api-token <br />
(8) How to get a Telegram API token using the BotFather? - Zoho Corporation. https://help.zoho.com/portal/en/kb/desk/support-channels/instant-messaging/telegram/ articles/telegram-integration-with-zoho-desk <br />
(9) Get access token to connect Telegram bot - Bitrix24. https://helpdesk.bitrix24.com/open/17622486/ <br />
(10) How to Know Chat ID on Telegram on Android (with Pictures) - wikiHow. https://www.wikihow.com/Know-Chat-ID-on-Telegram-on-Android.  <br />
  

######################################################################## <br />
(pt-BR) - Status de Gateway Multi-WAN do OpnSense <br />
######################################################################## <br />

O que faz: Este script monitora o status de gateways em um firewall OPNsense com múltiplas conexões WAN. Ele gera um código de saída com base na combinação de status do gateway. Também fornece um resumo de todos os gateways no final. <br />
Como funciona: O script usa a API do OPNsense para obter o status dos gateways. Ele então gera um código de saída com base na combinação de status do gateway. O código de saída é: <br />
0: todos os gateways estão online <br />
1: um ou mais gateways estão com perda de pacotes <br />
2: um ou mais gateways estão offline <br />
Saída: O script imprime o status de cada gateway, seguido pelo código de saída. <br />
Método de instalação está escrito em ingles na parte superior. <br />

O método de instalação do script está descrito em inglês na parte superior