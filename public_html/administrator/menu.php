<?php
    session_start();
    include_once '../persistence/PerfilDAO.class.php';
    include_once '../domain/Modulo.class.php';

    $perfil = $_SESSION['perfil'];

    $pd = new PerfilDAO();
    $m = new Modulo();

    $rs = $pd->listAcessos($perfil);

    echo '<a href="index.php?p=home">Painel de Controle</a>';

    if ($rs) {

        foreach($rs as $m) {
            if($m->getConsulta() == 1) {
                echo '<a href="index.php?p='.$m->getPagina().'&m='.$m->getCodigo().'">'.$m->getDescricao().'</a>';
            }
        }
    } else {
        echo "";
    }

?>


<a href="../session/destruir.php">Desconectar</a>