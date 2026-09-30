<?php
require 'conectare.php';
$id=filter_input(INPUT_POST,'id_carte',FILTER_VALIDATE_INT) ?: 0; $name=trim($_POST['nume_utilizator']??''); $email=trim($_POST['adresa_email']??''); $comment=trim($_POST['comentariu']??'');
if(!$id || $name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || $comment===''){http_response_code(400);exit('Datele comentariului sunt invalide.');}
$s=$pdo->prepare('INSERT INTO comentarii(id_carte,nume_utilizator,adresa_email,comentariu) VALUES(?,?,?,?)'); $s->execute([$id,$name,$email,$comment]); header('Location: carte.php?id_carte='.$id); exit;
