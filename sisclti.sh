#/bin/bash
#!/bin/bash

###
#
#Author: Lucio Alexandre Correia dos Santos 99.2429.91
#Title: SisCLTI - sisclti.sh
#
##

#Verifica execução com usuário administrador(root)
if [[ $EUID -ne 0 ]]; then

	whiptail --title "ERRO" --msgbox "Este script deve ser executado como root. 
		Cancelando a instalação. Clique em OK para continuar." 8 78
	exit 1
fi

#Executa o loading
bash loading.sh

#Solicita continuar com a instalação
if whiptail \
   --title 'SISCLTI' \
   --yesno '\n     
CONFIGURAÇÃO DO SERVIDOR WEB COM POSTGRESQL\n\n
             DESEJA CONTINUAR?' 0 0

#Continuando a configuração do servidor web
then

#Instalação dos pacotes necessários
yum group install -y "Servidor de Web Básico"
yum -y install postgresql-server
yum -y install php php-mbstring php-gd php-dom php-pgsql

#Inicializando e habilitando os serviços
systemctl start httpd
postgresql-setup initdb
systemctl start postgresql
systemctl enable httpd
systemctl enable postgresql

#Configurando PSQL
echo "local     all     all                 trust" > /var/lib/pgsql/data/pg_hba.conf
echo "host      all     all 127.0.0.1/32    trust" >> /var/lib/pgsql/data/pg_hba.conf
echo "host      all     all ::1/128 trust" >> /var/lib/pgsql/data/pg_hba.conf
systemctl restart postgresql

#Configurando o firewall e o SELinux
firewall-cmd --add-service=http
firewall-cmd --add-service=http --permanent
firewall-cmd --add-port=443/tcp
firewall-cmd --add-port=443/tcp --permanent
setsebool -P httpd_can_network_connect 1
setsebool -P httpd_can_network_connect_db 1

#Solicita nome de usuário para banco de dados
while [ true ]
do
	BDUSR=$(whiptail --title "Usuário do Banco de Dados" --inputbox "Informe um usuário para o banco de dados do SisCLTI" 10 60  3>&1 1>&2 2>&3)
	exitstatus=$?
	if [ $exitstatus = 1 ]; then
		echo "Cancelado."
		exit
	fi
	BDUSR=$(echo "$BDUSR" | sed 's/ //g')
	BDUSR=$(echo $BDUSR | tr '[:upper:]' '[:lower:]')
	if [ "${#BDUSR}" -ge 5 ]; then 
		if (whiptail --title "Confirmação do Usuário do Banco de Dados" --yesno "Usuário do Banco de Dados: "$BDUSR 8 78) then
    		break	
		fi
	else
		whiptail --title "ERRO" --msgbox "Usuário do Banco de Dados inválido. Clique em OK para continuar." 8 78
	fi

done

#Solicita senha para o usuário criado do banco de dados para o SisCLTI
while [ true ]
do
	BDPWS=$(whiptail --title "Senha para o Usuário Criado" --inputbox "Informe a senha para o usuário criado para o SisCLTI" 10 60  3>&1 1>&2 2>&3)
	exitstatus=$?
	if [ $exitstatus = 1 ]; then
		echo "Cancelado."
		exit
	fi
	BDPWS=$(echo "$BDPWS" | sed 's/ //g')
	BDPWS=$(echo $BDPWS | tr '[:upper:]' '[:lower:]')
	if [ "${#BDPWS}" -ge 5 ]; then 
		if (whiptail --title "Confirmação da Senha" --yesno "Senha do Usuário: "$BDPWS 8 78) then
    		break	
		fi
	else
		whiptail --title "ERRO" --msgbox "Senha do Usuário inválida. Clique em OK para continuar." 8 78
	fi

done

#Solicita URL/IP do SisCLTI
while [ true ]
do
	URLIP=$(whiptail --title "URL/IP do Servidor" --inputbox "Informe a URL ou End. IP do SisCLTI (SEM HTTP://)" 10 60  3>&1 1>&2 2>&3)
	exitstatus=$?
	if [ $exitstatus = 1 ]; then
		echo "Cancelado."
		exit
	fi
	URLIP=$(echo "$URLIP" | sed 's/ //g')
	URLIP=$(echo $URLIP | tr '[:upper:]' '[:lower:]')
	if [ "${#URLIP}" -ge 5 ]; then 
		if (whiptail --title "Confirmação da URL/IP" --yesno "URL/IP: "$URLIP 8 78) then
    		break	
		fi
	else
		whiptail --title "ERRO" --msgbox "URL/IP inválida. Clique em OK para continuar." 8 78
	fi

done

#Executando configuração do banco de dados PostgreSQL
psql -c "CREATE ROLE $BDUSR" -U postgres
psql -c "ALTER ROLE $BDUSR WITH SUPERUSER INHERIT NOCREATEROLE CREATEDB LOGIN PASSWORD '$BDPWS'" -U postgres
psql -c "CREATE DATABASE db_clti WITH TEMPLATE=template0 ENCODING='UTF8' LC_COLLATE='pt_BR.UTF-8' LC_CTYPE='pt_BR.UTF-8'" -U postgres
psql -c "ALTER DATABASE db_clti OWNER TO $BDUSR" -U postgres
psql -c "CREATE SCHEMA db_clti" -U postgres
psql -c "ALTER SCHEMA db_clti OWNER TO $BDUSR" -U postgres
echo "UPDATE db_clti.tb_config SET valor='http://$URLIP/sisclti' WHERE parametro='URL' " >> db_clti.sql
psql -U postgres -d db_clti < db_clti.sql

#Copia SisCLTI
cp -r $PWD/ /var/www/html/sisclti

#Configurações inciciais do sistema
sed -i "s/db_user/$BDUSR/g" /var/www/html/sisclti/class/config.php
sed -i "s/db_passwd/$BDPWS/g" /var/www/html/sisclti/class/config.php

exit 0

#Interrompendo a configuração caso selecione não no início
else
	exit
fi

