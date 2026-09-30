<?php

require 'autorizare.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title  = trim($_POST['titlu'] ?? '');
    $author = trim($_POST['autor'] ?? '');
    $domain = trim($_POST['domeniu'] ?? '');
    $desc   = trim($_POST['descriere'] ?? '');
    $price  = (float)($_POST['pret'] ?? 0);

    if ($title && $author && $domain) {

        $pdo->beginTransaction();

        $s = $pdo->prepare(
            'SELECT id_autor FROM autori WHERE nume_autor = ?'
        );
        $s->execute([$author]);
        $aid = $s->fetchColumn();

        if (!$aid) {
            $s = $pdo->prepare(
                'INSERT INTO autori (nume_autor) VALUES (?)'
            );
            $s->execute([$author]);
            $aid = $pdo->lastInsertId();
        }

        $s = $pdo->prepare(
            'SELECT id_domeniu FROM domenii WHERE nume_domeniu = ?'
        );
        $s->execute([$domain]);
        $did = $s->fetchColumn();

        if (!$did) {
            $s = $pdo->prepare(
                'INSERT INTO domenii (nume_domeniu) VALUES (?)'
            );
            $s->execute([$domain]);
            $did = $pdo->lastInsertId();
        }

        $s = $pdo->prepare(
            'INSERT INTO carti
             (id_autor, id_domeniu, titlu, descriere, pret, data)
             VALUES (?, ?, ?, ?, ?, NOW())'
        );

        $s->execute([
            $aid,
            $did,
            $title,
            $desc,
            $price
        ]);

        $pdo->commit();

        $msg = 'Cartea a fost adăugată.';
    }
}

include 'admin_top.php';

?>

<h2>Adaugă o carte</h2>

<?php if ($msg !== ''): ?>

    <div class="admin-message">
        <?= h($msg) ?>
    </div>

<?php endif; ?>

<form method="post" class="admin-form">

    <div class="form-group">
        <label for="titlu">Titlu</label>
        <input
            id="titlu"
            name="titlu"
            type="text"
            required
        >
    </div>

    <div class="form-group">
        <label for="autor">Autor</label>
        <input
            id="autor"
            name="autor"
            type="text"
            required
        >
    </div>

    <div class="form-group">
        <label for="domeniu">Domeniu</label>
        <input
            id="domeniu"
            name="domeniu"
            type="text"
            required
        >
    </div>

    <div class="form-group">
        <label for="pret">Preț</label>
        <input
            id="pret"
            name="pret"
            type="number"
            min="0"
            step="0.01"
            required
        >
    </div>

    <div class="form-group">
        <label for="descriere">Descriere</label>
        <textarea
            id="descriere"
            name="descriere"
            rows="8"
        ></textarea>
    </div>

    <button type="submit">
        Adaugă cartea
    </button>

</form>

</main>
</body>
</html>