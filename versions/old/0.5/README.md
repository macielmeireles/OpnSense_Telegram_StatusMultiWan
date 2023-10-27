README.md

#########################$$$$$$$$$$$$################################################## <br />
(En) Multi-WAN Gateway Monitoring with Telegram Notifications                           <br />
#########################$$$$$$$$$$$$################################################## <br />
This PHP-based script is a gateway monitoring tool tailored for the opnSense firewall. It provides the following functionalities:
This project consists of two files that monitor the status of gateways in OPNsense and send alerts to your Telegram account.

- **Gateway Monitoring**: Monitors up to four gateways, assigning a status code based on the current state of each.
- **Status Tracking**: Tracks each gateway's status, comparing it to its previous state. Triggers a notification if a change in status is detected.
- **Telegram Integration**: Integrates with Telegram via the `sendTelegram.sh` script. Sends a message to a specified Telegram group when a change in gateway status occurs.
- **Customization**: Allows customization such as setting the monitoring polling interval, enabling email notifications, and more.
- **Exit Status**: Provides an exit status that can be utilized by other programs or scripts for further action based on the gateway statuses.

Please note, set bot token and group ID in `sendTelegram.sh` for Telegram integration. Obtain these from your Telegram settings. Refer to provided links for more details.< /br>

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

**2. Telegram Steps:**
 - **2.1 Create Group: In Telegram, create a new group.
 - **2.2 Create Bot: Start a chat with "BotFather" and create a new bot.
 - **2.3 Record Bot Token: Record the bot token, open a bot chat from url and click "Start" .
 - **2.4 Add Bot and Yourself to Group: Add both the bot and yourself to your Telegram group.
 - **2.5 Get Group ID: Access your group via a web browser and get the group ID from the URL.

**3. Configuring sendTelegram.sh:**

- **3.1 Open File:** Open sendTelegram.sh in a text editor (for example: vi or nano).
- **3.2 Update Token and Chat ID:** Locate the lines where the token and group ID are set, represented by variables `TOKEN` and `CHAT_ID`. Substitute the existing values with the token and chat ID you obtained from BotFather and your Telegram group.
This way, we’ve combined steps 2.6, 3.2, and 3.3 into a single step (3.2) for efficiency.

 
**4. Enable Monit Service (opnSense):**
- **4.1 Enable Monit:** Access opnsense, go to Services, Monit, Services, and click on enable monit.
- **4.2 Set Polling Interval:** Change the Polling Interval to a value you prefer for monitoring, I suggest 10 seconds (just type 10).

**5. Enable Script (no opnSense):**
- **5.1 Duplicate Item: Go to Service Settings, find and select the item gateway_alert, then click on the icon on its right side to duplicate it.
- **5.2 Enable Service Checks: Click on enable service checks.
- **5.3 Set Name: In the name field, type a name, for example: “gateway_multiwan”.
- **5.4 Set Path: In the path field, replace “gateway_alert” with “gateway_multiwan”, so it becomes: /usr/local/opnsense/scripts/OPNsense/Monit/gateway_multiwan.
- **5.5 Set Tests: In Tests field, uncheck “NonZeroStatus” and check “ChangedStatus”.
- **5.6 Save & Apply: Save your changes and apply them.
