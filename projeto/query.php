<?php

session_start();
if(!isset($_SESSION['perfilAcesso'])){
    session_destroy();
    header('location: index.php');
}
include_once ('barra.php');

?>
<html>
<head>
    <meta charset="utf-8">
<body>
    
<table class="table table-hover" align="center">
    <thead class="table-dark">
    <h4 align='center' style="background-color: slategrey; color:black; ">Clique nos links para mais detalhes</h4><br>
    <tr>
        <th>crud/cadastrar.php</th>
        <th>crud/delete.php</th>
        <th>crud/editar.php</th>
        <th>logs/download.php</th>
        <th>logs/logs.php</th>
        <th>2fa.php</th>
        <th>sistema.php</th>
        <th>testLogin.php</th>
        <th>ativar.php</th>
    </tr>
    </thead>
    <tbody>
    <tr class="table-group-divider">
        <td><a href="img/cadastrar.png" class="btn btn-secondary" target="blank">SELECT/INSERT 1</a><br><br><a href="img/cadastrar2.png" class="btn btn-secondary" target="blank">INSERT 2</a></td>
        <td><a href="img/deletar.php.png" class="btn btn-secondary" target="blank">SELECT/UPDATE</a></td>
        <td><a href="img/editar2.php.png" class="btn btn-secondary" target="blank">SELECT</a><br><br><a href="img/editar.php.png" class="btn btn-secondary" target="blank">UPDATE</a></td>
        <td><a href="img/download.php.png" class="btn btn-secondary" target="blank">SELECT</a></td>
        <td><a href="img/logs.png" class="btn btn-secondary" target="blank">SELECT</a></td>
        <td><a href="img/aut.php.png" class="btn btn-secondary" target="blank">INSERT</a><br><br><a href="img/aut.png" class="btn btn-secondary" target="blank">SELECT</a></td>
        <td><a href="img/sistema.png" class="btn btn-secondary" target="blank">SELECT 1</a><br><br><a href="img/sistema2.png" class="btn btn-secondary" target="blank">SELECT 2</a></td>
        <td><a href="img/testLogin.php.png" class="btn btn-secondary" target="blank">SELECT</a></td>
        <td><a href="img/ativar.php.png" class="btn btn-secondary" target="blank">SELECT</a></td>
    </tr>
    </tbody>
</table>
</table>
</body>
</head>
</html>