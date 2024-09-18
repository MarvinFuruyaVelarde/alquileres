function soloLetras(inputElement, e) {
    
    var letra = e.keyCode || e.which;

    // Permitir letras (mayúsculas y minúsculas), backspace, espacio, tab, ñ y tildes
    if ((letra > 64 && letra < 91) || // Letras mayúsculas
        (letra > 96 && letra < 123) || // Letras minúsculas
        letra === 8 ||  // Backspace
        letra === 32 || // Espacio
        letra === 9 ||  // Tab
        letra === 164 || // ñ
        letra === 192 // Tilde `
    ) {
        return true; // Permitir estas teclas
    }

    // Bloquear específicamente +, -, *, y otros caracteres no deseados
    if (letra === 107 || // Numpad +
        letra === 109 || // Numpad -
        letra === 106 || // Numpad *
        letra === 187 || // Shift + =
        letra === 189    // Fila superior -
    ) {
        e.preventDefault(); // Bloquear estas teclas
        return false;
    }

    e.preventDefault(); // Bloquear cualquier otra tecla no permitida
    return false;

}

// Función para deshabilitar el ingreso de números en el input específico
function deshabilitarNumeros(inputElement) {
    inputElement.addEventListener('keydown', function(e) {
        var letra = e.keyCode || e.which;

        // Bloquear números del teclado numérico (96-105) y la fila superior (48-57)
        if ((letra >= 96 && letra <= 105) || (letra >= 48 && letra <= 57)) {
            e.preventDefault(); // Evitar el ingreso de números
        } else {
            soloLetras(inputElement, e); // Validar que solo permite letras
        }
    });
}

// Ejecutar la validación en un input con ID específico
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los elementos que tengan el atributo data-input-id
    const inputs = document.querySelectorAll('[data-input-id]');

    inputs.forEach(function(input) {
        const inputId = input.getAttribute('data-input-id'); // Obtén el valor del atributo personalizado
        const inputElement = document.getElementById(inputId); // Obtén el input por su ID

        if (inputElement) {
            deshabilitarNumeros(inputElement); // Ejecuta la validación en el input específico
        }
    });
});

// Función para validar longitud de un input
function validarLongitud(inputElement, minLength, maxLength) {
    const errorElement = document.getElementById(`error-${inputElement.id}`);

    // Verificar si el campo está vacío
    if (inputElement.value.trim() === "") {
        errorElement.textContent = "Este campo es obligatorio.";
        inputElement.style.borderColor = "orange";
        return false;
    }

    // Verificar si la longitud es menor que el mínimo permitido
    if (inputElement.value.length < minLength) {
        errorElement.textContent = `Debe tener al menos ${minLength} caracteres.`;
        inputElement.style.borderColor = "red";
        return false;
    }

    // Verificar si la longitud es mayor que el máximo permitido
    if (inputElement.value.length > maxLength) {
        errorElement.textContent = `No puede exceder los ${maxLength} caracteres.`;
        inputElement.style.borderColor = "red";
        return false;
    }

    // Si pasa todas las validaciones
    errorElement.textContent = "";
    inputElement.style.borderColor = "green";
    return true;
}

// Función para inicializar la validación en inputs de un formulario
function inicializarValidacionLongitud(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    const inputs = form.querySelectorAll('[data-validate="length"]');

    // Validación en tiempo real para cada input
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const minLength = parseInt(input.getAttribute('data-min-length'), 10);
            const maxLength = parseInt(input.getAttribute('data-max-length'), 10);
            validarLongitud(input, minLength, maxLength);
        });
    });

    // Validación al enviar el formulario
    form.addEventListener('submit', function(event) {
        let esValido = true;
        inputs.forEach(input => {
            const minLength = parseInt(input.getAttribute('data-min-length'), 10);
            const maxLength = parseInt(input.getAttribute('data-max-length'), 10);
            if (!validarLongitud(input, minLength, maxLength)) {
                esValido = false;
            }
        });

        if (!esValido) {
            event.preventDefault(); // Evitar envío si algún campo es inválido
        }
    });
}

// Ejecutar la validación para formularios con el atributo data-form-id
document.addEventListener('DOMContentLoaded', function() {
    const formularios = document.querySelectorAll('[data-form-id]');
    
    formularios.forEach(formulario => {
        const formId = formulario.getAttribute('data-form-id');
        inicializarValidacionLongitud(formId); // Pasar el ID del formulario
    });
});

// Función para validar la entrada de decimales
function validarSoloDecimales(inputElement, e) {
    var key = e.keyCode || e.which;
    var tecla = e.key;
    var valorActual = inputElement.value;

    // Permitir las siguientes teclas: Backspace, Tab, Flechas y punto (.)
    if (key === 8 || key === 9 || key === 37 || key === 39 || tecla === ".") {
        // Permitir solo un punto decimal
        if (tecla === "." && valorActual.includes(".")) {
            e.preventDefault(); // Bloquear si ya hay un punto decimal
        }
        return true;
    }

    // Bloquear caracteres que no sean números (0-9)
    if (key < 48 || key > 57) {
        e.preventDefault();
        return false;
    }

    // Si ya existe un punto decimal, verificar la cantidad de decimales
    if (valorActual.includes(".")) {
        var partes = valorActual.split(".");
        var parteDecimal = partes[1];

        if (parteDecimal && parteDecimal.length >= 2) {
            e.preventDefault(); // Bloquear si ya hay más de 2 decimales
            return false;
        }
    }

    return true;
}

// Función para inicializar la validación de decimales en un formulario
function inicializarValidacionDecimales(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    const inputs = form.querySelectorAll('[data-validate="decimal"]');

    // Validación en tiempo real para cada input que requiere decimales
    inputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            validarSoloDecimales(input, e);
        });
    });
}

// Ejecutar la validación de decimales al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const formularios = document.querySelectorAll('[data-form-id]');

    formularios.forEach(formulario => {
        const formId = formulario.getAttribute('data-form-id');
        inicializarValidacionDecimales(formId);
    });
});

// Función para validar la entrada de solo enteros
function validarSoloEnteros(inputElement, e) {
    var key = e.keyCode || e.which;
    var tecla = e.key;

    // Permitir las siguientes teclas: Backspace, Tab, Flechas
    if (key === 8 || key === 9 || key === 37 || key === 39) {
        return true;
    }

    // Bloquear cualquier carácter que no sea un número
    if (key < 48 || key > 57) {
        e.preventDefault();
        return false;
    }

    return true;
}

// Función para inicializar la validación de solo enteros en un formulario
function inicializarValidacionEnteros(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    const inputs = form.querySelectorAll('[data-validate="integer"]');

    // Validación en tiempo real para cada input que requiere enteros
    inputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            validarSoloEnteros(input, e);
        });
    });
}

// Ejecutar la validación de enteros al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const formularios = document.querySelectorAll('[data-form-id]');

    formularios.forEach(formulario => {
        const formId = formulario.getAttribute('data-form-id');
        inicializarValidacionEnteros(formId);
    });
});