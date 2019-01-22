<?php
    @session_start(); //pega os dados do banco
    session_destroy(); //destroi a sessão atual
    unset($_SESSION); //garantir se destruiu tudo na sessão
    header('Location: ../index.php'); //redireciona para a index
    exit; //termina script atual
?>