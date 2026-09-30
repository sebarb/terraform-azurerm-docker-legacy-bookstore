<?php

require 'autorizare.php';

if (isset($_POST['sterge'])) {
    $id = (int)$_POST['sterge'];

    $s = $pdo->prepare(
        'DELETE FROM comentarii WHERE id_comentariu = ?'
    );
    $s->execute([$id]);
}

$rows = $pdo->query(
    'SELECT
        co.id_comentariu,
        co.nume_utilizator,
        co.adresa_email,
        co.comentariu,
        c.titlu
     FROM comentarii co
     JOIN carti c ON c.id_carte = co.id_carte
     ORDER BY co.id_comentariu DESC'
)->fetchAll();

include 'admin_top.php';

?>

<h2>Opinii</h2>

<p>
    Comentariile trimise de utilizatori pentru cărțile din catalog.
</p>

<div class="admin-table-wrap">

    <table class="admin-table">

        <thead>
            <tr>
                <th>Carte</th>
                <th>Utilizator</th>
                <th>Comentariu</th>
                <th>Acțiuni</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!$rows): ?>

            <tr>
                <td colspan="4">
                    Nu există comentarii.
                </td>
            </tr>

        <?php else: ?>

            <?php foreach ($rows as $r): ?>

                <tr>

                    <td>
                        <strong><?= h($r['titlu']) ?></strong>
                    </td>

                    <td>
                        <?= h($r['nume_utilizator']) ?>
                        <br>
                        <small><?= h($r['adresa_email']) ?></small>
                    </td>

                    <td>
                        <?= nl2br(h($r['comentariu'])) ?>
                    </td>

                    <td>
                        <form method="post">
                            <button
                                type="submit"
                                name="sterge"
                                value="<?= (int)$r['id_comentariu'] ?>"
                                onclick="return confirm('Ștergi acest comentariu?')"
                            >
                                Șterge
                            </button>
                        </form>
                    </td>

                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</main>
</body>
</html>