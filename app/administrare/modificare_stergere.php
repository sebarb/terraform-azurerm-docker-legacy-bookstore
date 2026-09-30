<?php

require 'autorizare.php';

if (isset($_POST['sterge'])) {
    $id = (int)$_POST['sterge'];

    $s = $pdo->prepare(
        'DELETE FROM carti WHERE id_carte = ?'
    );
    $s->execute([$id]);
}

if (isset($_POST['salveaza'])) {
    $id = (int)$_POST['salveaza'];

    $s = $pdo->prepare(
        'UPDATE carti
         SET titlu = ?, descriere = ?, pret = ?
         WHERE id_carte = ?'
    );

    $s->execute([
        trim($_POST['titlu'][$id] ?? ''),
        trim($_POST['descriere'][$id] ?? ''),
        (float)($_POST['pret'][$id] ?? 0),
        $id
    ]);
}

$rows = $pdo->query(
    'SELECT
        c.id_carte,
        c.titlu,
        c.descriere,
        c.pret,
        a.nume_autor,
        d.nume_domeniu
     FROM carti c
     JOIN autori a ON a.id_autor = c.id_autor
     JOIN domenii d ON d.id_domeniu = c.id_domeniu
     ORDER BY c.titlu'
)->fetchAll();

include 'admin_top.php';

?>

<h2>Cărți</h2>

<p>
    Modifică informațiile unei cărți sau elimină o carte din catalog.
</p>

<form method="post">

    <div class="admin-table-wrap">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>Carte</th>
                    <th>Autor / domeniu</th>
                    <th>Descriere</th>
                    <th>Preț</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($rows as $r): ?>
                <?php $id = (int)$r['id_carte']; ?>

                <tr>

                    <td>
                        <input
                            type="text"
                            name="titlu[<?= $id ?>]"
                            value="<?= h($r['titlu']) ?>"
                        >
                    </td>

                    <td>
                        <strong><?= h($r['nume_autor']) ?></strong>
                        <br>
                        <?= h($r['nume_domeniu']) ?>
                    </td>

                    <td>
                        <textarea
                            name="descriere[<?= $id ?>]"
                            rows="4"
                        ><?= h($r['descriere']) ?></textarea>
                    </td>

                    <td>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="pret[<?= $id ?>]"
                            value="<?= h($r['pret']) ?>"
                        >
                    </td>

                    <td>
                        <button
                            type="submit"
                            name="salveaza"
                            value="<?= $id ?>"
                        >
                            Salvează
                        </button>

                        <button
                            type="submit"
                            name="sterge"
                            value="<?= $id ?>"
                            onclick="return confirm('Ștergi această carte?')"
                        >
                            Șterge
                        </button>
                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</form>

</main>
</body>
</html>