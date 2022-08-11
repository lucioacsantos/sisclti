#!/bin/bash
#
# Inventário de Hardware.sh - Gera o inventário de Hardware
#
# Autor     : Alexandre Cunha (Cunha A.M) <alexandremartinscunha@yahoo.com.br> 
# Manutenção: Alexandre Cunha (Cunha A.M) <alexandremartinscunha@yahoo.com.br>
#
#  -------------------------------------------------------------
#   Este programa cria um arquivo com o nome da máquina data e hora, anexando os dados referentes a configuração do hardware
#  -------------------------------------------------------------
#
#
# Histórico:
#
#    v1.0 2017-01-10, Alexandre Cunha:
#       - Versão inicial 
#
#    v2.0 2017-02-09, Alexandre Cunha:
#       - Acresentado suporte a discos
#       - Acresentado suporte a partições
#   
#    v3.0 2017-02-20, Alexandre Cunha:
#       - Programa reescrito do zero
#       - Refinado o código
#       - Uso de variáveis BD e funções(discos, particoes e interfacesRedes) 
#
#    v3.1 2017-03-20, Alexandre Cunha:
#       - Pequenos Ajustes 
#       
#    v3.2 2017-11-06, Alexandre Cunha:
#       - Modificado o suporte a Rede para o Debian 9
#       
#    v3.3 2018-01-10, Alexandre Cunha:
#       - Corrigido bug nos discos
#
#    v3.4 2018-11-22, Alexandre Cunha:
#       - Corrigido bug partição não formatada ou desconhecida
#       - Alinhamento da variável BD a direita.
# Licença: GPL.

if [ $(id -u) != 0 ] ; then 
	echo "Você precisar ser root para rodar esse script"
	exit 1 ; 
fi


function interfacesRede(){
	interfacesRede=`ifconfig | cut -d" " -f1 | cut -d":" -f1 | grep -v "lo"`
	numero=1
	for interfacesNome in $interfacesRede
	do
		echo "2.$((numero++))""-Informações Placa de Rede ($interfacesNome):"										>> $BD
		echo "     ""- Endereço IPv4: "`ifconfig $interfacesNome | grep 'inet ' | awk '{print $2}'`							>> $BD	
		echo "     ""- Endereço MAC:  "`ifconfig $interfacesNome | grep "ether" | cut -d" " -f10 `							>> $BD
		echo ""																		>> $BD
	done
}

function particoes(){
	particoes=`fdisk -l | grep /dev/ | grep -v Disco | grep $1 | cut -d" " -f1 | cut -d"/" -f3`
	#numero=1
	for particao in $particoes
	do
		echo "     ""     ""- Nome : " $particao													>> $BD
		capacidade=`parted /dev/$particao print 2>/dev/null | grep $particao | cut -d" " -f3`
		tipo=`parted /dev/$particao print 2>/dev/null | grep -v File | grep -v  Disk | grep -v model | grep -v Sector | grep -v Partition | grep -v model | cut -d" " -f14`
		echo "     ""     ""- Tamanho : " $capacidade													>> $BD
		if [ -z $tipo ]; then tipo="Não Formato ou Desconhecido"; fi
		echo "     ""     ""- Tipo : " $tipo									 					>> $BD 
		echo "     "																	>> $BD
	done
}


function discos(){
	discos=`fdisk -l | grep Disco | cut -d" " -f2 | cut -d"/" -f3| sed 's/://g'| grep -v ram`
	numero=1
	for disco in $discos
	do
		echo "3.3.$((numero++))""- Disco $disco "													>> $BD	
		capacidade=`fdisk -l | grep Disco | grep -e $disco | cut -d" " -f3`										>> $BD
		escala=`fdisk -l | grep Disco | grep -e $disco | cut -d" " -f4 | sed 's/,//g'`									>> $BD
		echo "     ""- Tamanho : "$capacidade $escala													>> $BD
		echo "     ""- Tabela de partição  : "`parted /dev/$disco print | grep "Partition Table" | cut -d" " -f3`					>> $BD
		echo "	   ""Partições:"															>> $BD
		echo "	   "																	>> $BD
		particoes $disco
	done
}

	BD=`hostname`.$(date +%d-%m-%Y-%H:%M).log
	echo ""                              													     		>> $BD
	echo "========================================================="											>> $BD
	echo "=  Informações de inventário - `date +'%d/%m/%Y %H:%M'` ="											>> $BD
	echo "========================================================="									 		>> $BD
	echo ""						 													>> $BD 
	echo " Nome do computador: `hostname`"								     							>> $BD
	echo ""															     				>> $BD
	echo "1 - SISTEMA"																	>> $BD 
	echo ""																			>> $BD
	echo "1.1 Informações do Sistema Operacional:"										     				>> $BD
	echo "     ""- Arquitetura: "`uname -m`															>> $BD
	echo "     ""- Versão do Kernel: "`uname -r`														>> $BD
	echo ""																	     		>> $BD
	echo "1.2 Informações da Distribuição:"												     			>> $BD
	echo "     ""- Distribuição: "`lsb_release -i | cut -d: -f2`												>> $BD
	echo "     ""- Versão: "`lsb_release -r | cut -d: -f2` 													>> $BD
	echo "     ""- Codinome: "`lsb_release -c | cut -d: -f2`							 					>> $BD
	echo "" 																		>> $BD
	echo "2 - REDE"																		>> $BD
	echo "" 																		>> $BD
	interfacesRede 																											
	echo "3 - HARDWARE"																	>> $BD
	echo ""																	             	>> $BD
	echo "3.1 Processador" 																     	>> $BD
	echo "     ""- Fabricante: "`cat /proc/cpuinfo | head -n 31 | grep 'model name'  | cut -d : -f2`				  			>> $BD
	echo "     ""- Modelo: "`cat /proc/cpuinfo | head -n 31 | grep 'model name'  | cut -d : -f2`				  				>> $BD
	echo "     ""- Velocidade (MHz):" `cat /proc/cpuinfo | head -n 31 | grep 'cpu MHz' | cut -d : -f2 | cut -d . -f1`"MHz" 					>> $BD
	echo "     ""- Cache: "`cat /proc/cpuinfo | head -n 31 | grep 'cache size' | cut -d : -f2 `								>> $BD
	echo ""																			>> $BD
	echo "3.2 Memória" 																	>> $BD
	echo "     ""- Máximo Suportado: "`dmidecode -t memory | grep 'Maximum Capacity'| cut -d : -f2`								>> $BD
	echo "     ""- Número de Slot(s): "`dmidecode -t memory |  grep 'Number Of Devices:' | cut -d : -f2`							>> $BD
	echo "     ""- Quantidade Instalada:  "`free -m | grep 'Mem:' | awk '{print $2}'`"MB"	    								>> $BD
	echo "     ""- Slot(s) em Uso: "`dmidecode -t memory | grep 'Size' | grep -v "No Module Installed" | cut -d" "  -f2`					>> $BD
	echo ""											     								>> $BD
	echo "3.3 Discos"																	>> $BD
	echo ""																			>> $BD	
	discos

	echo ""	
	echo "Gerando Inventário $BD" 
	sleep 2
	cat $BD	
