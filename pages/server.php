<?php
@session_start(); //inicia uma sessão ou resume uma sessão existente

//conexão com o banco
$conexao = mysqli_connect('sql201.epizy.com', 'epiz_22242754', '0KpoEG7jq5a8', 'epiz_22242754_sysphp');
mysqli_set_charset($conexao, 'utf8'); //passando os dados em utf-8

//verificação se conectou ou não
if (!mysqli_connect('sql201.epizy.com', 'epiz_22242754', '0KpoEG7jq5a8', 'epiz_22242754_sysphp')) {
    echo "<p><strong>Erro em conectar ao banco de dados.</p></strong>";
}

/* -------------------------------------------------------------- */

//inicialização de variáveis
$hotel = "";
$endereco = "";
$telefone = "";
$quartos = null;
$valor = null;
$id = 0;
$editar = false;

//salvar registros
if (isset($_POST['salvar'])) {
    $hotel = $_POST['hotel']; //POST: pegar o que escrito através do "name" no form (HTML)
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $quartos = $_POST['quartos'];
    $valor = $_POST['valor'];
    
    //verifica se caso não colocar nada no login ou senha
    if (empty($hotel) || empty($endereco) || empty($telefone) || empty($quartos) || empty($valor)) {
        $_SESSION['msg'] = "<p><strong>Preencha todos os campos!</strong></p>"; //ele colocar uma mensagem na SESSION pra ser exibida
        header('location: principal.php'); //redireciona para a página principal.php
    } else {
        $query = "SELECT * FROM hotel WHERE hotel = '$hotel'"; //comando para consulta no banco
        $result = mysqli_query($conexao, $query); //pega o resultado no banco
        $busca = mysqli_num_rows($result); //retorna se achou ou não no banco (0 ou 1)

        //ligado ao (mysqli_num_rows), confirma se bateu os dados com o banco
        if ($busca > 0) {
            $_SESSION['msg'] = "<p><strong>Hotel já cadastrado!</strong></p>";
            header('location: principal.php');
        } else {
            $salvar = "INSERT INTO hotel (hotel, endereco, telefone, quartos, valor) VALUES ('$hotel', '$endereco', '$telefone', '$quartos', '$valor')"; //inserindo valores no banco
            mysqli_query($conexao, $salvar); //salva no banco
            $_SESSION['msg'] = "<p><em>Cadastrado com sucesso!</em></p>";
            header('location: principal.php');
        }
    }
}

//editar registros
if (isset($_POST['editar'])) {
    $hotel = $_POST['hotel'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $quartos = $_POST['quartos'];
    $valor = $_POST['valor'];
    $id = $_POST['id'];
    $editar = mysqli_query($conexao, "UPDATE hotel SET hotel='$hotel', endereco='$endereco', telefone='$telefone', quartos='$quartos', valor='$valor' WHERE id = $id");
    mysqli_query($conexao, $editar);
    $_SESSION['msg'] = "<p><em>Editado com sucesso!</em></p>";
    header('location: principal.php');
}

////buscar registro pra deletar
if(isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($conexao, "DELETE FROM hotel WHERE id = $id");
    $_SESSION['msg'] = "<p><em>Deletado com sucesso!</em></p>";
    header('location: principal.php');
}

//buscar registro pra atualizar
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editar = true;
    $registro = mysqli_query($conexao, "SELECT * FROM hotel WHERE id = $id");
    $reg = mysqli_fetch_array($registro);
    $hotel = $reg['hotel'];
    $endereco = $reg['endereco'];
    $telefone = $reg['telefone'];
    $quartos = $reg['quartos'];
    $valor = $reg['valor'];
    $id = $reg['id'];
}

//recuperar registros
$results = mysqli_query($conexao, "SELECT * FROM hotel");
?>