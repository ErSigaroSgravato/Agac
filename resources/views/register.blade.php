<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
</head>
<body>
    <h1>This is the Register</h1>

    <form method="post">
        @csrf
        <label for="nickname">nickname:</label>
        <input type="text" id="nickname" name="nickname" min="1" max="255">
        <label for="email">email:</label>
        <input type="email" id="email" name="email" min="1" max="255">
        <label for="password">password:</label>
        <input type="password" id="password" name="password" min="8">
                
        <input type="submit" value="Premimi">
    </form>
</body>
</html>

