<?php
use App\App;

require __DIR__ . '/vendor/autoload.php';

App::run();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>jsonplaceholder</title>
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>

<body>
    <form method="post">
        <input type="text" name="body" placeholder="Введите текст"><br>
        <input type="submit" value="Найти">
    </form>
</body>

</html>