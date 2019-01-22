<?php
    include_once("pages/server.php"); //conexao com o banco

    $nome = $_SESSION['nome']; //variável nome da SESSION
    $usuario = $_SESSION['usuario']; //variável usuario da SESSION

    //não deixa voltar a página quando sair
    if(!isset($_SESSION['nome']) && !isset($_SESSION['usuario'])){
        header('Location: index.php'); //redireciona para a página index.php
        exit; //termina o script atual
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>trivela</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/icon.png">
</head>
<body class="colorhome">
    <div class="header bemvindo div-complemento div-button">
        <header>
            <div>
                <a href="clean/sair.php"><button>Sair</button></a>
            </div>
            <div>
                <p>Bem vindo <?php echo $nome; ?>, <b>@<?php echo $usuario;?></b></p>
            </div>
        </header>
    </div>
</body>
</html>