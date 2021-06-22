<?php
    if(!(isset($_GET['code'])))
    {
        header("Location: http://./index.php");
    }
? >
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Log in</h1>
    <form action="./admin_page.php" method="post">
    <p>introduce-ti parola:</p>
    <input type="password" name="pwd" id="" required>
    <button type="submit">Apasa</button>
    </form>
</body>
</html>