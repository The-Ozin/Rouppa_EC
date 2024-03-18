// brecho.js
document.addEventListener("DOMContentLoaded", function() {
    const produtosContainer = document.getElementById("produtosContainer");

    // Carregar produtos quando a página é carregada
    carregarProdutos();

    function carregarProdutos() {
        // Recuperar a lista de produtos do armazenamento local
        const produtos = JSON.parse(localStorage.getItem('produtos')) || [];

        // Limpar produtosContainer
        produtosContainer.innerHTML = "";

        // Iterar sobre os produtos e exibi-los
        produtos.forEach(function(produto) {
            const preco = produto.preco.toFixed(2);
            const produtoHTML = `
                <div class="col-md-4">
                    <!-- Estrutura do card do produto -->
                    <p>Preço: R$ ${preco}</p>
                </div>
            `;
            produtosContainer.innerHTML += produtoHTML;
        });
    }
});








