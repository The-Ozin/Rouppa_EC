// Função para cadastrar o produto
function cadastrarProduto() {
    var form = document.forms["caixacadastro"];
    var nomeProduto = form["nome_produto"].value;
    var tamanho = form["tamanho"].value;
    var categoria = form["categoria"].value;
    var condicao = form["condicao"].value;
    var descricao = form["descricao"].value;
    var preco = form["preco"].value;
    var imagem = form["imagem_produto"].files[0]; // Obter o arquivo de imagem

    // Criar um objeto com os dados do produto
    var produto = {
        nome: nomeProduto,
        tamanho: tamanho,
        categoria: categoria,
        condicao: condicao,
        descricao: descricao,
        preco: preco,
        imagem: imagem // Adicionar a imagem ao objeto do produto
    };

    // Exibir o produto
    exibirProduto(produto);

    // Limpar o formulário após o cadastro
    form.reset();
}

// Função para exibir o produto na área correspondente à categoria
function exibirProduto(produto) {
    // Criar um elemento div para o produto
    var produtoDiv = document.createElement('div');
    produtoDiv.classList.add('produto');
    produtoDiv.innerHTML = `
        <h3>${produto.nome}</h3>
        <p><strong>Tamanho:</strong> ${produto.tamanho}</p>
        <p><strong>Categoria:</strong> ${produto.categoria}</p>
        <p><strong>Condição:</strong> ${produto.condicao}</p>
        <p><strong>Descrição:</strong> ${produto.descricao}</p>
        <p><strong>Preço:</strong> R$ ${produto.preco}</p>
        <img src="${URL.createObjectURL(produto.imagem)}" alt="Imagem do Produto">
    `;

    // Adicionar o elemento div à área correta com base na categoria
    var categoriaDiv = document.getElementById('produtos-' + produto.categoria.toLowerCase());
    categoriaDiv.innerHTML = ""; // Limpar o conteúdo anterior
    categoriaDiv.appendChild(produtoDiv);
}





