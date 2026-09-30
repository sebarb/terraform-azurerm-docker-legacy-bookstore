<aside class="sidebar">

    <h3>Explorează</h3>

    <div class="domain-list">
        <?php foreach ($pdo->query(
            'SELECT id_domeniu, nume_domeniu
             FROM domenii
             ORDER BY nume_domeniu'
        ) as $d): ?>

            <a href="domeniu.php?id_domeniu=<?= (int)$d['id_domeniu'] ?>">
                <?= h($d['nume_domeniu']) ?>
            </a>

        <?php endforeach; ?>

        <a href="statistici.php">Statistici</a>
    </div>


    <h3>Caută o carte</h3>

    <form class="search-box" action="cautare.php" method="get">
        <input
            type="search"
            name="cuvant"
            placeholder="Titlu sau autor"
        >
        <button aria-label="Caută">→</button>
    </form>


    <?php
    $n = 0;
    $v = 0;

    foreach (($_SESSION['id_carte'] ?? []) as $i => $_) {
        $q = max(
            0,
            (int)($_SESSION['nr_buc'][$i] ?? 0)
        );

        $n += $q;

        $v += $q * (float)(
            $_SESSION['pret'][$i] ?? 0
        );
    }
    ?>


    <div class="cart-summary">
        <strong>Coșul tău</strong>
        <br>

        <?= $n ?>
        <?= $n === 1 ? 'carte' : 'cărți' ?>
        ·
        <?= number_format($v, 2, ',', '.') ?> lei

        <br>

        <a href="cos.php">
            Vezi coșul →
        </a>
    </div>

</aside>

<section class="content">