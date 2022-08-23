<?php
session_start();
    include_once '../persistence/PerfilDAO.class.php';
    include_once '../domain/Perfil.class.php';

    
    $perfil = $_SESSION['perfil'];

    $pd = new PerfilDAO();
    $pf = $pd->findByPK($perfil);

    
    
    
?>
<!--Painel de Controle
<div class="box-titulo">
    
    <?=$pf->getDescricao()?>
</div>
-->
 <div class="box">
        <a href="?p=usuario&m=1"><img src="../images/biometrics.png" /></a>
        
    </div>

    <div class="box">
        <a href="?p=conteudo&m=2"><img src="../images/conteudo.png" /></a>
    </div>

    <div class="box">
        <a href="#"><img src="../images/award.png" /></a>
    </div>

     <div class="box">
        <a href="#"><img src="../images/moderation.png" /></a>
    </div>

    <div class="box">
        <a href="#"><img src="../images/advertising.png" /></a>
    </div>

    <div class="box">
        <a href="#"><img src="../images/chat.png" /></a>
    </div>
    
    <div class="box">
        <a href=".." target="_blank"><img src="../images/preview.png" /></a>
    </div>



    <div class="box">
        <a href="../session/destruir.php"><img src="../images/sair.png" /></a>
    </div>
