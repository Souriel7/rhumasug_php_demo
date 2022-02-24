<h1>Panier</h1>

<a href="./php/scripts/validerPanier.php">Valider le panier</a>

<?php
// var_dump($_SESSION["panier"]);
$conn = new PDO("mysql:host=localhost;dbname=rhumasug;charset=utf8;port=3307", "toto", "toto");

// (1,2,3,4)
$listeProduits = "(";
$tabIdProduit = array_keys($_SESSION["panier"]);
$produitsImplode = implode(",", $tabIdProduit);
$listeProduits .= $produitsImplode . ")";

// var_dump($listeProduits);

$stmt = $conn->prepare("SELECT * FROM produit WHERE idProduit IN " . $listeProduits);
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($produits);

foreach ($produits as $key => $produit) {
    $produits[$key]["qtite"] = $_SESSION["panier"][$produit["idProduit"]];
}
// var_dump($produits);

// $produitsAfficher = [];
// foreach ($_SESSION["panier"] as $idProduit => $qtite) {
//     $stmt = $conn->prepare("SELECT * FROM produit WHERE idProduit=?");
//     $stmt->execute([$idProduit]);
//     $produit = $stmt->fetch(PDO::FETCH_ASSOC);
//     $produit["qtite"] = $qtite;
//     var_dump($produit);
//     $produitsAfficher[] = $produit;
// }

?>

<?php $total = 0; ?>
<?php foreach ($produits as $produitAfficher) : ?>
    <h3><?= $produitAfficher["libelleProduit"] . " x " . $produitAfficher["qtite"] ?></h3>
    <p><?= $produitAfficher["descriptionProduit"] ?></p>
    <p><?= $produitAfficher["prixProduit"] ?> €</p>
    <p>Sous-total : <?= $produitAfficher["prixProduit"] * $produitAfficher["qtite"] ?></p>
    <?php $total += $produitAfficher["prixProduit"] * $produitAfficher["qtite"] ?>
<?php endforeach ?>
<p>Total : <?= $total ?> €</p>