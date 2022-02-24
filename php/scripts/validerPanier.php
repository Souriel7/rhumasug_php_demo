<?php

session_start();

echo "valider";

$idUser = "1";

$conn = new PDO("mysql:host=localhost;dbname=rhumasug;charset=utf8;port=3307", "toto", "toto");
$stmt = $conn->prepare("INSERT INTO vente(`idVente`, `dateVente`, `idUser`, `etat`) VALUES (null, now(), $idUser, 0)");
$stmt->execute();
$idVente = $conn->lastInsertId();
var_dump($idVente);

foreach ($_SESSION["panier"] as $idProduit => $qtite) {
    $stmtProd = $conn->prepare("SELECT prixProduit FROM produit WHERE idProduit=?");
    $stmtProd->execute([$idProduit]);
    $prixProd = $stmtProd->fetch(PDO::FETCH_ASSOC);
    $prixProduit = $prixProd["prixProduit"];
    $stmtInsertContenir = $conn->prepare("INSERT INTO `contenir`(`idVente`, `idProduit`, `quantite`, `prixVente`) VALUES (?,?,?,?)");
    $stmtInsertContenir->execute([$idVente, $idProduit, $qtite, $prixProduit]);
}
header("location: ../../index.php?page=accueil");
