# Donation:

(En)      Support our project via Pix or PayPal. <br />
(Pt-Br) Apoie nosso projeto via Pix ou PayPal: <br />

(1) Brazilian Pix: d56da244-4dc5-4f77-be6d-28e94fdd46b2 <br />
(2) Paypal:  https://bit.ly/MonitTelegram <br /><br />


# (En) OPNsense Multiwan Gateway Monitor & Alert Script via Telegram

## Overview
This project provides two scripts for monitoring the status of gateways in OPNsense and sending alerts to Telegram.

The `gateway_multiwan` script monitors the `offline`, `packet loss`, `online`, or `unknown` status of all gateways found in opnSense. If any of them change, it sends an alert using the `sendTelegram.sh` file to a group, via a Telegram bot. If the SMTP alert is configured, it will also be sent to your email. For it to work, the script needs to be added to your opnSense and set up to be executed and triggered by events through the already included package called Monit.


## Requirements
- Download the two files from this GitHub repository (stable version) to your machine with OPNsense
- OPNsense Firewall
- Telegram Account
- Shell Script


## Quick Installation Guide
1. Download Files
2. Set Permissions
3. Configure Telegram
4. Edit `sendTelegram.sh`
5. Enable Monit Service
6. Enable Script

## Detailed Installation Guide

Inicia aqui:

Detailed Installation Guide<br />
1. Download Files on SSH Terminal:<br />
   1.1 Navigate to the Monit service folder: `cd /usr/local/opnsense/scripts/OPNsense/Monit`<br />
   1.2 Use fetch to download "gateway_multiwan" and "sendTelegram.sh' from GitHub:<br /> 
      `fetch https://github.com/macielmeireles/opnsense_gateways_status/blob/main/versions/stable/0.6/gateway_multiwan && fetch https://github.com/macielmeireles/opnsense_gateways_status/blob/main/versions/stable/0.6/sendTelegram.sh`<br />

2. Set Permissions:<br />
   2.1 Set +x permission on the files:<br /> `chmod +x gateway_multiwan sendTelegram.sh`<br />

3. Telegram Configuration:<br />
   3.1 Create a Telegram group.<br />
   3.2 Create a bot with "BotFather".<br />
   3.3 Note down the bot token.<br />
   3.4 Add the bot and yourself to the group.<br />
   3.5 Get the group ID from the URL.<br />

4. Configure sendTelegram.sh:<br />
   4.1 Open sendTelegram.sh in a text editor.<br />
   4.2 Update TOKEN and CHAT_ID with your bot token and group ID.<br />

5. Enable Monit Service:<br />
   5.1 In OPNsense, go to Services > Monit > Services and click on Enable Monit.<br />
   5.2 Set your preferred polling interval.<br />

6. Enable Script:<br />
   6.1 In OPNsense, go to Services > Monit > Services and click on Duplicate.<br />
   6.2 In the Duplicate Item dialog box, enter a name for the new service, such as "gateway_multiwan".<br />
   6.3 In the Path field, enter the path to the shell script, such as `/usr/local/opnsense/scripts/OPNsense/Monit/gateway_multiwan`.<br />
   6.4 In Tests field, uncheck "NonZeroStatus" and check "ChangedStatus".<br />
   6.5 Click Save and Apply.<br />

Testing the Script<br />
To test the script, manually disable a WAN link in OPNsense. You should receive a Telegram alert.<br />

For more details on how to get your bot token in Telegram[^1^][2] or how to get your chat ID in Telegram, you can refer to these links.<br />

<sub>(1) How to Generate a Token for Telegram Bot API | https://medium.com/geekculture/generate-telegram-token-for-bot-api-d26faf9bf064</sub> <br />
<sub>(2) How to Find a Chat ID in Telegram | https://www.alphr.com/find-chat-id-telegram/ </sub> <br />
  


##


# (pt-br) Script de Monitoramento Multiwan Gateway no OPNsense e alerta via Telegram

## Visão Geral
Este projeto fornece dois arquivos para monitorar o status dos gateways no OPNsense e enviar alertas para o Telegram. 

