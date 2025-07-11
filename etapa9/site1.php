<?php
session_start();


session_unset();
session_destroy();

function mostrarDataHora() {
    date_default_timezone_set('America/Sao_Paulo');
    return "Hoje é " . date('d/m/Y') . " e agora são " . date('H:i') . "h";
}

function processarTexto($texto) {
    return strtoupper($texto);
}

function contarVisitas() {
    $arquivo = 'contador.txt'; 
    $visitas = file_exists($arquivo) ? (int)file_get_contents($arquivo) : 0; 

    $visitas = $visitas + 1; 

    file_put_contents($arquivo, $visitas); 
    return $visitas;
}


function gerenciarCookieSession() {
        $cookie_name = "user";
    $cookie_value = "Monique";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    if(!isset($_COOKIE[$cookie_name])) {
        echo "Cookie named '" . $cookie_name . "' is not set!";
      } else {
        echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value is: " . $_COOKIE[$cookie_name];
      }
}


$dataHora = mostrarDataHora();
$textoOriginal = "agora temos php";
$textoProcessado = processarTexto($textoOriginal);
$visitas = contarVisitas();
$cookieSession = gerenciarCookieSession();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Eventos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="estilo.css">

</head>
<body>

   <div class="container my-5">

        <!-- meu php -->
        <div class="destaque"><?= $dataHora ?></div>

       
        <p><strong>Texto original:</strong> <?= $textoOriginal ?></p>
        <p><strong>Texto processado:</strong> <span class="destaque"><?= $textoProcessado ?></span></p>

        <p> <strong>Esta página foi visitada </strong><strong><?= $visitas ?></strong> vezes.</p>

        <!-- fim php-->

        <h1 class="text-center titulo-destaque mb-5">Eventos</h1>

        <!-- Evento 1 -->
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="enlic.jpg" class="img-fluid rounded-start" alt="IV ENLIC">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h2 class="card-title">IV Encontro das Licenciaturas da Região Sul (ENLIC)</h2>
                        <p><strong>Data:</strong> 17-19/03</p>
                        <p><strong>Local:</strong> Universidade de Santa Catarina - UDESC</p>

                        <h5>O que você encontrará no evento?</h5>
                        <ul>
                            <li>Palestras com especialistas</li>
                            <li>Workshops interativos</li>
                            <li>Oportunidade de networking</li>
                        </ul>

                        <a href="site1_detalhes.html" class="btn btn-primary mt-3">Mais detalhes e inscrição</a>
                    </div>
                </div>
            </div>
        </div>

         <!-- para separar eventos-->
        <svg width="100%" height="10">
            <line x1="0" y1="0" x2="100%" y2="0" stroke="white" stroke-width="2" />
        </svg>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Digital Summit</h2>
                <div class="ratio ratio-16x9 mb-3">
                    <iframe src="https://www.youtube.com/embed/U_VQSNdZITE" allowfullscreen></iframe>
                </div>
                <p><strong>Data:</strong> 24-26/05</p>
                <p><strong>Local:</strong> Plataforma Online</p>

                <h5>O que você encontrará no evento?</h5>
                <ul>
                    <li>Painéis de discussão sobre as últimas tendências digitais</li>
                    <li>Acesso a conteúdos exclusivos e insights estratégicos</li>
                    <li>Oportunidades de networking com profissionais do setor</li>
                </ul>
            </div>
        </div>


        <footer>
            <p>&copy; 2025 - Todos os direitos reservados</p>
        </footer>
    </div>


</body>
</html>

<!-- PARA RODAR:
php site1.php
php -S localhost:8000
em qualqur url: http://localhost:8000/site1.php
