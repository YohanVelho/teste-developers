function isNumber(value) {
    return value !== '';
}

function validateForm(){
    let form = document.productsForm;

    if(form.name.value == ''){
        alert('Por favor informe um Nome!');
        form.name.focus();
        return false;
    }

    if(form.value.value == ''){
        alert('Por favor informe um Valor!');
        form.value.focus();
        return false;
    }

    if(form.value.value === ''){
        alert('Por favor apenas números!');
        form.value.focus();
        return false;
    }
}

