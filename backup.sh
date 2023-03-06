#!/bin/bash
echo "Executando o Backup"
#
#Script para transferencia de backup
#Author:99.2429.91 Lucio ALEXANDRE Correia dos Santos
#RSync utilizando chaves de criptografia para autenticacao
#RSync utilizando modo "pull"
#

#VARIAVEIS UTILIZADAS

#IP CLTI-COM3DN1
IPCLTICOM3DN1="172.23.116.20"

#IP CLTI-COM3DN2
IPCLTICOM3DN2="172.23.116.21"

#IP BNN1
IPBNN1="172.23.116.10"

#IP COM3DN1
IPCOM3DN1="172.23.116.11"

#IP WEB
IPWEB="172.23.116.101"

#IP PDC
IPPDC="172.23.119.2"

#DIR notesdata
NOTESDATA=/local/notesdata

#DIR clti-com3dn1 bk01
CLTICOM3DN1=/home/clticom3dn1

#DIR clti-com3dn2 bk01
CLTICOM3DN2=/home/clticom3dn2

#DIR com3dn1 bk01
COM3DN1=/home/com3dn1

#DIR bnn1 bk01
BNN1=/home/bnn1

#DIR servidor web bk01
WEB=/home/web

#DIR servidor pdc bk01
PDC=/home/pdc

#Data atual
DATA=`date +%c`

#Variavel com dia da semana 0-6 sendo 0->domingo
DIA=`date +%w`

#Data em formato brasileiro para nomear diretorios e arquivos
DATABR=`date +%d-%m-%Y`

#Diretorio para armazenar o arquivo de log do backup
LOGDIR=/root/log

#VARIAVEL TEMP
TEMP=aplica/sigdem20
#######

#ROTINA DE BACKUP

#Transferindo dados para servidor backup
#Data de inicio da transferencia
DATAINI=`date +%c`

#Preparando arquivo de log
echo "Backup de $DATA" > $LOGDIR/backup.log.txt
echo "Inicio do backup em $DATAINI" >> $LOGDIR/backup.log.txt
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt


#BACKUP SRV ARQUIVOS CLTI PDC
DATALOG=`date +%d-%b-%y-%T`
ssh "root@172.23.116.101" "sed -i 's/inicio1.*inicio1/inicio1>$DATALOG<\/inicio1/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATAINI=`date +%c`
echo "Backup do SAMBA PDC iniciado em $DATAINI" >> $LOGDIR/backup.log.txt
rsync -vcrpt root@$IPPDC:/usr/local/backups $PDC
rsync -vcrpt root@$IPPDC:/home/Dados $PDC
DATAINI=`date +%c`
echo "Backup do SAMBA PDC finalizado em $DATAINI" >> $LOGDIR/backup.log.txt
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATALOG=`date +%d-%b-%y-%T`
DISCO=`du -sh /home/pdc | awk '{print $1}'`
ssh "root@172.23.116.101" "sed -i 's/fim1.*fim1/fim1>$DATALOG<\/fim1/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
ssh "root@172.23.116.101" "sed -i 's/tamanho1.*tamanho1/tamanho1>$DISCO<\/tamanho1/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"


#BACKUP SRV WEB (SOMENTE ARQUIVOS .TAR)
DATALOG=`date +%d-%b-%y-%T`
ssh "root@172.23.116.101" "sed -i 's/inicio6.*inicio6/inicio6>$DATALOG<\/inicio6/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATAINI=`date +%c`
echo "Backup do SERVIDOR WEB iniciado em $DATAINI" >> $LOGDIR/backup.log.txt
scp -r root@$IPWEB:/home/backup/ $WEB
DATAINI=`date +%c`
echo "Backup do SERVIDOR WEB finalizado em $DATAINI" >> $LOGDIR/backup.log.txt
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATALOG=`date +%d-%b-%y-%T`
DISCO=`du -sh /home/web | awk '{print $1}'`
ssh "root@172.23.116.101" "sed -i 's/fim6.*fim6/fim6>$DATALOG<\/fim6/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
ssh "root@172.23.116.101" "sed -i 's/tamanho6.*tamanho6/tamanho6>$DISCO<\/tamanho6/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"


#BACKUP CLTI-COM3DN1
DATALOG=`date +%d-%b-%y-%T`
ssh "root@172.23.116.101" "sed -i 's/inicio4.*inicio4/inicio4>$DATALOG<\/inicio4/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATAINI=`date +%c`
echo "Backup do CLTI-COM3DN1 iniciado em $DATAINI" >> $LOGDIR/backup.log.txt

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/bnnatl/$TEMP/tempbnnatl/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/bnnatl $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/citnat/$TEMP/tempcitnat/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/citnat $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/cpnatl/$TEMP/tempcpnatl/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/cpnatl $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/ermnat/$TEMP/tempermnat/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/ermnat $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/gpndes/$TEMP/tempgpndes/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/gpndes $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/grfnat/$TEMP/tempgrfnat/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/grfnat $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/hosnat/$TEMP/temphosnat/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/hosnat $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/npajau/$TEMP/tempnpajau/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/npajau $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/sindes/$TEMP/tempsindes/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/sindes $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/npauna/$TEMP/tempnpauna/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/npauna $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/npaiba/$TEMP/tempnpaiba/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/npaiba $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/npagoi/$TEMP/tempnpagoi/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/npagoi $CLTICOM3DN1

