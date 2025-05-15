<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/icons/logo.png" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>API</title>

</head>

<body>

    <header class="w3-bar w3-blue w3-padding">
        <a href="/" class="w3-bar-item w3-btn">Inici</a>
        <a href="/create_user" class="w3-bar-item w3-btn">Registre</a>
        <a href="/login" class="w3-bar-item w3-btn">Login</a>
        <a href="/logged" class="w3-bar-item w3-btn">Logged</a>
        <a href="/update_user" class="w3-bar-item w3-btn">Update User</a>
        <a href="/logout" class="w3-bar-item w3-btn">Logout</a>
        <a href="/config_game" class="w3-bar-item w3-btn">Config Game</a>
        <a href="/update_config_game" class="w3-bar-item w3-btn">Update Config Game</a>
        <a href="/create_game" class="w3-bar-item w3-btn">Create Game</a>
        <a href="/get_user_last_games" class="w3-bar-item w3-btn">Get User Last Games</a>
        <a href="/get_user_stats" class="w3-bar-item w3-btn">Get User Stats</a>
        <a href="/get_top_users" class="w3-bar-item w3-btn">Get Top Users</a>
    </header>

    <?= $this->renderSection('content') ?>






</body>

</html>