<?php
$conn = new PDO("mysql:host=localhost;dbname=rhumasug;charset=utf8;port=3307", "toto", "toto");
$stmt = $conn->prepare("SELECT * FROM produit");
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($produits);
?>

<h1>Accueil</h1>

<?php foreach ($produits as $produit) : ?>
    <h1><?= $produit["libelleProduit"] ?></h1>
    <p><?= $produit["descriptionProduit"] ?></p>
    <p><?= $produit["prixProduit"] ?> €</p>
    <div data-id="<?= $produit["idProduit"] ?>">
        <button class="btn btnMoins" data-role="-">-</button>
        <input type="text" value="<?= $_SESSION["panier"][$produit["idProduit"]] ?? 0 ?>" disabled>
        <button class="btn btnPlus" data-role="+">+</button>
    </div>
<?php endforeach ?>