ssh root@$IPCLTICOM3DN1 "rm -rf $NOTESDATA/nbhaes/$TEMP/tempnbhaes/*"
rsync -vcrpt root@$IPCLTICOM3DN1:$NOTESDATA/nbhaes $CLTICOM3DN1

DATAINI=`date +%c`
echo "Backup do CLTI-COM3DN1 finalizado em $DATAINI" >> $LOGDIR/backup.log.txt
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATALOG=`date +%d-%b-%y-%T`
DISCO=`du -sh /home/clticom3dn1 | awk '{print $1}'`
ssh "root@172.23.116.101" "sed -i 's/fim4.*fim4/fim4>$DATALOG<\/fim4/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
ssh "root@172.23.116.101" "sed -i 's/tamanho4.*tamanho4/tamanho4>$DISCO<\/tamanho4/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"


#BACKUP CLTI-COM3DN2
DATALOG=`date +%d-%b-%y-%T`
ssh "root@172.23.116.101" "sed -i 's/inicio5.*inicio5/inicio5>$DATALOG<\/inicio5/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATAINI=`date +%c`
echo "Backup do CLTI-COM3DN2 iniciado em $DATAINI" >> $LOGDIR/backup.log.txt
ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/agbran/$TEMP/tempagbran/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/agbran $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/agcati/$TEMP/tempagcati/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/agcati $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/agnedo/$TEMP/tempagnedo/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/agnedo $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/agocim/$TEMP/tempagocim/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/agocim $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/cpceio/$TEMP/tempcpceio/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/cpceio $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/cpcife/$TEMP/tempcpcife/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/cpcife $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/cpftza/$TEMP/tempcpftza/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/cpftza $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/cpssoa/$TEMP/tempcpssoa/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/cpssoa $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/eamftz/$TEMP/tempeamftz/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/eamftz $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/eamrcf/$TEMP/tempeamrcf/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/eamrcf $CLTICOM3DN2

ssh root@$IPCLTICOM3DN2 "rm -rf $NOTESDATA/hosrcf/$TEMP/temphosrcf/*"
rsync -vcrpt root@$IPCLTICOM3DN2:$NOTESDATA/hosrcf $CLTICOM3DN2

DATAINI=`date +%c`
echo "Backup do CLTI-COM3DN2 finalizado em $DATAINI" >> $LOGDIR/backup.log.txt
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATALOG=`date +%d-%b-%y-%T`
DISCO=`du -sh /home/clticom3dn2 | awk '{print $1}'`
ssh "root@172.23.116.101" "sed -i 's/fim5.*fim5/fim5>$DATALOG<\/fim5/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
ssh "root@172.23.116.101" "sed -i 's/tamanho5.*tamanho5/tamanho5>$DISCO<\/tamanho5/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"


