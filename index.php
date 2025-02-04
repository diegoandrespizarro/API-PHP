<?php
// Definir la URL de la API
define('API_URL', 'https://whenisthenextmcufilm.com/api');

// Iniciar la petición cURL; ch = curl handle
$ch = curl_init(API_URL);

// Indicar que queremos recibir el resultado de la petición y no imprimirlo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Desactivar la verificación del certificado SSL (solo para pruebas locales)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// Ejecutar la petición y guardar el resultado
$result = curl_exec($ch);

// Verificar si hubo un error en la ejecución de la petición
if ($result === false) {
    echo 'Error en la petición cURL: ' . curl_error($ch);
} else {
    $data = json_decode($result, true);
}

// Cerrar la sesión cURL
curl_close($ch);
?>

<head>
    <meta charset="UTF-8">
    <title>La próxima película de Marvel</title>
    <meta name="description" content="Descubre cuál es la próxima película de Marvel">
    <meta name="author" content="Diego Pizarro">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
>
</head>
<main>
    <section><img src="<?= $data['poster_url']; ?>" width="300" alt="Poster de <?= $data['title']; ?>"
    style="border-radius: 16px"/></section>
    <hgroup>
    <h3><?= $data["title"]; ?> </h3>
    <p>Fecha de estreno: <?= $data["release_date"]; ?> </p>
    <p>La siguiente es: <strong><?php echo $data['following_production']["title"]; ?></strong> y se estrenará el <strong><?php echo $data['release_date']; ?></strong>.</p>
    </hgroup>
</main>

<style>
    :root{
        color-scheme: light dark;
    }
    body{
        display: grid;
        place-content: ceneter;
    }
    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }
    hgroup{
        display: flex;
        justify-content: center;
        flex-direction: column;
        text-align: center;
    }
    img{
        margin: 0 auto;
    }
</style>