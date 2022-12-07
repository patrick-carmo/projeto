<?php
session_start();
include_once('connect.php');
include_once('barra.php');

//"barra.php" faz o controle de acesso, não tem como entrar nesta página sem a sessão "perfilAcesso"

?>

<html>
  <head>
  <meta charset="utf-8">
    <body>
      <table align="center">
        <tr>
          <th colspan="2"><h3 align='center'>Patrick J. do Carmo da Silva</h3></th>
        </tr>
        <tr>
        <td colspan="2"><img src="img/dev.jpg" width="350" class="rounded-5">
        </td>
        </tr>
        <tr>
          <td align="center" colspan="2"><h4>Não fiz o módulo 1</h4></td>
        </tr>
        <tr>
          <td align="center"><a href="banco.php" class="btn btn-secondary">Banco</a>
          <a href="query.php" class="btn btn-secondary">Query</a></td>
        </tr>

      </table>
    </body>
  </head>
</html>