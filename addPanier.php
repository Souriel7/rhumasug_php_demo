<?php
session_start();

$datas = trim(file_get_contents("php://input"));
$datasJson = json_decode($datas, true);
$idProduit = array_keys($datasJson)[0];
$qtite = array_values($datasJson)[0];

$_SESSION["panier"][$idProduit] = $qtite;
