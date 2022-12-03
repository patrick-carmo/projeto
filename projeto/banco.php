<?php
session_start();

if(!isset($_SESSION['perfilAcesso'])){
    session_destroy();
    header('location: index.php');
}
include_once 'barra.php';

?>

<html>
<head>
    <meta charset="utf-8">
<body>
</div>
<div align='center'>
<img src="img/banco.png" width="800">
</div>
<div align='center'>
<button type='button' class="btn btn-secondary btn-lg btn-block" data-bs-toggle='modal' data-bs-target='#exampleModal'>
Comentário
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comentário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
        <p>Basicamente eu segui o enunciado e coloquei todos os atributos pedidos para a tabela dos usuarios e acrescentei o de perfilAcesso para controlar as páginas.
</p>
<p>Eu não vi a necessidade de mais de duas tabelas para o que eu tinha em mente, então coloquei todos os atributos sobre os usuarios na própria tabela usuarios.</p>
<p>Deixei definido um limite de armazenamento para os atributos em varchar e deixei como "NULL" os campos aos quais não são obrigatórios para o login</p>
<p>O modelo possui uma relação de 1 para N, um cliente pode ter muitos logs.</p>
<p>Pensei em não fazer um modelo relacional, mas não faria muito sentido excluir o usuário e deixar os logs no banco sem o ID do usuário.<br>
Eu também não quis criar uma query para excluir os dois juntos, pois para mim também não faz sentido o usuário poder excluir a própria conta e levar as informações junto.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="js/bootstrap.js"></script>
</head>
</html>