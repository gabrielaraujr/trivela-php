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
            <h2>Criar uma conta &raquo;</h2>
            <form action="" method="POST" enctype="multipart/form-data"> <!-- ENCTYPE: serve pra caso for fazer upload de arquivos -->
                <p><input type="text" name="nome" id="nome" placeholder="Digite seu nome"></p>
                <p><input type="text" name="email" id="email" placeholder="Digite seu e-mail"></p>
                <p><input type="text" name="usuario" id="usuario" placeholder="Digite seu usuário"></p>
                <p><input type="password" name="senha" id="senha" placeholder="Digite sua senha"></p>
                <p><button type="submit" name="cadastrar" class="button">Cadastre-se</button></p>
                <p><a href="index.php">Já possui uma conta?</a></p>
<?php
//ISSET: verifica se a variável é existente e se ela não possui valor NULL. Se possui um valor ela entra.
if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    //verifica se caso deixar os campos vazios
    if (empty($nome) || empty($email) || empty($usuario) || empty($senha)) {
        echo "<p><strong>Preencha todos os campos!</strong></p>";
    } else {
        $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'"; //consulta se já existe o mesmo usuário digitado no banco
        $result = mysqli_query($conexao, $query); //pega o resultado no banco
        $busca = mysqli_num_rows($result); //retorna se achou ou não no banco (0 ou 1)

        //ligado ao (mysqli_num_rows), confirma se bateu os dados com o banco
        if ($busca > 0) {
            echo "<p><strong>Usuário já cadastrado!</strong></p>";
        } else {
            $cadastrar = "INSERT INTO usuarios (nome, email, usuario, senha) VALUES ('$nome', '$email', '$usuario', '$senha')"; //inserindo os dados no banco
                
            //se inserido os dados, trás a mensagem de cadastrado, se não, erro
            if (mysqli_query($conexao, $cadastrar)) {
                echo "<p><em>Cadastro efetuado com sucesso!</em></p>";
            } else {
                echo "<p><strong>Erro ao cadastrar!</strong></p>";
            }
        }
    }
}
?>
            </form>
        </div>
    </section>
</div>