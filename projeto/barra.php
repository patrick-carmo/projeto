<?php if($_SESSION['perfilAcesso'] == 1){
//Caso seja o usuário master, exibe o botão de logs    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<body>

<nav class="navbar navbar-expand bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="dev.php">
      <img src="img/telecall.png" alt="" width="125"class="d-inline-block align-text-top">
      Dev
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="sistema.php">Dados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logs/logs.php">Logs</a>
        </li>
      </ul>
      <a href="sair.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>

</body>
</head>
</html>

<?php } else if($_SESSION['perfilAcesso'] == 2){?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<body>
<nav class="navbar navbar-expand bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="dev.php">
      <img src="img/telecall.png" alt="" width="125"class="d-inline-block align-text-top">
      Dev
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="sistema.php">Dados</a>
        </li>
      </ul>
      <a href="sair.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>

</body>
</head>
</html>
<?php }else{
  session_destroy();
  header('location: index.php');
}?>
