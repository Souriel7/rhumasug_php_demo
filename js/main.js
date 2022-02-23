const btnsProduit = document.querySelectorAll(".btn");

btnsProduit.forEach(function (btn) {
    btn.addEventListener("click", function () {
        handleBtnClick(btn);
        const idProduit = btn.closest('div').dataset.id;
        const qtiteProduit = btn.closest('div').querySelector('input').value;
        saveProduitToSession(idProduit, qtiteProduit);
    });
});

function saveProduitToSession(idProduit, qtiteProduit) {
    const produit = {};
    produit[idProduit] = qtiteProduit;
    console.log(produit);
    console.log(JSON.stringify(produit));
    const prodToSession = fetch("addPanier.php", {
        method: "POST",
        body: JSON.stringify(produit)
    });
}

function handleBtnClick(btn) {
    if (btn.dataset.role === "+") {
        btn.previousElementSibling.value++;
    } else if (btn.dataset.role === "-") {
        if (btn.nextElementSibling.value > 0) {
            btn.nextElementSibling.value--;
        }
    }
}