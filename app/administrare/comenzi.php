<?php

require 'autorizare.php';

$rows = $pdo->query(
    'SELECT
        c.titlu,
        SUM(v.nr_buc) AS bucati
     FROM vanzari v
     JOIN carti c ON c.id_carte = v.id_carte
     GROUP BY c.id_carte, c.titlu
     ORDER BY bucati DESC'
)->fetchAll();

include 'admin_top.php';

?>

<h2>Vânzări</h2>

<p>
    Situația cumulată a vânzărilor pentru cărțile din catalog.
</p>

<div class="admin-table-wrap">

    <table class="admin-table">

        <thead>
            <tr>
                <th>Carte</th>
                <th>Bucăți vândute</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!$rows): ?>

            <tr>
                <td colspan="2">
                    Nu există vânzări înregistrate.
                </td>
            </tr>

        <?php else: ?>

            <?php foreach ($rows as $r): ?>

                <tr>
                    <td>
                        <strong><?= h($r['titlu']) ?></strong>
                    </td>

                    <td>
                        <?= (int)$r['bucati'] ?>
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