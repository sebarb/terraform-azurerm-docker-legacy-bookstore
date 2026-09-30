<?php
$cartCount=0; foreach(($_SESSION['nr_buc']??[]) as $q) $cartCount += max(0,(int)$q);
?>
<!doctype html><html lang="ro"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Librăria mea</title><link rel="stylesheet" href="stil/stil.css"></head><body>
<header class="site-header"><div class="header-inner"><a class="brand" href="index.php">Librăria <span>mea</span></a><nav class="main-nav"><a href="index.php">Acasă</a><a href="statistici.php">Statistici</a><a href="cautare.php?cuvant=">Catalog</a><a class="cart-pill" href="cos.php">Coș · <?=$cartCount?></a></nav></div></header>
<main class="layout">
