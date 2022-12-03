<?php  
    session_start();
    require_once ('connect.php');
    if(isset($_POST['enviar'])){
        $post = mysqli_escape_string($conexao, $_POST['validar']);
        //Pego o valor da sessão login para saber qual usuário está querendo reativar a conta
        $login = $_SESSION['login'];
        $sql = "SELECT cpf FROM usuarios WHERE login='$login'";
        $result = mysqli_query($conexao, $sql);
        $dados = mysqli_fetch_array($result);
        //Se o CPF for igual ao CPF cadastrado, altera o valor do "perfilAcesso" para 2, assim podendo logar novamente.
        if(($post) == ($dados['cpf'])){
            $sqlUpdate = "UPDATE usuarios SET perfilAcesso='2'  WHERE login='$login'";
            $resultUpdate = mysqli_query($conexao, $sqlUpdate);
            session_destroy();
            echo "<script language='javascript' type='text/javascript'>alert('Conta ativada com sucesso');window.location.href='index.php';</script>";
        }
        else{
            session_destroy();
            echo "<script language='javascript' type='text/javascript'>alert('Dados incorretos');window.location.href='index.php';</script>";
        }
    }
    else{
        header('location: index.php');
    }

?>