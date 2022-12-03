<?php
    session_start();
    if($_SESSION['perfilAcesso'] == 1){
    require_once('../connect.php');

    $sql = "SELECT * FROM logs";
    $result = mysqli_query($conexao, $sql);

  if(!empty($_GET['search']))
  {
    $data = $_GET['search'];
    $sql = "SELECT * FROM logs WHERE id LIKE '%$data%' or acesso LIKE '%$data%' or metodo LIKE '%$data%' or status LIKE '%$data%' or userID LIKE '%$data%' or login LIKE '%$data%'  ORDER BY id DESC";
  }
  else 
  {
    $sql = "SELECT * FROM logs ORDER BY id DESC";
  }

  $result = mysqli_query($conexao, $sql);
?>

<!doctype html>
<html lang="PT-BR">
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <title>Logs</title>
  </head>
  <body>
  <nav class="navbar navbar-expand bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="../dev.php">
      <img src="../img/telecall.png" alt="" width="125"class="d-inline-block align-text-top">
      Dev
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="../sistema.php">Dados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logs.php">Logs</a>
        </li>
      </ul>
      <a href="../sair.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
  </nav>

    <div align='center'>
      <input type="search" id="pesquisar" class="rounded" placeholder="Login / Método / Status...">
        <button onclick="searchData()" type="submit" class="btn btn-primary">Pesquisar</button>
    </div>
    <div>
    <br>
    <br>
    <div align="center">
    <a href="pdf.php" class="btn btn-primary">Baixar Logs</a>
    </div>
    <br>
    <h3><center>Logs</center></h3>
    <div>
    <table class="table table-hover" align="center">
      <thead class="table-dark">
        <tr>
          <th scope="col">Data e hora de acesso</th>
          <th scope="col">Método de acesso</th>
          <th scope="col">Status do acesso</th>
          <th scope="col">Login</th>
          <th scope="col">ID do usuário</th>        
        </tr>
      </thead>
      <tbody>
        <?php
          while($user_data = mysqli_fetch_assoc($result))
          {
            echo "<tr>";
            echo "<td>".$user_data['acesso']."</td>";
            echo "<td>".$user_data['metodo']."</td>";
            echo "<td>".$user_data['status']."</td>";
            echo "<td>".$user_data['login']."</td>";
            echo "<td>".$user_data['userID']."</td>";
            echo "</tr>";
    }
    ?>
      </tbody>
    </div>
    </table>
    
</body>
<script>
  var search = document.getElementById('pesquisar');
  search.addEventListener("keydown", function(event) {
    if (event.key === "Enter")
    {
      searchData();
    }
  });

  function searchData() 
  {
    window.location = 'logs.php?search='+search.value;  
  }
</script>
</html>
<?php 
    }else{
        header('location: ../dev.php');
    }
?>