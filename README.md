
# 📦 Documentação do Projeto - Autenticação e Cadastro de Clientes

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

Este módulo faz parte de um sistema de e-commerce e lida com o **cadastro** e **login** de clientes, usando **HTML**, **CSS**, **JavaScript**, **PHP** e **MySQL**. Ele garante que usuários possam criar contas, realizar login seguro e acessar páginas de cliente autenticado.

---

## 🗂 Estrutura de Arquivos

```
/trabalho/
│
├── CssGeral/
│   └── geralCliente1.css
│   └── loginGeral.css
│
├── PagClientes/
│   ├── cadastro.html
│   ├── Clientes1.html
│   ├── Carrinho.html
│   ├── cadastropessoal.html
│   ├── js/
│   │   ├── carregarProdutos.js
│   │   ├── recuoerarCliente.js
│   │   └── loginClientes.js
│   ├── php/
│   │   ├── Carrinho/
│   │   │   └── enviarDados1.php
│   │   └── Cadastro/
│   │       ├── cadastro.php
│   │       └── login.php
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
  - JavaScript (vanilla)
- **Backend**:
  - PHP (procedural)
  - MySQL (banco de dados)

---

## 🔁 Fluxo do Sistema

1. O usuário acessa `cadastro.html` ou `cadastropessoal.html`.
2. Preenche os dados e, ao submeter, é feita uma requisição AJAX para `cadastro.php`.
3. Se o cadastro for bem-sucedido, o usuário é redirecionado para a página de login.
4. No login (`cadastro.html`), os dados são enviados via fetch ao `login.php`.
5. O `login.php` verifica se o e-mail e senha estão corretos.
6. Se autenticado, armazena os dados no `localStorage` e redireciona para `Clientes1.html`.

---

## 🧩 Detalhamento das Páginas e Scripts

### 🔹 `cadastro.html`

- Página com formulário de login.
- Permite que o usuário entre com e-mail e senha.
- Link para se cadastrar se não tiver conta.

### 🔹 `cadastropessoal.html`

- Formulário de cadastro com os campos:
  - Nome, e-mail, CPF, data de nascimento e senha.
- Verifica:
  - Senhas iguais
  - Campos obrigatórios preenchidos
  - Senha com no mínimo 8 caracteres

### 🔹 `Clientes1.html`

- Página acessível apenas após login bem-sucedido.
- Exibe dados do cliente logado (através de `localStorage`).

### 🔹 `loginClientes.js`

- Faz fetch ao `login.php` usando método POST.
- Se as credenciais estiverem corretas:
  - Armazena `nomeUsuario` e `idUsuario` no `localStorage`
  - Redireciona para `Clientes1.html`

### 🔹 `cadastro.php`

- Recebe dados via `POST`
- Insere no banco de dados (`ClientesCadastrados`)
- Retorna mensagem de sucesso ou erro

### 🔹 `login.php`

- Recebe `usuario` e `senha`
- Consulta no banco de dados se existe cliente com as credenciais
- Retorna JSON com `{ autenticado: true, id: <idCliente> }` ou falso

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

- Servidor local (XAMPP, WAMP, Apache com PHP)
- PHP 7.4+
- MySQL ou MariaDB
- Navegador moderno com suporte a JavaScript e LocalStorage

---

## 🚀 Execução do Projeto

1. Copie a pasta `/trabalho` para o diretório do seu servidor local (`htdocs` ou equivalente).
2. Crie o banco de dados `Clientes` com a tabela `ClientesCadastrados`.
3. Acesse `http://localhost/trabalho/PagClientes/cadastro.html` para iniciar.

---

## 📝 Observações Finais

- O projeto está modularizado para facilitar expansão.
- Recomendado usar **hash de senha** (como `password_hash()` em PHP) em produção.
- Ideal para fins didáticos ou MVP de autenticação básica em e-commerce.