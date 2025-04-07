
    function showPrompt() {
        document.getElementById('promptContainer').style.display = 'flex';
    }

    function hidePrompt() {
        document.getElementById('promptContainer').style.display = 'none';
    }

    function deleteProduct(productNumber) {
        $.ajax({
            type: 'POST',
            url: '/trabalho/PagGestao/APIs/php/alterar.php',
            data: {
                productNumber: productNumber,
                operation: 'delete'
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function updateProduct(productNumber, fieldToUpdate, newValue) {
        $.ajax({
            type: 'POST',
            url: '/trabalho/PagGestao/APIs/php/alterar.php',
            data: {
                productNumber: productNumber,
                operation: 'update',
                fieldToUpdate: fieldToUpdate,
                newValue: newValue
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function performOperation() {
        var productNumber = document.getElementById('productNumber').value;
        var operation = document.getElementById('operationSelect').value;

        if (operation === 'delete') {
            var confirmDelete = confirm('Tem certeza de que deseja deletar o produto?');

            if (confirmDelete) {
                deleteProduct(productNumber);
            }
        } else if (operation === 'update') {
            var fieldToUpdate = prompt('Qual campo você deseja alterar?');
            var newValue = prompt('Digite o novo valor:');
            updateProduct(productNumber, fieldToUpdate, newValue);
        }

        hidePrompt();
    }
