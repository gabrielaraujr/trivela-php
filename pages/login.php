<?php
include_once("pages/server.php"); //conexao com o banco

//se ja existir uma sessão (alguém logado) ele não voltará a página, continuará na principal.php
if (isset($_SESSION['nome']) && isset($_SESSION['usuario'])) {
    header('Location: principal.php'); //redireciona para a página principal.php
    exit; //termina o script atual
}
?>

<div class="linha contato col12">
    <section class="sectionhome">
        <div class="div-borderhome">
            <h2>Fazer login para prosseguir &raquo;</h2>
            <form action="" method="POST" enctype="multipart/form-data"> <!-- ENCTYPE: serve pra caso for fazer upload de arquivos -->
                <p><input type="text" name="usuario" id="usuario" placeholder="Digite seu usuário"></p>
                <p><input type="password" name="senha" id="senha" placeholder="Digite sua senha"></p>
                <p><button type="submit" name="entrar" class="button">Entrar</button></p>
                <p><a href="cadastro.php">Criar uma conta</a></p>
<?php
//ISSET: verifica se a variável é existente e se ela não possui valor NULL. Se possui um valor ela entra.
if (isset($_POST['entrar'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    //verifica se caso deixar os campos vazios
    if (empty($usuario) || empty($senha)) {
        echo "<p><strong>Preencha todos os campos!</strong></p>";
    } else {
        $query = "SELECT nome, email, usuario, senha FROM usuarios WHERE usuario = '$usuario' and senha = '$senha'"; //consulta se já cadastro no banco
        $result = mysqli_query($conexao, $query); //pega o resultado no banco.
        $busca = mysqli_num_rows($result); //retorna se achou ou não no banco (0 ou 1).
        $linha = mysqli_fetch_assoc($result); //retorna o resultado do banco como uma matriz.

        //ligado ao (mysqli_num_rows), confirma se bateu os dados com o banco.
        if ($busca > 0) {
            $_SESSION['nome'] = $linha['nome']; //SESSION: permite passar dados de uma página para outra.
            $_SESSION['usuario'] = $linha['usuario'];
            header('Location: principal.php'); //HEADER: redireciona para a página principal.php.
            exit; //termina o script atual
        } else {
            echo "<p><strong>Usuário ou senha inválidos!</strong></p>";
        }
    }
}
?>
            </form>
        </div>
    </section>
</div>