// brecho.js
document.addEventListener("DOMContentLoaded", function() {
    const produtosContainer = document.getElementById("produtosContainer");

    // Verificar se o elemento existe antes de adicionar o event listener
    if (produtosContainer) {
        carregarProdutos();
    } else {
        console.error("Elemento 'produtosContainer' não encontrado na página.");
    }

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
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="${produto.imagem}" alt="Imagem do produto">
                        <div class="card-body">
                            <h5 class="card-title">${produto.nome}</h5>
                            <p class="card-text">Categoria: ${produto.categoria}</p>
                            <p class="card-text">Tamanho: ${produto.tamanho}</p>
                            <p class="card-text">Gênero: ${produto.genero}</p>
                            <p class="card-text">Descrição: ${produto.descricao}</p>
                            <p class="card-text">Preço: R$ ${preco}</p>
                        </div>
                    </div>
                </div>
            `;
            produtosContainer.innerHTML += produtoHTML;
        });
    }
});











