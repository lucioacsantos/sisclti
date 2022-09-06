<?php

# Valida data
$date = "06/02/2022";

function validaData($date, $format = 'd/m/Y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function formatarData($date, $format = 'm/d/Y') {

    $d = DateTime::createFromFormat($format, $date);

    if ($d && $d->format($format) != $date) {
        echo 'Data Inválida';
    }

    return $d->format('d/m/Y');
}

$data_valida = validaData($date);

if ($data_valida){
    print "Data válida: $date\n";
}

else{
    $date = formatarData($date);
    print "Data corrigida: $date\n";
}
?>