
# 📦 Documentação do Projeto - Página Inicial de Loja Online

## 🧾 Sumário
- [Descrição do Projeto](#descrição-do-projeto)
- [Estrutura de Arquivos](#estrutura-de-arquivos)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Fluxo do Sistema](#fluxo-do-sistema)
- [Detalhamento das Páginas e Scripts](#detalhamento-das-páginas-e-scripts)
- [Banco de Dados](#banco-de-dados)
- [Requisitos](#requisitos)
- [Execução do Projeto](#execução-do-projeto)
- [Observações Finais](#observações-finais)

---

## 📘 Descrição do Projeto

Este projeto é uma página inicial de uma loja virtual desenvolvida com **HTML**, **CSS**, **JavaScript** e **PHP**. Ela permite ao cliente visualizar produtos, definir quantidade, adicionar ao carrinho, e simula o processo de compra por meio de comunicação com o backend.

---

## 🗂 Estrutura de Arquivos

```
/trabalho/
│
├── CssGeral/
│   └── geralCliente1.css
│
├── PagClientes/
│   ├── cadastro.html
│   ├── Carrinho.html
│   ├── js/
│   │   ├── carregarProdutos.js
│   │   ├── recuoerarCliente.js
│   │   └── carregarProdutos.php
│   └── php/
│       └── Carrinho/
│           └── enviarDados1.php
│
├── PagGestao/
│   └── index.html
│
├── uploads/
│   └── [imagens dos produtos]
│
└── index.html
```

---

## 💻 Tecnologias Utilizadas

- **Frontend**:
  - HTML5
  - CSS3
  - JavaScript (com jQuery)
- **Backend**:
  - PHP (Procedural)
  - MySQL (banco de dados)

---

## 🔁 Fluxo do Sistema

1. O usuário acessa `index.html`.
2. O JS carrega produtos disponíveis do backend via `carregarProdutos.php`.
3. O cliente seleciona uma quantidade e clica em "Comprar".
4. A quantidade é armazenada temporariamente no `localStorage`.
5. O JS envia os dados via AJAX para `enviarDados1.php`, que registra no banco.
6. A página é recarregada e mostra o nome do usuário, se estiver logado (`recuoerarCliente.js`).

---

## 🧩 Detalhamento das Páginas e Scripts

### 🔹 `index.html`

- Página principal com vitrine de produtos.
- Inclui links para:
  - Cadastro/Login
  - Carrinho
  - Gestão
- Contém um container para os produtos dinamicamente carregados.

### 🔹 `carregarProdutos.js`

- Usa AJAX para buscar os produtos no backend.
- Renderiza dinamicamente os produtos na tela.
- Permite definir quantidade e comprar.

### 🔹 `recuoerarCliente.js`

- Recupera o nome do cliente do `localStorage` e exibe no botão de login.

### 🔹 `enviarDados1.php`

- Recebe `idUsuario`, `idProduto` e `quantidade`.
- Insere no banco de dados (tabela `carrinho`).
- Usa transações para garantir integridade.

### 🔹 `carregarProdutos.php`

- Realiza SELECT na tabela `produtosCadastrado`.
- Retorna um array JSON com os dados dos produtos.

---

## 🛢 Banco de Dados

### 🔸 Banco: `Clientes`

#### Tabela: `produtosCadastrado`

| Campo             | Tipo     |
|------------------|----------|
| id               | INT (PK) |
| nome             | VARCHAR  |
| preco            | DECIMAL  |
| img              | VARCHAR  |
| quantidadeEstoque| INT      |

#### Tabela: `carrinho`

| Campo           | Tipo     |
|----------------|----------|
| id             | INT (PK) |
| carrinhoCliente| INT      |
| compras        | INT      |
| quantidade     | DECIMAL  |

---

## 📋 Requisitos

- Servidor local (XAMPP, WAMP, ou Apache com PHP)
- PHP 7.4+
- MySQL ou MariaDB
- Navegador moderno com suporte a JavaScript e LocalStorage

---

## 🚀 Execução do Projeto

1. Clone ou copie a pasta `/trabalho` para o diretório do seu servidor local (ex: `htdocs` no XAMPP).
2. Configure o banco de dados com as tabelas `produtosCadastrado` e `carrinho`.
3. Adicione imagens de produtos na pasta `/uploads`.
4. Abra `http://localhost/trabalho/index.html` no navegador.

---

## 📝 Observações Finais

- O projeto está preparado para futuras integrações com páginas de gestão e autenticação de usuários.
- É possível melhorar a segurança com validações no backend e sanitização de dados.
- Este projeto é ideal para fins didáticos e pode evoluir para um e-commerce completo.