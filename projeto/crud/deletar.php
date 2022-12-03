<?php
    session_start();
    if(!isset($_SESSION['perfilAcesso'])){
        session_destroy();
        header('location: ../sistema.php');
    }

    if(isset($_POST['delete']) and !($_SESSION['perfilAcesso'] == 1))
    {
        include_once('../connect.php');

        $id = $_SESSION['id'];

        $sqlSelect = "SELECT *  FROM usuarios WHERE idusuarios=$id";

        $result = mysqli_query($conexao, $sqlSelect);

        if(mysqli_num_rows($result) > 0)
        {
            $sqlUpdate = "UPDATE usuarios SET perfilAcesso = 3 WHERE idusuarios=$id";
            $resultUpdate = mysqli_query($conexao, $sqlUpdate);
            session_destroy();
            echo "<script language='javascript' type='text/javascript'>alert('Usuário excluído');window.location.href='../index.php';</script>";
        }
    }else{
        header('location: ../dev.php');
    }
?>