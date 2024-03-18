function cadastrarProduto() {
    var form = document.forms["caixacadastro"];
    var nomeProduto = form["nome_produto"].value;
    var tamanho = form["tamanho"].value;
    var categoria = form["categoria"].value;
    var genero = form.querySelector('input[name="genero"]:checked').value;
    var condicao = form["condicao"].value;
    var descricao = form["descricao"].value;
    var preco = form["preco"].value;
    var imagem = form["imagem_produto"].files[0]; // Obter o arquivo de imagem

    // Criar um objeto com os dados do produto
    var produto = {
        nome: nomeProduto,
        tamanho: tamanho,
        categoria: categoria,
        genero: genero,
        condicao: condicao,
        descricao: descricao,
        preco: preco,
        imagem: imagem // Adicionar a imagem ao objeto do produto
    };

    // Aqui você enviaria os dados para o backend para serem armazenados no banco de dados
    // Por enquanto, vamos apenas exibir os dados na página
    exibirProduto(produto);

    // Limpar o formulário após o cadastro
    form.reset();
}

function exibirProduto(produto) {
    var categoriaDiv = document.getElementById(produto.categoria.toLowerCase());
    var novoProduto = document.createElement("div");
    novoProduto.innerHTML = `
        <h3>${produto.nome}</h3>
        <p><strong>Tamanho:</strong> ${produto.tamanho}</p>
        <p><strong>Gênero:</strong> ${produto.genero}</p>
        <p><strong>Condição:</strong> ${produto.condicao}</p>
        <p><strong>Descrição:</strong> ${produto.descricao}</p>
        <p><strong>Preço:</strong> R$ ${produto.preco}</p>
        <img src="${URL.createObjectURL(produto.imagem)}" alt="Imagem do produto"> <!-- Mostrar a imagem -->
        <hr>
    `;
    categoriaDiv.appendChild(novoProduto);
}




