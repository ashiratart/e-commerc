function carrinhoAq(id) {
    const produto = document.getElementById('produtosCadastrados-' + id);

    if (produto) {
      const produtoNome = produto.querySelector('h1').textContent;
      const produtoPreco = produto.querySelector('p').textContent;
    
      // Salva os dados do produto para local storage
      localStorage.setItem('produtoNome', produtoNome);
      localStorage.setItem('produtoPreco', produtoPreco);

    } else {
      console.error('produto is null');
    }
    
  }
  