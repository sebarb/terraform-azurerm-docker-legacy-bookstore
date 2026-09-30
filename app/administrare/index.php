<!doctype html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrare - Librăria virtuală</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

<div class="login-page">

    <div class="login-card">

        <h1>Administrare</h1>
        <p class="subtitle">Librăria virtuală</p>

        <form action="login.php" method="post">

            <div class="form-group">
                <label for="nume">Utilizator</label>
                <input
                    id="nume"
                    type="text"
                    name="nume"
                    autocomplete="username"
                    required
                >
            </div>

            <div class="form-group">
                <label for="parola">Parolă</label>
                <input
                    id="parola"
                    type="password"
                    name="parola"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit">Autentificare</button>

        </form>

    </div>

</div>

</body>
</html>