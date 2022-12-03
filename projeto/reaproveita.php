<?php

//Página para não ter que digitar tudo de novo quando o login ou a senha estiverem inválidos

session_start();
if(isset($_SESSION['status'])){
?>
<!doctype html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>Formulario</title>
  <body>
  <div>
        <form action="crud/cadastrar.php" method="POST" class="needs-validation" novalidate>
        <legend align='center'><h3 class="rounded-pill" style="background-color: black;color: white;">Cadastrar</h3></legend>
            <h5 style="background-color: red; color: white" align="center" class="rounded-circle"><?php echo $_SESSION['status']; ?></h5>
            <br>
            <div class="form-group text-center">
            <label for="nome"><h5>Nome completo</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['nome'] ?>" name="nome" id="nome"required maxlength="100" minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="dataNascimento"><h5>Data de nascimento</h5></label>
                <input type="date" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['dataNascimento'] ?>" name="dataNascimento" id="dataNascimento" min="1900-01-01" max="2010-01-01" required>
                <div class="invalid-feedback">
                Insira uma data de nascimento válida.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="nomeMaterno"><h5>Nome materno</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['nomeMaterno'] ?>" name="nomeMaterno" id="nomeMaterno" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="cpf"><h5>CPF</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['cpf'] ?>" name="cpf" id="cpf" maxlength="11" minlength="11" required>
                <div class="invalid-feedback">
                Insira um CPF válido<br><br>
                </div>
            </div>
            <div class="row text-center" >
            <div class="col">
            <label for="numeroCelular"><h5>Número de celular</h5></label>
                <input type="tel" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['numeroCelular'] ?>" name="numeroCelular" id="numeroCelular" maxlength="15" minlength="9" required>
                <div class="invalid-feedback">
                Insira um número de celular válido.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="numeroFixo"><h5>Número de telefone</h5></label>
                <input type="tel" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['numeroFixo'] ?>" name="numeroFixo" id="numeroFixo" maxlength="15" minlength="8" required>
                <div class="invalid-feedback">
                Insira um número de telefone válido.<br><br>
                </div>
            </div>
            </div>
            <div class="row text-center">
            <div class="col">
            <label for="rua"><h5>Rua</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['rua'] ?>" name="rua" id="rua" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="numero"><h5>Número</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['numero'] ?>" name="numero" id="numero" maxlength="20" required minlength="1">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            </div>
            <div class="form-group text-center">
            <label for="bairro"><h5>Bairro</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['bairro'] ?>" name="bairro" id="bairro" class="inputUser" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="row text-center">
            <div class="col">
            <label for="cidade"><h5>Cidade</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['cidade'] ?>" name="cidade" id="cidade" maxlength="50" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="uf"><h5>UF</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['uf'] ?>" name="uf" id="uf" maxlength="2" minlength="2" required>
                <div class="invalid-feedback">
                Preencha o campo<br><br>
            </div>
            </div>
            <div class="form-group text-center">
            <label for="pais"><h5>País</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['pais'] ?>" name="pais" id="pais" maxlength="50" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="login"><h5>Login</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['login'] ?>" name="login" id="login" maxlength="25" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo<br><br>
                </div>
            </div>
            <div class="row text-center">
            <div class="col">
            <label for="senha"><h5>Senha</h5></label>
                <input type="password" class="form-control text-center border border-dark rounded-pill" name="senha" id="senha" maxlength="32" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="senha"><h5>Confirme a senha</h5></label>
                <input type="password" class="form-control text-center border border-dark rounded-pill" name="senha2" id="senha2" maxlength="32" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <br>
            <div align='center'>
            <input type="submit" name="submit" id="submit" class="btn btn-primary">
            <a href="index.php" class="btn btn-secondary">Voltar</a>
            <div>
            
        </form>
    </div>
</body>
<script src="js/form.js"></script>
</head>
</html>
<?php }else{
    header('location: crud/cadastrar.php');
}