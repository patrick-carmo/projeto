<?php
    if(isset($_POST['submit']))
    {
        //Pego todos os campos que foram preenchidos no cadastro e adiciono nas variáveis
        include_once('../connect.php');
        $nome = mysqli_escape_string($conexao, $_POST['nome']);
        $dataNascimento= mysqli_escape_string($conexao, $_POST['dataNascimento']);
        $nomeMaterno = mysqli_escape_string($conexao, $_POST['nomeMaterno']);
        $cpf = mysqli_escape_string($conexao, $_POST['cpf']);
        $numeroCelular= mysqli_escape_string($conexao, $_POST['numeroCelular']);
        $numeroFixo = mysqli_escape_string($conexao, $_POST['numeroFixo']);
        $rua = mysqli_escape_string($conexao, $_POST['rua']);
        $numero = mysqli_escape_string($conexao, $_POST['numero']);
        $bairro = mysqli_escape_string($conexao, $_POST['bairro']);
        $cidade = mysqli_escape_string($conexao, $_POST['cidade']);
        $uf = mysqli_escape_string($conexao, $_POST['uf']);
        $pais = mysqli_escape_string($conexao, $_POST['pais']);
        $login = mysqli_escape_string($conexao, $_POST['login']);
        $senha = mysqli_escape_string($conexao, $_POST['senha']);
        $senha2 = mysqli_escape_string($conexao, $_POST['senha2']);

        //$teste = mysqli_escape_string($conexao, $_POST['senha']);
        //$teste2 = mysqli_escape_string($conexao, $_POST['senha2']);
        //$senha = md5($teste);
        //$senha2 = md5($teste2);

        $select = "SELECT * FROM usuarios WHERE login ='$login'";
        $select2 = "SELECT * FROM usuarios";
        //dados serve para cadastrar usuários comuns e ver se o login já foi cadastrado
        $dados = mysqli_query($conexao, $select);
        //dados2 serve para colocar o primeiro usuário cadastrado como Master
        $dados2 = mysqli_query($conexao, $select2);
        $teste = mysqli_fetch_array($dados);

        //Cadastro do usuário Master, o perfilAcesso leva o valor 1
        if(mysqli_num_rows($dados2) < 1){
            $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,dataNascimento,nomeMaterno,
            cpf,numeroCelular,numeroFixo,rua,numero,bairro,cidade,uf,pais,login,senha,perfilAcesso) 
            VALUES('$nome','$dataNascimento','$nomeMaterno','$cpf',
            '$numeroCelular','$numeroFixo','$rua','$numero','$bairro','$cidade','$uf','$pais','$login','$senha',1)");
            echo "<script language='javascript' type='text/javascript'>alert('Usuário Master com sucesso');window.location.href='../index.php';</script>";
        }else{

        //Caso haja um login com o mesmo nome de usuário ou a senha digitada não seja a mesma, ele não é cadastrado.
        if(($teste['login'] == $login) or ($senha != $senha2)){

            //As sessões são para não ter que digitar novamente os campos
            //Após isso, o usuário é redirecionado para a página "reaproveita.php" com todos os campos preenchidos, exceto a senha
            session_start();
            $_SESSION['nome'] = $nome;
            $_SESSION['dataNascimento'] = $dataNascimento;
            $_SESSION['nomeMaterno'] = $nomeMaterno;
            $_SESSION['cpf'] = $cpf;
            $_SESSION['numeroCelular'] = $numeroCelular;
            $_SESSION['numeroFixo'] = $numeroFixo;
            $_SESSION['rua'] = $rua;
            $_SESSION['numero'] = $numero;
            $_SESSION['bairro'] = $bairro;
            $_SESSION['cidade'] = $cidade;
            $_SESSION['uf'] = $uf;
            $_SESSION['pais'] = $pais;
            $_SESSION['login'] = $login;
            
            //Condicional para exibir a mensagem na página sobre qual foi o problema
            if($teste['login'] == $login){
                $_SESSION['status'] = "Login já utilizado";
                header('location: ../reaproveita.php');
            }elseif(($senha != $senha2)){
                $_SESSION['status'] = "Senhas não idênticas";
                header('location: ../reaproveita.php');
            }
        
        //Cadastro do usuário comum - todo usuário comum leva o valor "2" no perfilAcesso para controlar os acessos
        }else{
            if(($_POST['senha'])==($_POST['senha2'])){
            $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,dataNascimento,nomeMaterno,
            cpf,numeroCelular,numeroFixo,rua,numero,bairro,cidade,uf,pais,login,senha,perfilAcesso) 
            VALUES('$nome','$dataNascimento','$nomeMaterno','$cpf',
            '$numeroCelular','$numeroFixo','$rua','$numero','$bairro','$cidade','$uf','$pais','$login','$senha',2)");

            //retorna para a página login
            echo "<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso');window.location.href='../index.php';</script>";
        }
        }}
    }
    


