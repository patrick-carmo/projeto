<!doctype html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Projeto</title>

  </head>
  <body>
    <div class="text-center">
      <img src="img/telecall-logo.jpg" alt="">
      <form action="testLogin.php" method="POST">
        <div class="form-group text-center">
        <label for="login"><h5>Login</h5></label><br>
        <input type="text" name="login" placeholder="Login" class="text-center rounded" required>
        <br>
        <label for="senha"><h5>Senha</h5></label><br>
        <input type="password" name="senha" placeholder="Senha" id="password" class="rounded text-center " required>
        <br><br>
        <input type="submit" name="submit" value="Entrar" class="btn btn-primary"> 
        <a href="crud/cadastrar.php" class="btn btn-secondary">Cadastre-se</a>
        </div>
        </form>
        <br>
    </div>
</body>
</html>