#!/bin/bash
#
#Script para transferencia de backup SiGTI
#Author:99.2429.91 Lucio ALEXANDRE Correia dos Santos
#RSync utilizando chaves de criptografia para autenticacao
#RSync utilizando modo "pull"
#

#### DIGITE ABAIXO O CÓDIGO DA OM E A CHAVE DE ACESSO ####
cod_om=83000
chave='OA2AE3RAG3HTYZT5'

#### SELECIONA SRV BACKUP ####
curl --insecure -sS -X POST -H "Content-Type: application/json" \
	-d '{
		"cod_om": "'"$cod_om"'",
		"chave": "'"$chave"'",
		"act": "select_srv_backup"
		}' \
	https://sigti.com3dn.mb/scripts/submit.inc.php > tmp.txt

cat tmp.txt
status=`cat tmp.txt | grep "Erro"`


exit 0