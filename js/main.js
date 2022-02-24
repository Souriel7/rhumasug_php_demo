const btnsProduit = document.querySelectorAll(".btn");

btnsProduit.forEach(function (btn) {
    btn.addEventListener("click", function () {
        handleBtnClick(btn);
        const idProduit = btn.closest('div').dataset.id;
        const qtiteProduit = btn.closest('div').querySelector('input').value;
        saveProduitToSessionFormData(idProduit, qtiteProduit);
        // saveProduitToSession(idProduit, qtiteProduit);
    });
});

async function saveProduitToSessionFormData(idProduit, qtiteProduit) {
    const formData = new FormData();
    formData.append(idProduit, qtiteProduit);
    console.log(formData);
    const prodToSession = await fetch("addPanierFormData.php", {
        method: "POST",
        body: formData
    });
    const response = await prodToSession.json();
}

async function saveProduitToSession(idProduit, qtiteProduit) {
    const produit = {};
    produit[idProduit] = qtiteProduit;
    console.log(produit);
    console.log(JSON.stringify(produit));
    const prodToSession = await fetch("addPanier.php", {
        method: "POST",
        body: JSON.stringify(produit)
    });
    const response = await prodToSession.json();

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