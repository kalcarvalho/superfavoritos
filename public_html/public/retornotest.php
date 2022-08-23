<?php

include_once 'retorno.php';

$p = new RetornoPagSeguro();

$p->verifica($_POST);
?>