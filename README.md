# OpnSense Multi-WAN Gateway Status
########################################################################
(En) OpnSense Multi-WAN Gateway Status
########################################################################

What it does: This script monitors the status of gateways in an OPNsense firewall with multiple WAN connections. It generates an exit code based on the combination of gateway statuses. It also provides a summary of all gateways at the end.
How it works: The script uses the OPNsense API to get the status of the gateways. It then generates an exit code based on the combination of gateway statuses. The exit code is:
0: all gateways are online
1: one or more gateways are experiencing packet loss
2: one or more gateways are offline
Output: The script prints the status of each gateway, followed by the exit code.
Installation method will be described soon

The installation method for the script will be described soon.

########################################################################
(pt-BR) - Status de Gateway Multi-WAN do OpnSense
########################################################################

O que faz: Este script monitora o status de gateways em um firewall OPNsense com múltiplas conexões WAN. Ele gera um código de saída com base na combinação de status do gateway. Também fornece um resumo de todos os gateways no final.
Como funciona: O script usa a API do OPNsense para obter o status dos gateways. Ele então gera um código de saída com base na combinação de status do gateway. O código de saída é:
0: todos os gateways estão online
1: um ou mais gateways estão com perda de pacotes
2: um ou mais gateways estão offline
Saída: O script imprime o status de cada gateway, seguido pelo código de saída.
Método de instalação será descrito em breve

O método de instalação do script será descrito em breve.
