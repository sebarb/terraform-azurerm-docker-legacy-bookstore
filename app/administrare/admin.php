<?php

require 'autorizare.php';
include 'admin_top.php';

$counts = [];

foreach (['carti', 'autori', 'domenii', 'comentarii', 'vanzari'] as $table) {
    $counts[$table] = (int)$pdo
        ->query("SELECT COUNT(*) FROM $table")
        ->fetchColumn();
}

?>

<h2>Panou de administrare</h2>

<p>
    Bine ai venit,
    <strong><?= h($_SESSION['nume_admin']) ?></strong>.
</p>

<div class="admin-cards">

    <div class="admin-card">
        <div class="admin-card-label">Cărți</div>
        <div class="admin-card-value"><?= $counts['carti'] ?></div>
    </div>

    <div class="admin-card">
        <div class="admin-card-label">Autori</div>
        <div class="admin-card-value"><?= $counts['autori'] ?></div>
    </div>

    <div class="admin-card">
        <div class="admin-card-label">Domenii</div>
        <div class="admin-card-value"><?= $counts['domenii'] ?></div>
    </div>

    <div class="admin-card">
        <div class="admin-card-label">Comentarii</div>
        <div class="admin-card-value"><?= $counts['comentarii'] ?></div>
    </div>

    <div class="admin-card">
        <div class="admin-card-label">Vânzări</div>
        <div class="admin-card-value"><?= $counts['vanzari'] ?></div>
    </div>

</div>

</main>
</body>
</html>