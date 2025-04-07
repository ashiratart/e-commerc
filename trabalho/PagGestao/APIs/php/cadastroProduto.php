<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clientes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$nomeProduto = $_POST['nomeProduto'];
$precoProduto = $_POST['precoProduto'];
$quantidadeProduto = $_POST['quantidade'];

// Manipulação do upload de imagens

// Verifica se há arquivos enviados corretamente
if (isset($_FILES['img']['name']) && is_array($_FILES['img']['name'])) {
    $targetDir = "/opt/lampp/htdocs/trabalho/uploads/";

    $uploadedFiles = array();

    $logContent = ""; // Inicializa o conteúdo do log

    // Loop de processamento dos arquivos
    foreach ($_FILES['img']['name'] as $i => $filename) {
        $targetFile = $targetDir . basename($filename);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Adiciona mensagens de depuração ao log
        $logContent .= "Debug: Arquivo enviado: " . $filename . PHP_EOL;
        $logContent .= "Debug: Caminho de destino: " . $targetFile . PHP_EOL;

        // Verifica se o arquivo é uma imagem
        $check = getimagesize($_FILES["img"]["tmp_name"][$i]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            $logContent .= "Debug: O arquivo não é uma imagem." . PHP_EOL;
        }

        // Verifica se o arquivo já existe
        if (file_exists($targetFile)) {
            $logContent .= "Debug: Erro - o arquivo já existe." . PHP_EOL;
            $uploadOk = 0;
        }

        // Verifica o tamanho do arquivo
        if ($_FILES["img"]["size"][$i] > 500000) {
            $logContent .= "Debug: Erro - o arquivo é muito grande." . PHP_EOL;
            $uploadOk = 0;
        }

        // Aceita apenas determinadas extensões
        if ($imageFileType != "jpg" && $imageFileType != "png") {
            $logContent .= "Debug: Erro - apenas arquivos JPG e PNG são permitidos." . PHP_EOL;
            $uploadOk = 0;
        }

        // Move o arquivo para o diretório de upload
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["img"]["tmp_name"][$i], $targetFile)) {
                array_push($uploadedFiles, $targetFile);

                // Adiciona mensagem de sucesso ao log
                $logContent .= "Debug: Arquivo movido com sucesso para: " . $targetFile . PHP_EOL;
            } else {
                $logContent .= "Erro no upload do arquivo." . PHP_EOL;
            }
        }
    }

    // Inserir dados no banco de dados
    $sql = "INSERT INTO produtosCadastrado (nome, preco, quantidadeEstoque, img, img2, img3) VALUES ('$nomeProduto', $precoProduto, $quantidadeProduto";

    // Adiciona os caminhos dos arquivos ao SQL
    foreach ($_FILES['img']['name'] as $i => $filename) {
        $targetFile = $targetDir . basename($filename);
        $sql .= ", '" . $targetFile . "'";
    }

    // Preenche os valores restantes com strings vazias se o número de imagens for menor que o esperado
    $remainingColumns = 3 - count($_FILES['img']['name']);
    for ($i = 0; $i < $remainingColumns; $i++) {
        $sql .= ", ''";
    }

    $sql .= ")";

    if ($conn->query($sql) === TRUE) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro no cadastro do produto: " . $conn->error;
    }

    // Escreve o conteúdo do log no arquivo
    $logFileName = "upload_log.txt";
    file_put_contents($logFileName, $logContent, FILE_APPEND);

} else {
    // Trate o caso em que nenhum arquivo foi enviado corretamente
    echo "Nenhum arquivo enviado ou erro no envio.";
}

$conn->close();
?>
