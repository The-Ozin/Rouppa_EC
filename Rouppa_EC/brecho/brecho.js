document.addEventListener("DOMContentLoaded", function() {
    const produtosContainer = document.getElementById("produtosContainer");

    // Função para carregar os produtos
    function carregarProdutos() {
        axios.get("p")
            .then(function(response) {
                // Limpar produtos existentes
                produtosContainer.innerHTML = "";

                // Verificar se a resposta possui dados
                if (response.data) {
                    // Iterar sobre os produtos
                    response.data.forEach(function(produto) {
                        const preco = produto.preco.toFixed(2);
                        const produtoHTML = `
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" src="${produto.imagem}" alt="Imagem do produto">
                                    <div class="card-body">
                                        <h5 class="card-title">${produto.nome}</h5>
                                        <p class="card-text">Categoria: ${produto.categoria}</p>
                                        <p class="card-text">Tamanho: ${produto.tamanho}</p>
                                        <p class="card-text">Preço: R$ ${preco}</p>
                                        <p class="card-text">Gênero: ${produto.genero}</p>
                                        <p class="card-text">Descrição: ${produto.descricao}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        produtosContainer.innerHTML += produtoHTML;
                    });
                } else {
                    console.error("Erro ao carregar produtos: resposta vazia");
                }
            })
            .catch(function(error) {
                console.error("Erro ao carregar produtos:", error);
            });
    }

    // Carregar produtos quando a página é carregada
    carregarProdutos();
});




