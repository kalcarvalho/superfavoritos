<div id="container-login">

    <div id="topo-login">Login - Administração do site</div>
    <div id="imagem-login"></div>
    <div id="conteudo-login">

        <form action="../controller/loginController.php" method="POST">
            <p>Login:</p>
            <p><input type="text" size="30" name="login" value=""></p>
            <p>Senha:</p>
            <p><input type="password" size="30" name="senha" value=""></p>
            <p></p>
            <p><input name="submit" type="submit" value="Login"></p>
        </form>
        <p class="error-message"><?php echo base64_decode($_GET['msg']); ?></p>
    </div>

</div>