/*document.addEventListener('DOMContentLoaded', function () {
    // Fai una richiesta AJAX per ottenere i dati dei prodotti popolari
    fetch('api/prodotto.php')
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('main-container');
            data.forEach(prodotto => {
                const productItem = document.createElement('div');
                productItem.innerHTML = `
                <div class="container-vendita">
                <a href="dettagli_prodotto.php?id=${prodotto.id}">
                    <img src="${prodotto.image}" alt="${prodotto.id}">
                </a>
                <div>
                    <a href="${prodotto.id}">${prodotto.prodotto}</a>
                </div>
                <p>
                    <strong><span>${prodotto.prezzo} €</span></strong>
                </p>
            </div>
                `;
                productList.appendChild(productItem);
            });
        })
        .catch(error => console.error('Errore durante il recupero dei dati:', error));
});*/

document.addEventListener('DOMContentLoaded', function () {
    // Fai una richiesta AJAX per ottenere i dati dei prodotti popolari
    fetch('api/prodotto.php')
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('main-container');
            data.forEach(prodotto => {
                const productItem = document.createElement('div');
                productItem.innerHTML = `
                <div class="container-vendita">
                <a href="dettagli_prodotto.php?id=${prodotto.id}">
                    <img src="${prodotto.image}" alt="${prodotto.prodotto}">
                </a>
                <div>
                    <a href="dettagli_prodotto.php?id=${prodotto.id}">${prodotto.prodotto}</a>
                </div>
                <p>
                    <strong><span>${prodotto.prezzo} €</span></strong>
                </p>
            </div>
                `;
                productList.appendChild(productItem);
            });
        })
        .catch(error => console.error('Errore durante il recupero dei dati:', error));
});

