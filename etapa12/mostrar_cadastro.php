<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$link = mysqli_connect("localhost", "root", "udesc", "banco");

$query = "SELECT * FROM banco ORDER BY nome";
$result = mysqli_query($link, $query);

if (!$result) {
    die("Erro na consulta ao banco: " . mysqli_error($link));
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

    <h1 class="mb-4">Cadastros Efetuados no IV ENLIC</h1>

    <?php if (mysqli_num_rows($result) == 0): ?>
        <div class="alert alert-warning">Nenhum cadastro encontrado.</div>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>Usuario</th>
                    <th>Senha</th>
                    <th>Alterações</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row["nome"]) ?></td>
                    <td><?= htmlspecialchars($row["email"]) ?></td>
                    <td><?= htmlspecialchars($row["telefone"]) ?></td>
                    <td><?= htmlspecialchars($row["nascimento"]) ?></td>
                    <td><?= htmlspecialchars($row["usuario"]) ?></td>
                    <td><?= htmlspecialchars($row["senha"]) ?></td>
                    <td>
                        <a href="alterar.php?codigo=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                        <a href="deletar.php?codigo=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar este cadastro?')">Deletar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="site1_detalhes.php" class="btn btn-secondary mt-3">Voltar</a>
    
    <a href="deletar.php?codigo=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar este cadastro?')">Deletar</a>

</div>
</body>
</html>

<?php
mysqli_free_result($result);
mysqli_close($link);
?>
 