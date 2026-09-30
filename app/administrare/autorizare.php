<?php
session_start(); require_once '../conectare.php'; if(empty($_SESSION['admin_id'])){http_response_code(403);exit('Acces neautorizat!');}$s=$pdo->prepare('SELECT id_admin,admin_nume FROM admin WHERE id_admin=?');$s->execute([(int)$_SESSION['admin_id']]);if(!$s->fetch()){session_destroy();http_response_code(403);exit('Acces neautorizat!');}
