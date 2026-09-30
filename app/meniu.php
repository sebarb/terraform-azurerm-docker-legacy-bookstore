<td valign="top" width="140"><br>
<table border="0" bgcolor="#f9f1e3" cellpadding="0" cellspacing="0" width="148"><tr><td background="./imagini/colt1.jpg" width="15" height="15"></td><td align="center" width="120" bgcolor="#ffcc33"><b>Alege domeniul</b></td><td background="./imagini/colt2.jpg" width="15" height="15"></td></tr></table>
<table border="0" bgcolor="#ffcc33" cellpadding="0" cellspacing="1"><tr><td><table border="0" bgcolor="#f9f1d0" width="100%">
<?php foreach ($pdo->query('SELECT id_domeniu,nume_domeniu FROM domenii ORDER BY nume_domeniu') as $d): ?>
<tr><td background="./imagini/top_r3_c13.gif"><a href="domeniu.php?id_domeniu=<?= (int)$d['id_domeniu'] ?>" class="linc"><?= h($d['nume_domeniu']) ?></a></td></tr>
<?php endforeach; ?></table>
<form action="cautare.php" method="get"><tr><td align="center"><b>Cautare</b></td></tr><tr><td><table border="0" bgcolor="#f9f1d0" width="100%"><tr><td align="center"><input type="text" name="cuvant" size="12" class="insert"></td></tr><tr><td align="center"><input type="submit" value="Cauta" class="ok"></td></tr></table></td></tr></form>
<?php
$cartIds = $_SESSION['id_carte'] ?? []; $qty = $_SESSION['nr_buc'] ?? []; $prices = $_SESSION['pret'] ?? [];
$nrcarti=0; $totalvaloare=0.0;
foreach ($cartIds as $i => $_) { $q=max(0,(int)($qty[$i]??0)); $nrcarti += $q; $totalvaloare += $q*(float)($prices[$i]??0); }
?>
<tr><td><b>Cos</b><table border="0" bgcolor="#f9f1d0" width="100%"><tr><td>Aveti <b><?= $nrcarti ?></b> carti in cos, in valoare de <b><?= number_format($totalvaloare,2,',','.') ?></b> lei. Click <a href="cos.php">aici</a> pentru cos.</td></tr></table></td></tr>
</td></tr></table><table border="0" bgcolor="#f9f1e3" cellpadding="0" cellspacing="0" width="148"><tr><td background="./imagini/colt4.jpg" width="15" height="15"></td><td width="120" bgcolor="#ffcc33"></td><td background="./imagini/colt3.jpg" width="15" height="15"></td></tr></table></td>
