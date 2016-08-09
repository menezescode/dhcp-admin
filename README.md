# Projeto DW - dhcp-admin

## Equipe:
* André Henrique Sousa de Menezes - 20131380324
* Igor de Sousa Dantas - 20131380120

## Descrição do Projeto:

O projeto consiste na criação de uma interface web para gerenciar o software isc-dhcp-server.
A iterface, chamada de webdhcp-admin, poderá ser acessada por 2 tipos de usuários: admin e user. 
Sendo o usuário admin aquele responsável pelas seguintes configurações do serviço DHCP:
* Configurações de domínio;
* Configurações de dns;
* Tempo de empréstimo padrão;
* Tempo máximo de empréstimo;
* Escopo DHCP.

Todas as configurações serão feitas na página dashboard admin.
A segunda página principal é a dashboard user, ambos admin e user terão acesso a página que irá dispor de informações relacionadas ao serviço dhcp:
* Vizualização das configurações;
* Vizualiação de gráficos:
  - Consumo do dhcp;
  - IPs concedidos;
  - Gráfico de emprestimo/tempo;

## O projeto se baseia nos seguintes templates:
![ProNMS](http://www.pronms.com/en-us/wp-content/uploads/2013/07/Windows-DHCP-Log-Analyser-Dashboard.png)
![SecurityCenter](https://www.tenable.com/sites/drupal.dmz.tenablesecurity.com/files/images/sc-dashboards/Screen%20Shot%202014-08-14%20at%202.14.41%20PM_0.png)
![Splunk](https://cdn.apps.splunk.com/media/public/screenshots/6d690a3a-6900-11e3-b4de-005056ad5c72.png)
