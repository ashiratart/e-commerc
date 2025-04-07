$(document).ready(function () {
  recuperarDados();
});
// Função para recuperar dados do Local Storage
  function recuperarDados() {
    // Verifica se o Local Storage é suportado pelo navegador
    if (typeof(Storage) !== "undefined") {
      // Recupera o dado com a chave "meuDado"
      var meuDado = localStorage.getItem("nomeUsuario");
      var novoNome = document.querySelector("#linkPramudar");

      // Verifica se o dado foi encontrado
      if (meuDado !== null) {
        console.log("Dado encontrado: " + meuDado);
        novoNome.innerHTML = meuDado;
      } else {
        console.log("Nenhum dado encontrado.");
      }
    } else {
      console.log("Local Storage não suportado pelo navegador.");
    }
  }

  // Chama a função ao carregar a página
  recuperarDados();