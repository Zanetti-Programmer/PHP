<?php

$user = "SYSDBA";
$pass = "masterkey";
try{
    $pdo=new PDO("firebird:localhost=(your host);dbname=(name you database)",$user,$pass);
}catch(PDOException $e) {
    echo "error connection.".$e->getcode();
}

$stmt = $pdo->prepare("select * from nametable");
$stmt->execute();
$dados = $stmt->fetchAll(PDO::FETCH_OBJ);

foreach ($dados as $row) {
   echo "{$row->nome_do_campo} <br/>";
}

?> 
