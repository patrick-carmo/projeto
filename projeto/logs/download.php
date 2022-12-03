<?php
    session_start();
    if($_SESSION['perfilAcesso'] == 1){
    require_once('../connect.php');
    $sql = "SELECT * FROM logs";
    $result = mysqli_query($conexao, $sql);
?>

<!doctype html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>download</title>
  </head>
  <body>
    <br>
    <br>
    <h3><center>Logs</center></h3>
    <div>
    <table border="1" align="center">
      <thead>
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
    <br>
    
</body>
</html>
<?php 
    }else{
        header('location: ../dev.php.php');
    }
?>