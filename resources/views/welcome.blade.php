<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=7, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina principale</title>
</head>
<body>
    <h1>Pagina principale</h1>
    @php
        $benvenuto = "Benvenuto"; 
        if(isset($_SESSION["nickname"])){
            $benvenuto .= " " . $_GET["nickname"]; 
        }else{
            $benvenuto .= " Anonymous"; 
        }
        echo $benvenuto; 
    @endphp
</body>
</html>