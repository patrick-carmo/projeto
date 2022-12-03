<?php


  //Caso o perfilAcesso seja igual a 1, a página exibida terá as funções do usuário master
  session_start();
  include_once('barra.php');

  //Código usuário master
  
  if($_SESSION['perfilAcesso'] == 1){

  include_once('connect.php');

  //Verifica novamente se está logado

  if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
  {
    session_destroy();
    header('Location: index.php');
  }
  
  if(!empty($_GET['search'])) //pesquisar usuarios
  {
    $data = $_GET['search'];
    $sql = "SELECT * FROM usuarios WHERE uf LIKE '%$data%' or nome LIKE '%$data%' or cidade LIKE '%$data%' or cpf LIKE '%$data%' or UF LIKE '%$data%' or login LIKE '%$data%' ORDER BY idusuarios DESC";
  }
  else 
  {
    //Caso não encontre a pesquisa, traz todos os usuários novamente.

    $sql = "SELECT * FROM usuarios ORDER BY idusuarios DESC";
  }
  
  $result = mysqli_query($conexao, $sql);
  
?>
<!doctype html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <title>Sistema</title>
  </head>
  <body>
      <div align='center'>
            <?php 
            if($_SESSION['perfilAcesso'] == 1){ ?>
              <h6>Usuário Master</h6> <?php
            } ?>
        </div>
<br>
    <?php
      echo "<h1><center>Usuarios</center></h1>";
    ?>
    <br>
    <div align='center'>
      <input type="search" id="pesquisar" placeholder="Nome / Cidade / Login" class="rounded">
        <button onclick="searchData()" type="submit" class="btn btn-primary">Pesquisar</button>
    </div>
    <div>
    <table class="table table-hover">
      <thead class="table-primary">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Data de nascimento</th>
          <th scope="col">Nome materno</th>
          <th scope="col">CPF</th>
          <th scope="col">Número de celular</th>
          <th scope="col">Número fixo</th>
          <th scope="col">Rua</th>
          <th scope="col">Número</th>
          <th scope="col">Bairro</th>
          <th scope="col">Cidade</th>
          <th scope="col">UF</th>
          <th scope="col">País</th>
          <th scope="col">Login</th>          
          <th scope="col">Senha</th>>
          <th scope="col">Acesso</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($user_data = mysqli_fetch_assoc($result))
          {

            echo "<tr>";
            echo "<td>".$user_data['idusuarios']."</td>";
            echo "<td>".$user_data['nome']."</td>";
            echo "<td>".$user_data['dataNascimento']."</td>";
            echo "<td>".$user_data['nomeMaterno']."</td>";
            echo "<td>".$user_data['cpf']."</td>";
            echo "<td>".$user_data['numeroCelular']."</td>";
            echo "<td>".$user_data['numeroFixo']."</td>";
            echo "<td>".$user_data['rua']."</td>";
            echo "<td>".$user_data['numero']."</td>";
            echo "<td>".$user_data['bairro']."</td>";
            echo "<td>".$user_data['cidade']."</td>";
            echo "<td>".$user_data['uf']."</td>";
            echo "<td>".$user_data['pais']."</td>";            
            echo "<td>".$user_data['login']."</td>";
            echo "<td>".$user_data['senha']."</td>";
            if($user_data['perfilAcesso'] == 1){
                echo "<td>Master</td>";
            }else if($user_data['perfilAcesso'] == 2){
                echo "<td>Comum</td>";
            }else{
                echo "<td>Desativado</td>";
            }
            
    }
    ?>
      </tbody>
</table>
</div>
    
    
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
    window.location = 'sistema.php?search='+search.value;  
  }
</script>
</html>











<?php


//Código usuário comum


}else{
  include_once('connect.php');
  if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
  {
    session_destroy();
    header('Location: index.php');
  };
  $id = $_SESSION['id'];
  //Pega todos os dados somente do usuário logado na sessão atual
  $sql = "SELECT * FROM usuarios WHERE idusuarios='$id'";
  $result = mysqli_query($conexao, $sql);
  
?>
<!doctype html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <title>Sistema</title>
  </head>
  <body>
        <div align='center'>
            <?php 
            if($_SESSION['perfilAcesso'] == 2){ ?>
              <h6>Usuário Comum</h6> <?php
            }else{ ?>
              <h6>Desativado</h6> <?php } ?>
        </div>
<br>
    <?php
      echo ("<h1><center>Olá<br> ".$_SESSION['nome']."</center></h1>");
    ?>
    <br>
    <h3><center>Seus dados</center></h3>
    <div>
    <table class="table table-hover">
      <thead class="table-primary">
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Data de nascimento</th>
          <th scope="col">Nome materno</th>
          <th scope="col">CPF</th>
          <th scope="col">Número de celular</th>
          <th scope="col">Número fixo</th>
          <th scope="col">Rua</th>
          <th scope="col">Número</th>
          <th scope="col">Bairro</th>
          <th scope="col">Cidade</th>
          <th scope="col">UF</th>
          <th scope="col">País</th>
          <th scope="col">Login</th>          
          <th scope="col">Senha</th>>          
          <th scope="col">Alterar/Deletar</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($user_data = mysqli_fetch_assoc($result))
          {
            echo "<tr>";
            echo "<td>".$user_data['nome']."</td>";
            echo "<td>".$user_data['dataNascimento']."</td>";
            echo "<td>".$user_data['nomeMaterno']."</td>";
            echo "<td>".$user_data['cpf']."</td>";
            echo "<td>".$user_data['numeroCelular']."</td>";
            echo "<td>".$user_data['numeroFixo']."</td>";
            echo "<td>".$user_data['rua']."</td>";
            echo "<td>".$user_data['numero']."</td>";
            echo "<td>".$user_data['bairro']."</td>";
            echo "<td>".$user_data['cidade']."</td>";
            echo "<td>".$user_data['uf']."</td>";
            echo "<td>".$user_data['pais']."</td>";            
            echo "<td>".$user_data['login']."</td>";
            echo "<td>".$user_data['senha']."</td>";            
            echo "<td>
            <form method='POST' action='crud/editar.php'>
            <input type='submit' name='edit' value='Alterar' class='btn btn-primary'>
            </form>
            <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'>
            Deletar
            </button></td>";
        echo "</tr>";
    }
    ?>
      </tbody>
</table>
    </div>
    

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <b>Tem certeza que deseja excluir?</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
          <form action="crud/deletar.php" method="POST">
          <button type="submit" name="delete" class="btn btn-danger">Sim</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="js/bootstrap.js"></script>
</html>

<?php }?>