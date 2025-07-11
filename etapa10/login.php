<?php
$erro_login = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $linhas = file("autenticacao.txt");

    $autenticado = false;

    foreach ($linhas as $linha) {
        list($usuario_arquivo, $senha_hash) = explode("|", trim($linha));
        if ($usuario === $usuario_arquivo && password_verify($senha, $senha_hash)) {
            $autenticado = true;
            break;
        }
    }

    if ($autenticado) {
        $mensagem = "Login realizado com sucesso!";
    } else {
        $erro_login = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login ENLIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container my-5">
    <h1 class="text-center display-4 mb-4">Login ENLIC</h1>

    <?php if (!empty($erro_login)): ?>
        <div class="alert alert-danger"><?= $erro_login ?></div>
    <?php elseif (!empty($mensagem)): ?>
        <div class="alert alert-success"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
</body>
</html>
