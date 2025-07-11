document.querySelector("form").addEventListener("submit", function (event) {
    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const nascimento = document.getElementById("nascimento").value.trim();
    const telefone = document.getElementById("telefone").value.trim();

    const comentario = document.getElementById("comentarios").value.trim();
    const tipoSelecionado = document.querySelector('input[name="tipo"]:checked');

    const idade = calcularIdade(nascimento);

    // verifica idade
    if (idade < 18) {
        alert("Você precisa ser maior de idade para se inscrever.");
        event.preventDefault(); 
    } else {
        const comentario = prompt("Se tiver alguma dúvida, por favor, insira abaixo:");
        
        if (comentario === null || comentario.trim() === "") {
            const confirmaComentario = confirm("Não há dúvidas que deseja fazer?");
            if (confirmaComentario) {
                alert("Ok, sem problemas. Vamos seguir com a inscrição.");
            }
        } else {
            alert("Obrigado pelos seus comentários!");
        }

        alert(`Olá, ${nome}! Cadastro realizado no ENLIC`);
    }

});
//  funcao matematica
function calcularIdade(dataNascimento) {
    const hoje = new Date();
    const nascimento = new Date(dataNascimento);

    const diferencaEmMs = hoje - nascimento;
    const msPorAno = 1000 * 60 * 60 * 24 * 365.25; 

    const idade = Math.floor(diferencaEmMs / msPorAno); 
    return idade;
}

//vetores
function alertPalestraEscolhida(palestra) {
    const palestrasDisponiveis = [
        "mesa_redonda", 
        "metodologias", 
        "debate"
    ];
    if (palestrasDisponiveis.includes(palestra)) {
        alert(`Você escolheu a palestra: ${palestra.replace(/_/g, ' ').toUpperCase()}`);
    } else {
        alert("Palestra não válida.");
    }
}

