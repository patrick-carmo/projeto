<?php

session_start();
require_once('connect.php');

//Variável para escolher aleatóriamente um número
$roleta=rand(1,5);
$botao=$_SESSION['submit'];


if($botao){
?>
<html lang="PT-BR">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<title>2FA</title>
<body>
<form method='post' action='2fa.php' align='center' class="needs-validation" novalidate>

<!--   O switch com a variável aleatória para exibir na tela o campo input com base no número aleatório escolhido    -->
<?php switch($roleta):
    case 1: ?>
        <h2>Digite os 3 últimos números do CPF</h2><br>
        <input type='text' name='cpf3U' maxlength="3" class="rounded" required>
        <div class="invalid-feedback">
        Preencha o campo.
        </div>
        <br><br>
        <input type='submit'  name='btn2FA' value='Verificar' class="btn btn-primary">
        <?php break;
        case 2: ?>
            <h2>Digite os 3 primeiros números do CPF</h2><br>
            <input type='text' name='cpf3P' maxlength="3" class="rounded" required>
            <div class="invalid-feedback">
            Preencha o campo.
            </div>
            <br><br>
            <input type='submit'  name='btn2FA' value='Verificar' class="btn btn-primary">
            <?php
            break; 
            case 3: ?>
                <h2>Digite o celular cadastrado</h2><br>
                <input type='text' name='numeroCelular' maxlength="15" class="rounded" required>
                <div class="invalid-feedback">
                Preencha o campo.
                </div>
                <br><br>
                <input type='submit'  name='btn2FA' value='Verificar' class="btn btn-primary">
                <?php
                break; 
                case 4: ?>
                    <h2>Digite o nome da mãe</h2><br>
                    <input type='text' name='nomeMaterno' class="rounded" required>
                    <div class="invalid-feedback">
                    Preencha o campo.
                    </div>
                    <br><br>
                    <input type='submit'  name='btn2FA' value='Verificar' class="btn btn-primary">
                    <?php
                    break; 
                    case 5: ?>
                        <h2>Digite a data de nascimento</h2><br>
                        <input type='date' name='dataNascimento' class="rounded" required>
                        <div class="invalid-feedback">
                        Preencha o campo.
                        </div>                       
                        <br><br>
                        <input type='submit'  name='btn2FA' value='Verificar' class="btn btn-primary">
                        <?php
                        break;
                        endswitch; ?>
                        <a href="index.php" class="btn btn-secondary">Voltar</a>
</form>
</body>
<script src="js/form.js"></script>
</head>
</html>
<?php  

//Variável para pegar o campo input digitado
$btn2FA= filter_input(INPUT_POST,'btn2FA', FILTER_SANITIZE_STRING);
if(isset($_POST['voltar'])){
    session_destroy();
    header('location: index.php');
}

//if para adicionar os dados do input aleatório dentro de um array
if($btn2FA)
{        
            $cpf3U= filter_input(INPUT_POST,'cpf3U', FILTER_SANITIZE_STRING);
            $cpf3P= filter_input(INPUT_POST,'cpf3P', FILTER_SANITIZE_STRING);
            $numeroCelular= filter_input(INPUT_POST,'numeroCelular', FILTER_SANITIZE_STRING);
            $nomeMaterno= filter_input(INPUT_POST,'nomeMaterno', FILTER_SANITIZE_STRING);
            $dataNascimento= filter_input(INPUT_POST,'dataNascimento', FILTER_SANITIZE_STRING);
$v2=array($cpf3U,$cpf3P,$numeroCelular,$nomeMaterno,$dataNascimento);

                //Armazena os 3 primeiros e os 3 últimos digitos do CPF do usuário da sessão em uma variável
                 if($_SESSION['id']){
                     
                     $rowCPF3P=substr($_SESSION['cpf'],0,3);
                     $rowCPF3U=substr($_SESSION['cpf'],-3);

                    //Compara se os dados digitados são idênticos aos dados armazenados no banco
                     if($nomeMaterno===$_SESSION['nomeMaterno'] or 
                     $dataNascimento===$_SESSION['dataNascimento'] or 
                     $numeroCelular===$_SESSION['numeroCelular'] or 
                     $cpf3P===$rowCPF3P or 
                     $cpf3U===$rowCPF3U)
{
    $login =  $_SESSION['login'];
    $userID = $_SESSION['id'];

    //SELECT para pegar o valor do "perfilAcesso" e iniciar a sessão que dará o controle de acesso para as páginas
    $select = "SELECT * FROM usuarios WHERE login = '$login'";
    $result = mysqli_query($conexao, $select);
    $dados = mysqli_fetch_array($result);
    $_SESSION['perfilAcesso'] = $dados['perfilAcesso'];

    //Percorre todo array anteriormente criado e compara os valores com os dados do banco para armazenar no banco de dados
    foreach($v2 as $v3){
    switch($v3):
        case $_SESSION['nomeMaterno']:
        $sql="INSERT INTO logs(acesso,metodo,status,login,userID) values('".date('Y-m-d H:i:s')."','Nome da Mãe','ON','".$login."','".$userID."')";
        $resultRegistro= mysqli_query($conexao,$sql);
        break;
            case $_SESSION['numeroCelular']:
            $sql="INSERT INTO logs(acesso,metodo,status,login,userID) values('".date('Y-m-d H:i:s')."','Número do Celular','ON','".$login."','".$userID."')";
            $resultRegistro= mysqli_query($conexao,$sql);
            break;    
            case $_SESSION['dataNascimento']:
                $sql="INSERT INTO logs(acesso,metodo,status,login,userID) values('".date('Y-m-d H:i:s')."','Data de Nascimento','ON','".$login."','".$userID."')";
                $resultRegistro= mysqli_query($conexao,$sql);
                break;
                    case $rowCPF3U:
                    $sql="INSERT INTO logs(acesso,metodo,status,login,userID) values('".date('Y-m-d H:i:s')."','3 ultimos digitos do CPF','ON','".$login."','".$userID."')";
                    $resultRegistro= mysqli_query($conexao,$sql);
                    break;
                        case $rowCPF3P:
                        $sql="INSERT INTO logs(acesso,metodo,status,login,userID) values('".date('Y-m-d H:i:s')."','3 primeiros Digitos do CPF','ON','".$login."','".$userID."')";
                        $resultRegistro= mysqli_query($conexao,$sql);
                        break;
                        endswitch;
                        header('Location: dev.php');
    }
}

//Caso os dados digitados estejam errados, armazena informações na tabela logs e retorna para a página de login
else {
    $login = $_SESSION['login'];
    $userID = $_SESSION['id'];
    $sql="INSERT INTO logs(acesso,metodo,status,login,userID) values('".date('Y-m-d H:i:s')."','Verificação de Duas Etapas Falhou','OFF','".$login."','".$userID."')";
    $resultRegistro= mysqli_query($conexao,$sql);
    session_destroy(); 
    echo "<script language='javascript' type='text/javascript'>alert('Falha na autenticação, tente novamente.');window.location.href='index.php';</script>";
}
}
}
                                   
}

//Caso tente entrar direto na página sem tentar logar
else{ 
    session_destroy();
    header('location: index.php');
}





    

?>