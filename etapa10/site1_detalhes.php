<?php
$erros = [];
$dados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["nome"]))) {
        $erros[] = "O nome é obrigatório.";
    } else {
        $dados["nome"] = htmlspecialchars(trim($_POST["nome"]));
    }

    if (empty($_POST["email"])) {
        $erros[] = "O email é obrigatório.";
    } else {
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "O email informado é inválido.";
        } else {
            $dados["email"] = $email;
        }
    }

    if (!empty($_POST["nascimento"])) {
        $nascimento = $_POST["nascimento"];
        $hoje = date("Y-m-d");
        if ($nascimento >= $hoje) {
            $erros[] = "A data de nascimento deve ser anterior à data atual.";
        } else {
            $dados["nascimento"] = $nascimento;
        }
    } else {
        $erros[] = "A data de nascimento é obrigatória.";
    }

    if (empty($_POST["usuario"])) {
        $erros[] = "O login de usuário é obrigatório.";
    } else {
        $dados["usuario"] = $_POST["usuario"];
    }

    if (empty($_POST["senha"])) {
        $erros[] = "A senha é obrigatória.";
    } else {
        $dados["senha"] = password_hash($_POST["senha"], PASSWORD_DEFAULT); // Cifra a senha
    }

    $dados["telefone"] = $_POST["telefone"] ?? '';
    $dados["palestra"] = $_POST["palestra"] ?? '';
    $dados["newsletter"] = isset($_POST["newsletter"]) ? 'Sim' : 'Não';
    $dados["tipo"] = $_POST["tipo"] ?? '';
    $dados["comentarios"] = $_POST["comentarios"] ?? '';

    if (empty($erros)) {
        $linha = $dados["usuario"] . "|" . $dados["senha"] . PHP_EOL;
        file_put_contents("autenticacao.txt", $linha, FILE_APPEND);
    }
    
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>IV ENLIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="bg-dark text-white">

<div class="container my-5">


    <div class="container my-5 text-end">
        <a href="login.php" class="btn btn-primary">Login</a>
    </div>


    <h1 class="text-center display-1 mb-5">ENLIC</h1>


    <section class="mb-5">
        <h3>Inscrição</h3>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <?php if (!empty($erros)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($erros as $erro): ?>
                            <li><?= $erro ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="alert alert-success">
                    <h4>Inscrição realizada com sucesso!</h4>
                    <p><strong>Nome:</strong> <?= $dados["nome"] ?></p>
                    <p><strong>Email:</strong> <?= $dados["email"] ?></p>
                    <p><strong>Telefone:</strong> <?= $dados["telefone"] ?></p>
                    <p><strong>Data de Nascimento:</strong> <?= $dados["nascimento"] ?></p>
                    <p><strong>Palestra Escolhida:</strong> <?= $dados["palestra"] ?></p>
                    <p><strong>Receber Novidades:</strong> <?= $dados["newsletter"] ?></p>
                    <p><strong>Tipo:</strong> <?= $dados["tipo"] ?></p>
                    <p><strong>Comentários:</strong> <?= nl2br($dados["comentarios"]) ?></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo:</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            
            <div class="mb-3">
                <label for="usuario" class="form-label">Login de Usuário:</label>
                <input type="text" class="form-control" id="usuario" name="usuario">
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>


            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" pattern="[0-9]{10,11}" placeholder="Apenas números">
            </div>

            <div class="mb-3">
                <label for="nascimento" class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" id="nascimento" name="nascimento">
            </div>

            <div class="mb-3">
                <label for="palestra" class="form-label">Escolha sua palestra:</label>
                <select class="form-select" id="palestra" name="palestra">
                    <option value="mesa_redonda">Mesa-redonda: Educação e Tecnologia</option>
                    <option value="metodologias">Palestra: Metodologias Ativas</option>
                    <option value="debate">Debate e Perguntas</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter" checked>
                <label class="form-check-label" for="newsletter">Quero receber novidades por email</label>
            </div>

            <fieldset class="mb-3">
                <legend>Você é:</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="estudante" name="tipo" value="estudante">
                    <label class="form-check-label" for="estudante">Estudante</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="professor" name="tipo" value="professor">
                    <label class="form-check-label" for="professor">Professor</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="outro" name="tipo" value="outro">
                    <label class="form-check-label" for="outro">Outro</label>
                </div>
            </fieldset>

            <div class="mb-3">
                <label for="comentarios" class="form-label">Comentários ou dúvidas:</label>
                <textarea class="form-control" id="comentarios" name="comentarios" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Enviar Inscrição</button>
            <button type="reset" class="btn btn-secondary">Limpar Formulário</button>

        </form>
    </section>
</div>
</body>
</html>
