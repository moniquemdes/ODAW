<?php

include("site1_detalhes.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$nascimento = $_POST['nascimento'];
$usuario  = $_POST['usuario'];
$senha  = $_POST['senha'];


$link = mysqli_connect("localhost", "root", "udesc", "banco");


if (!$link) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

$query = "INSERT INTO banco (nome, telefone, email, nascimento, usuario, senha) VALUES ('$nome', '$telefone', '$email', '$nascimento',
'$usuario', '$senha')";
echo "INSERT: $query<br><hr>";
mysqli_query($link, $query);
mysqli_close($link);
			
?>
