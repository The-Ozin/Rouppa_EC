document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("cadastroForm");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        // Validar campos
        const nome = document.getElementById("nome").value.trim();
        const categoria = document.getElementById("categoria").value;
        const tamanho = document.getElementById("tamanho").value;
        const preco = document.getElementById("preco").value;
        const genero = document.getElementById("genero").value.trim();
        const descricao = document.getElementById("descricao").value.trim();
        const foto = document.getElementById("foto").value.trim();

        if (nome === "" || categoria === "" || tamanho === "" || preco === "" || genero === "" || descricao === "" || foto === "") {
            alert("Por favor, preencha todos os campos.");
            return;
        }

        // Se todos os campos estiverem preenchidos, você pode enviar o formulário ou fazer outras ações aqui
        alert("Formulário enviado com sucesso!");
        form.reset(); // Limpa o formulário após o envio
    });
});











