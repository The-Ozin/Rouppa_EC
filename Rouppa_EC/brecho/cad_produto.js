// cad_produto.js
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("cadastroForm");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        // Obter dados do formulário
        const nome = document.getElementById("nome").value.trim();
        const categoria = document.getElementById("categoria").value;
        const tamanho = document.getElementById("tamanho").value;
        const preco = parseFloat(document.getElementById("preco").value);
        const genero = document.getElementById("genero").value.trim();
        const descricao = document.getElementById("descricao").value.trim();
        const foto = document.getElementById("foto").value.trim();

        // Criar objeto do produto
        const novoProduto = {
            nome: nome,
            categoria: categoria,
            tamanho: tamanho,
            preco: preco,
            genero: genero,
            descricao: descricao,
            foto: foto
        };

        // Adicionar novo produto ao arquivo JSON local
        adicionarProdutoAoJSON(novoProduto);
    });
});

function adicionarProdutoAoJSON(novoProduto) {
    setTimeout(() => {
        // Recuperar a lista de produtos do armazenamento local
        const produtos = JSON.parse(localStorage.getItem('produtos')) || [];

        // Adicionar o novo produto à lista
        produtos.push(novoProduto);

        // Atualizar a lista de produtos no armazenamento local
        localStorage.setItem('produtos', JSON.stringify(produtos));

        alert("Produto cadastrado com sucesso!");

        // Redirecionar para a página do brechó
        window.location.href = "http://localhost:63342/Rouppa_EC/Rouppa_EC/brecho/main_brecho.html";
    }, 500); // Simula um tempo de resposta do servidor
}













