<?php
    include_once('../connect.php');
    session_start();
    if(!isset($_SESSION['perfilAcesso']) or ($_SESSION['perfilAcesso']) != 2){
        header('location: ../dev.php');
    }

    //Comandos para preencher os dados nos campos
    if(isset($_POST['edit']))
    {
        $id = $_SESSION['id'];
        $sqlSelect = "SELECT * FROM usuarios WHERE idusuarios=$id";
        $result = mysqli_query($conexao, $sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $nome = $user_data['nome'];
                $dataNascimento = $user_data['dataNascimento'];
                $nomeMaterno = $user_data['nomeMaterno'];
                $cpf = $user_data['cpf'];
                $numeroCelular = $user_data['numeroCelular'];
                $numeroFixo = $user_data['numeroFixo'];
                $rua = $user_data['rua'];
                $numero = $user_data['numero'];
                $bairro = $user_data['bairro'];
                $cidade = $user_data['cidade'];
                $uf = $user_data['uf'];
                $pais = $user_data['pais'];
                $login = $user_data['login'];                
                $senha = $user_data['senha'];             
            }            
        }
        else
        {
            header('Location: ../dev.php');
        }
    }

    //Comandos para editar
if(isset($_POST['update']))
    {
        $id = $_POST['idusuarios'];
        $nome = $_POST['nome'];
        $dataNascimento = $_POST['dataNascimento'];
        $nomeMaterno = $_POST['nomeMaterno'];
        //$cpf = $_POST['cpf'];
        $numeroCelular = $_POST['numeroCelular'];
        $numeroFixo = $_POST['numeroFixo'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $pais = $_POST['pais'];
        //$login = $_POST['login'];
        $senha = $_POST['senha'];
        $senha2 = $_POST['senha2'];
                 
        //Condicional para comparar se a senha digitada foi a mesma
        if($senha == $senha2){
        //Sessão para atualizar o nome na página de dados
        $_SESSION['nome'] = $nome;

        $sqlUpdate = "UPDATE usuarios SET nome='$nome',dataNascimento='$dataNascimento', nomeMaterno='$nomeMaterno'
        , numeroCelular='$numeroCelular', numeroFixo='$numeroFixo', rua='$rua',
        numero='$numero', bairro='$bairro', cidade='$cidade',
        uf='$uf', pais='$pais', senha='$senha' WHERE idusuarios='$id'";
        $result = mysqli_query($conexao, $sqlUpdate);
        header('Location: ../sistema.php');
    }else{
        echo "<script language='javascript' type='text/javascript'>alert('Senhas não idênticas');</script>";
    }
}

?>
<!doctype html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

    <title>Editar</title>
  </head>
  <body>
    <div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="needs-validation" novalidate>
        <legend align='center'><h3 class="rounded-pill" style="background-color: black;color: white;">Editar</h3></legend>
            <br>
            <div class="form-group text-center">
            <label for="nome"><h5>Nome completo</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $nome ?>" name="nome" id="nome"required maxlength="100" minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="dataNascimento"><h5>Data de nascimento</h5></label>
                <input type="date" class="form-control text-center border border-dark rounded-pill" value="<?php echo $dataNascimento ?>" name="dataNascimento" id="dataNascimento" min="1900-01-01" max="2010-01-01" required>
                <div class="invalid-feedback">
                Insira uma data de nascimento válida.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="nomeMaterno"><h5>Nome materno</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $nomeMaterno ?>" name="nomeMaterno" id="nomeMaterno" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="cpf"><h5>CPF</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['cpf'] ?>" name="cpf" id="cpf" maxlength="11" minlength="11" required disabled>
                <div class="invalid-feedback">
                Insira um CPF válido<br><br>
                </div>
            </div>
            <div class="row text-center" >
            <div class="col">
            <label for="numeroCelular"><h5>Número de celular</h5></label>
                <input type="tel" class="form-control text-center border border-dark rounded-pill" value="<?php echo $numeroCelular ?>" name="numeroCelular" id="numeroCelular" maxlength="15" minlength="9" required>
                <div class="invalid-feedback">
                Insira um número de celular válido.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="numeroFixo"><h5>Número de telefone</h5></label>
                <input type="tel" class="form-control text-center border border-dark rounded-pill" name="numeroFixo" value="<?php echo $numeroFixo; ?>" id="numeroFixo" maxlength="15" minlength="8" required>
                <div class="invalid-feedback">
                Insira um número de telefone válido.<br><br>
                </div>
            </div>
            </div>
            <div class="row text-center">
            <div class="col">
            <label for="rua"><h5>Rua</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $rua ?>" name="rua" id="rua" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="numero"><h5>Número</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $numero ?>" name="numero" id="numero" maxlength="20" required minlength="1">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            </div>
            <div class="form-group text-center">
            <label for="bairro"><h5>Bairro</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $bairro ?>" name="bairro" id="bairro" class="inputUser" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="row text-center">
            <div class="col">
            <label for="cidade"><h5>Cidade</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $cidade ?>" name="cidade" id="cidade" maxlength="50" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="uf"><h5>UF</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $uf ?>" name="uf" id="uf" maxlength="2" minlength="2" required>
                <div class="invalid-feedback">
                Preencha o campo<br><br>
                </div>
            </div>
            </div>
            <div class="form-group text-center">
            <label for="pais"><h5>País</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $pais ?>" name="pais" id="pais" maxlength="50" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="login"><h5>Login</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" value="<?php echo $_SESSION['login'] ?>" name="login" id="login" maxlength="25" required minlength="2" disabled>
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
            </div>
            <br>
            <div align='center'>
            <input type="hidden" name="idusuarios" value=<?php echo $id;?>>
            <input type="submit" name="update" id="update" value="Guardar" class="btn btn-primary">
            <a href="../sistema.php" class="btn btn-secondary">Voltar</a>
            </div>
            <div>
            
        </form>
    </div>
</body>
<script src="../js/form.js"></script>
</html>