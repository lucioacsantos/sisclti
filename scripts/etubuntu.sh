#!/bin/bash

apt update && apt install net-tools curl -y

function interfacesRede(){
	interfaces=`ifconfig | cut -d" " -f1 | cut -d":" -f1 | grep -v "lo" | grep -v "vmnet"`  > /dev/null
	numero=1
	for interfacesNome in $interfaces
	do
		end_ip=`ifconfig $interfacesNome | grep 'inet ' | awk '{print $2}'` > /dev/null
		end_mac=`ifconfig $interfacesNome | grep "ether" | cut -d" " -f10 ` > /dev/null
	done
	hostname=`cat /etc/hostname`
}

function discos(){
	discos=`fdisk -l | grep Disco | grep -v "loop" | cut -d" " -f2 | cut -d"/" -f3| sed 's/://g'| grep -v ram` > /dev/null
	numero=1
	hd=0
	capacidade=0
	for disco in $discos
	do
		echo "Disco $disco "
		capacidade=`fdisk -l | grep Disco | grep -e $disco | cut -d" " -f5` > /dev/null
		escala=`fdisk -l | grep Disco | grep -e $disco | cut -d" " -f4 | sed 's/,//g'` > /dev/null
		giga=$((capacidade/1000000000))
		hd=$((hd+giga))
	done
}

function hardware(){
	distro=`cat /etc/*release | grep DISTRIB_ID | cut -d= -f2` > /dev/null
	versao=`cat /etc/*release | grep DISTRIB_RELEASE | cut -d= -f2` > /dev/null
	proc_fab=`sudo dmidecode -t processor | grep Version | cut -d: -f2 | cut -d" " -f2 | cut -d"(" -f1` > /dev/null
	proc_modelo=`sudo dmidecode -t processor | grep Version | cut -d: -f2 | cut -d" " -f4` > /dev/null
	proc_familia=`sudo dmidecode -t processor | grep Version | cut -d: -f2 | cut -d" " -f3` > /dev/null
	clock=`dmidecode -t processor | grep "Current Speed" | cut -d: -f2 | cut -d" " -f2` > /dev/null
	cores=`dmidecode -t processor | grep "Core Count:" | cut -d: -f2` > /dev/null
	threads=`dmidecode -t processor | grep "Core Count:" | cut -d: -f2` > /dev/null
	memoria=`free --giga | grep 'Mem.:' | awk '{print $2}'` > /dev/null
	tipo_memoria=`dmidecode -t memory | grep Type: | grep -v Error | grep -v Unknown | head -1 | cut -d" " -f2` > /dev/null
	velocidade=`dmidecode -t memory | grep MT/s | head -1 | cut -d" " -f2` > /dev/null
	fabricante=`sudo dmidecode | grep "Vendor" | grep -v "Unknown" | cut -d: -f2` > /dev/null
	modelo=`dmidecode -t system | grep "Product Name" | cut -d: -f2` > /dev/null
	data_release=`dmidecode -t bios | grep "Release Date" | cut -d" " -f3 | cut -d: -f2` > /dev/null
}

function chaveAcesso(){
	read -p 'Digite o código da OM: ' cod_om
	echo ""
	read -p 'Digite a chave de acesso: ' chave
}

function idSetor(){
	read -p 'Digite o código do compartimento: ' cod_setor
	echo ""
}

clear
chaveAcesso
hardware > /dev/null
interfacesRede > /dev/null
discos > /dev/null

curl -sS -X POST -H "Content-Type: application/json" \
	-d '{
		"cod_om": "'"$cod_om"'",
		"chave": "'"$chave"'",
		"act": "select_setores"
		}' \
	http://172.23.119.35/sisclti/scripts/submit.inc.php > tmp.txt

cat tmp.txt
status=`cat tmp.txt | grep "Erro"`

if [ $? -eq 0 ]
then
  exit 1
else
  idSetor
fi

curl -sS -X POST -H "Content-Type: application/json" \
	-d '{
		"act": "cad_et",
		"cod_om": "'"$cod_om"'",
		"chave": "'"$chave"'",
		"cod_setor": "'"$cod_setor"'",
		"hostname": "'"$hostname"'",
		"fabricante": "'"$fabricante"'",
		"modelo": "'"$modelo"'",
		"data": "'"$data_release"'",
		"distro": "'"$distro"'",
		"versao": "'"$versao"'",
		"proc_fab": "'"$proc_fab"'",
		"proc_modelo": "'"$proc_modelo"'",
		"proc_familia": "'"$proc_familia"'",
		"clock": "'"$clock"'",
		"cores": "'"$cores"'",
		"threads": "'"$threads"'",
		"memoria": "'"$memoria"'",
		"tipo_memoria": "'"$tipo_memoria"'",
		"velocidade": "'"$velocidade"'",
		"end_ip": "'"$end_ip"'",
		"end_mac": "'"$end_mac"'",
		"hd": "'"$hd"'"
		}' \
	http://172.23.119.35/sisclti/scripts/submit.inc.php >> tmp.txt

clear
cat tmp.txt
rm -f estacoes.sh tmp.txt

#Chave teste 3DN = IPDMFEGWZ2XYDZ4X