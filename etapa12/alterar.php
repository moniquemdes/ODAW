<?php
$codigo = $_GET['codigo'];

$link = mysqli_connect("localhost", "root", "udesc", "banco");

$query = "SELECT * FROM banco WHERE id='$codigo'";
$result = mysqli_query($link, $query);
$dados = mysqli_fetch_assoc($result);
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Alterar Cadastro</h1>
    <form method="POST" action="alterar.php">
        <input type="hidden" name="codigo" value="<?= $codigo ?>">
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?= $dados['nome'] ?>">
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= $dados['email'] ?>">
        </div>
        <div class="mb-3">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control" value="<?= $dados['telefone'] ?>">
        </div>
        <div class="mb-3">
            <label>Nascimento:</label>
            <input type="date" name="nascimento" class="form-control" value="<?= $dados['nascimento'] ?>">
        </div>
        <div class="mb-3">
            <label>Usuário:</label>
            <input type="text" name="usuario" class="form-control" value="<?= $dados['usuario'] ?>">
        </div>
        <div class="mb-3">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" value="<?= $dados['senha'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="mostrar_cadastro.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $usuario  = $_POST['usuario'];
    $senha  = $_POST['senha'];

    $link = mysqli_connect("localhost", "root", "udesc", "banco");

    $query = "UPDATE banco SET nome='$nome', telefone='$telefone', email='$email', nascimento='$nascimento', usuario='$usuario', senha='$senha' WHERE id='$codigo'";
    mysqli_query($link, $query);
    mysqli_close($link);

    header("Location: mostrar_cadastro.php");
    exit;
}
?>
