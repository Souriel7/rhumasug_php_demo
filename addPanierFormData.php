<?php
session_start();

var_dump($_POST);

$datas = $_POST;
$idProduit = array_keys($datas)[0];
$qtite = array_values($datas)[0];

$_SESSION["panier"][$idProduit] = $qtite;
