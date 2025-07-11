<?php
$codigo = $_GET['codigo'];

$link = mysqli_connect("localhost", "root", "udesc", "banco");

$query = "DELETE FROM banco WHERE id='$codigo'";
mysqli_query($link, $query);
mysqli_close($link);

header("Location: mostrar_cadastro.php");
exit;
?>
