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
        produtos.forEach(function(produto, index) {
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
                            <button type="button" class="btn btn-danger excluir-produto">Excluir</button>
                        </div>
                    </div>
                </div>
            `;
            produtosContainer.innerHTML += produtoHTML;
        });

        // Chamar a função para adicionar os botões de exclusão
        adicionarBotoesExclusao();
    }

    // Adicionar botões de exclusão para cada produto
    function adicionarBotoesExclusao() {
        const botoesExclusao = document.querySelectorAll('.excluir-produto');
        botoesExclusao.forEach((botao, index) => {
            botao.addEventListener('click', () => {
                // Remover o produto correspondente da lista
                removerProduto(index);
            });
        });
    }

    // Remover produto da lista e atualizar o armazenamento local
    function removerProduto(index) {
        // Recuperar a lista de produtos do armazenamento local
        const produtos = JSON.parse(localStorage.getItem('produtos')) || [];

        // Remover o produto do índice especificado
        produtos.splice(index, 1);

        // Atualizar a lista de produtos no armazenamento local
        localStorage.setItem('produtos', JSON.stringify(produtos));

        // Recarregar a página para refletir as alterações
        location.reload();
    }
});














