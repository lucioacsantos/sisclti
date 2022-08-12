#!/bin/bash

function interfacesRede(){
	interfacesRede=`ifconfig | cut -d" " -f1 | cut -d":" -f1 | grep -v "lo"`
	numero=1
	for interfacesNome in $interfacesRede
	do
		echo "Informações Placa de Rede ($interfacesNome):"
		echo "     ""- Endereço IPv4: "`ifconfig $interfacesNome | grep 'inet ' | awk '{print $2}'`
		echo "     ""- Endereço MAC:  "`ifconfig $interfacesNome | grep "ether" | cut -d" " -f10 `
		echo ""
	done
}

function discos(){
	discos=`fdisk -l | grep Disco | grep -v "loop" | cut -d" " -f2 | cut -d"/" -f3| sed 's/://g'| grep -v ram`
	numero=1
	for disco in $discos
	do
		echo "Disco $disco "
		capacidade=`fdisk -l | grep Disco | grep -e $disco | cut -d" " -f3`
		escala=`fdisk -l | grep Disco | grep -e $disco | cut -d" " -f4 | sed 's/,//g'`
		echo "     ""- Tamanho : "$capacidade $escala
		#echo "     ""- Tabela de partição  : "`parted /dev/$disco print | grep "Partition Table" | cut -d" " -f3`
		#echo "	   ""Partições:"															>> $BD
		#echo "	   "																	>> $BD
		#particoes $disco
	done
}

#interfaceRede=`ifconfig | cut -d" " -f1 | cut -d":" -f1 | grep -v "lo" | grep -v "^w"`

#echo "Tamanho do HD em bytes:   `sudo fdisk -l | grep Disco | cut -d" " -f3`"
#echo ""
#echo "Endereço IP:              `ifconfig $interfaceRede | grep 'inet ' | awk '{print $2}'`"
#echo "Endereço MAC:             `ifconfig $interfaceRede | grep "ether" | cut -d" " -f10 `"
echo ""
echo "Distribuição:             `cat /etc/*issue | cut -d" " -f1`"
echo "Versão:                   `cat /etc/*issue | cut -d" " -f2`"
echo ""
echo "Processador (Fabricante): `dmidecode -t processor | grep Version | cut -d: -f2 | cut -d" " -f2`"
echo "Modelo:                   `sudo dmidecode -t processor | grep Version | cut -d: -f2 | cut -d" " -f4`"
echo "Clock:                    `dmidecode -t processor | grep "Current Speed" | cut -d: -f2`"
echo ""
echo "Memória total:            `free --giga | grep 'Mem.:' | awk '{print $2}'`"
echo "Velocidade:               `dmidecode -t memory | grep MT/s | head -1 | cut -d" " -f2`"
echo ""
echo "Fabricante:               `sudo dmidecode | grep "Vendor" | grep -v "Unknown" | cut -d: -f2`"
echo "Modelo:                   `dmidecode -t system | grep "Product Name" | cut -d: -f2`"
echo ""

interfacesRede

echo ""

discos