#BACKUP BNN1 (CORREIOS)
DATALOG=`date +%d-%b-%y-%T`
ssh "root@172.23.116.101" "sed -i 's/inicio3.*inicio3/inicio3>$DATALOG<\/inicio3/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATAINI=`date +%c`
echo "Backup do BNN1 (CORREIOS) iniciado em $DATAINI" >> $LOGDIR/backup.log.txt
rsync -vcrpt root@$IPBNN1:$NOTESDATA/agbran/mail $BNN1/agbran
rsync -vcrpt root@$IPBNN1:$NOTESDATA/agcati/mail $BNN1/agcati
rsync -vcrpt root@$IPBNN1:$NOTESDATA/agnedo/mail $BNN1/agnedo
rsync -vcrpt root@$IPBNN1:$NOTESDATA/agocim/mail $BNN1/agocim
rsync -vcrpt root@$IPBNN1:$NOTESDATA/bnnatl/mail $BNN1/bnnatl
rsync -vcrpt root@$IPBNN1:$NOTESDATA/citnat/mail $BNN1/citnat
rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpceio/mail $BNN1/cpceip
rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpcife/mail $BNN1/cpcife
rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpftza/mail $BNN1/cpftza
rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpnatl/mail $BNN1/cpnatl
rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpssoa/mail $BNN1/cpssoa
rsync -vcrpt root@$IPBNN1:$NOTESDATA/eamftz/mail $BNN1/eamftz
rsync -vcrpt root@$IPBNN1:$NOTESDATA/eamrcf/mail $BNN1/eamrcf
rsync -vcrpt root@$IPBNN1:$NOTESDATA/ermnat/mail $BNN1/ermnat
rsync -vcrpt root@$IPBNN1:$NOTESDATA/gpndes/mail $BNN1/gpndes
rsync -vcrpt root@$IPBNN1:$NOTESDATA/grfnat/mail $BNN1/grfnat
rsync -vcrpt root@$IPBNN1:$NOTESDATA/hosnat/mail $BNN1/hosnat
rsync -vcrpt root@$IPBNN1:$NOTESDATA/hosrcf/mail $BNN1/hosrcf
rsync -vcrpt root@$IPBNN1:$NOTESDATA/nbhaes/mail $BNN1/nbhaes
rsync -vcrpt root@$IPBNN1:$NOTESDATA/npacau/mail $BNN1/npacau
rsync -vcrpt root@$IPBNN1:$NOTESDATA/npagoi/mail $BNN1/npagoi
rsync -vcrpt root@$IPBNN1:$NOTESDATA/npaiba/mail $BNN1/npaiba
rsync -vcrpt root@$IPBNN1:$NOTESDATA/npajau/mail $BNN1/npajau
rsync -vcrpt root@$IPBNN1:$NOTESDATA/npauna/mail $BNN1/npauna
rsync -vcrpt root@$IPBNN1:$NOTESDATA/npocar/mail $BNN1/npocar
rsync -vcrpt root@$IPBNN1:$NOTESDATA/rtrnfo/mail $BNN1/rtrnfo
rsync -vcrpt root@$IPBNN1:$NOTESDATA/sindes/mail $BNN1/sindes 
rsync -vcrpt root@$IPBNN1:$NOTESDATA/terdis/mail $BNN1/terdis
rsync -vcrpt root@$IPBNN1:$NOTESDATA/mail $BNN1
rsync -vcrpt root@$IPBNN1:$NOTESDATA/pwn33 $BNN1
DATAINI=`date +%c`
echo "Backup do BNN1 (CORREIOS) finalizado em $DATAINI" >> $LOGDIR/backup.log.txt
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATALOG=`date +%d-%b-%y-%T`
DISCO=`du -sh /home/bnn1 | awk '{print $1}'`
ssh "root@172.23.116.101" "sed -i 's/fim3.*fim3/fim3>$DATALOG<\/fim3/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
ssh "root@172.23.116.101" "sed -i 's/tamanho3.*tamanho3/tamanho3>$DISCO<\/tamanho3/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"

#BACKUP BNN1 (SIGDEM - CPCEIO AINDA NÃO ENCONTRA-SE NO SERVIDOR)
#echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
#DATAINI=`date +%c`
#echo "Backup BNN1 (SIGDEM) iniciado em $DATAINI" >> $LOGDIR/backup.log.txt
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/agbran/aplica $CLTICOM3DN2/agbran
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/agcati/aplica $CLTICOM3DN2/agcati
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/agnedo/aplica $CLTICOM3DN2/agnedo
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/agocim/aplica $CLTICOM3DN2/agocim
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpceio/aplica $CLTICOM3DN2/cpceio
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpcife/aplica $CLTICOM3DN2/cpcife
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpftza/aplica $CLTICOM3DN2/cpftza
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpnatl/aplica $CLTICOM3DN2/cpnatl
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/cpssoa/aplica $CLTICOM3DN2/cpssoa
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/eamftz/aplica $CLTICOM3DN2/eamftz
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/eamrcf/aplica $CLTICOM3DN2/eamrcf
#rsync -vcrpt root@$IPBNN1:$NOTESDATA/hosrcf/aplica $CLTICOM3DN2/hosrcf
#DATAINI=`date +%c`
#echo "Backup do BNN1 (SIGDEM) finalizado em $DATAINI" >> $LOGDIR/backup.log.txt
#echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt


#BACKUP COM3DN1
DATALOG=`date +%d-%b-%y-%T`
ssh "root@172.23.116.101" "sed -i 's/inicio2.*inicio2/inicio2>$DATALOG<\/inicio2/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATAINI=`date +%c`
echo "Backup do COM3DN1 iniciado em $DATAINI" >> $LOGDIR/backup.log.txt

rsync -vcrpt root@$IPCOM3DN1:$NOTESDATA/terdis $COM3DN1

DATAINI=`date +%c`
echo "Backup do COM3DN1 finalizado em $DATAINI" >> $LOGDIR/backup.log.txt
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATALOG=`date +%d-%b-%y-%T`
DISCO=`du -sh /home/com3dn1 | awk '{print $1}'`
ssh "root@172.23.116.101" "sed -i 's/fim2.*fim2/fim2>$DATALOG<\/fim2/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"
ssh "root@172.23.116.101" "sed -i 's/tamanho2.*tamanho2/tamanho2>$DISCO<\/tamanho2/' /home/clti/web/clti.com3dn.mb/public_html/backup/assets/xml/importa.xml"

#Encerrando o script de backup
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
DATABR=`date +%d-%m-%Y`
echo "Backup finalizado em: $DATABR." >> $LOGDIR/backup.log.txt
echo "----------------------------------------------------" >> $LOGDIR/backup.log.txt
exit 0