O script `gateway_multiwan` monitora os status `offline`, `perda de pacote`, `online` ou `desconhecido` de todos os gateways encontrados no opnSense. 
Se algum deles mudar, ele envia um alerta usando o arquivo `sendTelegram.sh` para um grupo, via um bot do Telegram.
Caso o alerta SMTP esteja configurado, também será enviado para seu e-mail.
Para funcionar, o script precisa ser adicionado em seu opnSense e para ser executado e acionado por eventos através do pacote já incluído chamado Monit.

## Requisitos
- Firewall OPNsense
- Conta do Telegram
- Acesso ao Shell
- Baixe os dois arquivos deste repositório do GitHub (versão `stable`) para sua máquina com OPNsense

## Guia de Instalação Rápida
1. Baixar Arquivos
2. Definir Permissões
3. Configurar Telegram
4. Editar `sendTelegram.sh`
5. Habilitar Serviço Monit
6. Habilitar Script

## Guia de Instalação Detalhada

**1. Baixar Arquivos:**
   1.1 Navegue até a pasta do serviço Monit:
     ```
     cd /usr/local/opnsense/scripts/OPNsense/Monit
     ```
   1.2 Use `fetch` para baixar `gateway_multiwan` e `sendTelegram.sh` do GitHub:
     ```
     fetch https://github.com/macielmeireles/opnsense_gateways_status/blob/main/versions/stable/0.6/gateway_multiwan && fetch https://github.com/macielmeireles/opnsense_gateways_status/blob/main/versions/stable/0.6/sendTelegram.sh
     ```

**2. Definir Permissões:**
   2.1 Defina a permissão +x nos arquivos:
     ```
     chmod +x gateway_multiwan sendTelegram.sh
     ```

**3. Configuração do Telegram:**
   3.1 Crie um grupo no Telegram.
   3.2 Crie um bot com o "BotFather".
   3.3 Anote o token do bot.
   3.4 Adicione o bot e você mesmo ao grupo.
   3.5 Obtenha o ID do grupo a partir da URL.

**4. Configurar sendTelegram.sh:**
   4.1 Abra `sendTelegram.sh` em um editor de texto.
   4.2 Atualize `TOKEN` e `CHAT_ID` com o token do seu bot e ID do grupo.

**5. Habilitar Serviço Monit:**
   5.1 No OPNsense, vá para Serviços > Monit > Serviços e clique em Habilitar Monit.
   5.2 Defina seu intervalo de sondagem preferido.

**6. Habilitar Script:**
   6.1 No OPNsense, vá para Serviços > Monit > Serviços e clique em Duplicar.
   6.2 Na caixa de diálogo Item duplicado, insira um nome para o novo serviço, como "gateway_multiwan".
   6.3 No campo Caminho, insira o caminho para o script shell, como `/usr/local/opnsense/scripts/OPNsense/Monit/gateway_multiwan`.
   6.4 No campo Testes, desmarque "NonZeroStatus" e marque "ChangedStatus".
   6.5 Clique em Salvar e Aplicar.

## Testando o Script
Para testar o script, desabilite manualmente um link WAN no OPNsense. Você deve receber um alerta no Telegram.








< /br>< /br>< /br>< /br>
######################################################################## <br />
(pt-BR) - ANTIGA DESCRICAO - Status de Gateway Multi-WAN do OpnSense <br />
######################################################################## <br />

O que faz: Este script monitora o status de gateways em um firewall OPNsense com múltiplas conexões WAN. Voce pode notificar por e-mail configurrando o smtp ou o telegram através do sendTelegram.sh.<
Ele gera um código de saída com base na combinação de status do gateway. Também fornece um resumo de todos os gateways no final. <br />
Como funciona: O script usa a API do OPNsense para obter o status dos gateways. Ele então gera um código de saída com base na combinação de status do gateway. O código de saída é: <br />
0: todos os gateways estão online <br />
1: um ou mais gateways estão com perda de pacotes <br />
2: um ou mais gateways estão offline <br />
Saída: O script imprime o status de cada gateway, seguido pelo código de saída. <br />
Método de instalação está escrito em ingles na parte superior. <br />

O método de instalação do script está descrito em inglês na parte superior
