<?php
session_start();
if((isset($_POST['submit'])) and (!empty($_POST['login']) and !empty($_POST['senha'])))
{
  //Acessa o Sistema
  include_once('connect.php');
  $login = mysqli_escape_string($conexao, $_POST['login']);
  $senha = mysqli_escape_string($conexao, $_POST['senha']);
  $_SESSION['login'] = $login;
  $_SESSION['senha'] = $senha;
  $submit = $_POST['submit'];

  //Adiciona todos os dados que possuem o login e senha digitados
  $sql = "SELECT * FROM usuarios WHERE login = '$login' and senha = '$senha'";

  $result = mysqli_query($conexao, $sql);
  $dados = mysqli_fetch_array($result);
  

  //Se não tiver nenhum dado com base no login e senha digitados, retorna à página de login para digitar novamente
  if(mysqli_num_rows($result) < 1)
  { 
    session_destroy();
    echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='index.php';</script>";

  //Se o usuário estiver desativado (excluído), não consegue logar (perfilAcesso 3 é o de usuários deletados)
  }else if($dados['perfilAcesso'] == 3){ ?>
  <html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <body>
  <form action="ativar.php" method="POST" class="form">
    <div class="form-group text-center">
      <label for="cpf"><h5>Digite o CPF para ativar a conta</h5></label><br>
    <input type="text" class="text-center rounded" placeholder="CPF" name="validar"><br><br>
    <input type="submit" name="enviar" class="btn btn-primary" value="Enviar">
    </div>
  </form>
  </body>
  </head>
  </html> <?php
  }
  else
  {
    //Crio sessões para usar no restante do código, principalmente para a página 2fa.php
    $_SESSION['submit'] = $submit;
    $_SESSION['id'] = $dados['idusuarios'];
    $_SESSION['nome'] = $dados['nome'];
    $_SESSION['cpf'] = $dados['cpf'];
    $_SESSION['numeroCelular'] = $dados['numeroCelular'];
    $_SESSION['dataNascimento'] = $dados['dataNascimento'];
    $_SESSION['nomeMaterno'] = $dados['nomeMaterno'];
    header('Location: 2fa.php');
  }
}
else{
    
    //Caso o usuário não tenha digitado todos os campos corretamente, retorna para a página login
    echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='index.php';</script>";
}
?>