?>
<!doctype html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <title>Cadastrar</title>
  <body>
  <div class="form">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="needs-validation" novalidate>
        <legend align='center'><h3 class="rounded-pill" style="background-color: black;color: white;">Cadastrar</h3></legend>
            <br>
            <div class="form-group text-center">
            <label for="nome"><h5>Nome completo</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="nome" id="nome"required maxlength="100" minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="dataNascimento"><h5>Data de nascimento</h5></label>
                <input type="date" class="form-control text-center border border-dark rounded-pill" name="dataNascimento" id="dataNascimento" min="1900-01-01" max="2010-01-01" required>
                <div class="invalid-feedback">
                Insira uma data de nascimento válida.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="nomeMaterno"><h5>Nome materno</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="nomeMaterno" id="nomeMaterno" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="cpf"><h5>CPF</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="cpf" id="cpf" maxlength="11" minlength="11" required>
                <div class="invalid-feedback">
                Insira um CPF válido<br><br>
                </div>
            </div>
            <div class="row text-center" >
            <div class="col">
            <label for="numeroCelular"><h5>Número de celular</h5></label>
                <input type="tel" class="form-control text-center border border-dark rounded-pill" name="numeroCelular" id="numeroCelular" maxlength="15" minlength="9" required>
                <div class="invalid-feedback">
                Insira um número de celular válido.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="numeroFixo"><h5>Número de telefone</h5></label>
                <input type="tel" class="form-control text-center border border-dark rounded-pill" name="numeroFixo" id="numeroFixo" maxlength="15" minlength="8" required>
                <div class="invalid-feedback">
                Insira um número de telefone válido.<br><br>
                </div>
            </div>
            </div>
            <div class="row text-center">
            <div class="col">
            <label for="rua"><h5>Rua</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="rua" id="rua" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="numero"><h5>Número</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="numero" id="numero" maxlength="20" required minlength="1">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            </div>
            <div class="form-group text-center">
            <label for="bairro"><h5>Bairro</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="bairro" id="bairro" class="inputUser" maxlength="100" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="row text-center">
            <div class="col">
            <label for="cidade"><h5>Cidade</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="cidade" id="cidade" maxlength="50" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="col">
            <label for="uf"><h5>UF</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="uf" id="uf" maxlength="2" minlength="2" required>
                <div class="invalid-feedback">
                Preencha o campo<br><br>
                </div>
            </div>
            </div>
            <div class="form-group text-center">
            <label for="pais"><h5>País</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="pais" id="pais" maxlength="50" required minlength="2">
                <div class="invalid-feedback">
                Preencha o campo.<br><br>
                </div>
            </div>
            <div class="form-group text-center">
            <label for="login"><h5>Login</h5></label>
                <input type="text" class="form-control text-center border border-dark rounded-pill" name="login" id="login" maxlength="25" required minlength="2">
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
            <input type="submit" name="submit" id="submit" class="btn btn-primary">
            <a href="../index.php" class="btn btn-secondary">Voltar</a>
            <div>
            
        </form>
    </div>
</body>
<script src="../js/form.js"></script>
</head>
</html>