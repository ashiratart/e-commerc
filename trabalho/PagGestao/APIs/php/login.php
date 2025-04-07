<?php
// Obter dados do POST
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Aqui você deve adicionar lógica para verificar as credenciais no servidor
// Se as credenciais são válidas, você pode imprimir "Sucesso", caso contrário, "Erro"
// Exemplo simples:
if ($usuario === 'usuario_teste' && $senha === 'senha_teste') {
    echo "Sucesso";
} else {
    echo "Erro";
}
?>
