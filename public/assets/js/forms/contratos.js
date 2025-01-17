// Función para mostrar u ocultar los contenedores dependiendo del tipo de solicitante
/*function toggleSolicitanteFields(value) {
    var nitCont = document.getElementById('nit-container');
    var ciCont = document.getElementById('ci-container');
    var cjurCont = document.getElementById('cjur-container');
    var cjur2Cont = document.getElementById('cjur2-container');
    var cjur3Cont = document.getElementById('cjur3-container');
    var nit = document.getElementById("nit");
    var ci = document.getElementById("ci");

    if (value === '2') {
        nitCont.style.display = 'block'; // Mostrar NIT
        ciCont.style.display = 'none'; // Ocultar CI
        ci.value = ""; // Limpiar CI
        cjurCont.style.display = ''; // Mostrar contenedores de representantes
        cjur2Cont.style.display = ''; 
        cjur3Cont.style.display = ''; 
    } else {
        nitCont.style.display = 'none'; // Ocultar NIT
        ciCont.style.display = 'block'; // Mostrar CI
        nit.value = ""; // Limpiar NIT
        cjurCont.style.display = 'none'; // Ocultar contenedores de representantes
        cjur2Cont.style.display = 'none';
        cjur3Cont.style.display = 'none';
    }
}

// Función para resetear los campos adicionales de representantes
function resetRepresentantes() {
    var parentDiv = document.getElementById('campos'); 
    while (parentDiv.children.length > 1) { // Mantener el primer representante
        parentDiv.removeChild(parentDiv.lastChild);
    }
    cont = 2; // Reiniciar el contador
}

// Al cargar la página, configurar el formulario según el tipo de solicitante
var tipoSolicitante = document.getElementById('tipo_solicitante').value;
toggleSolicitanteFields(tipoSolicitante);

// Listener para el cambio de tipo de solicitante
document.getElementById('tipo_solicitante').addEventListener('change', function () {
    var value = this.value;
    resetRepresentantes(); // Eliminar los campos de representantes si cambia el tipo
    toggleSolicitanteFields(value); // Mostrar/Ocultar campos según el valor seleccionado
});*/

// al Ingresar al formulario para registrar/editar
var value = document.getElementById('tipo_solicitante').value;
var tipoIdentificacion = $('#cliente option:selected').data('tipo-identificacion');
var numeroIdentificacion = $('#cliente option:selected').data('numero-identificacion');
var nitCont = document.getElementById('nit-container');
var ciCont = document.getElementById('ci-container');
var cjurCont = document.getElementById('cjur-container');
var cjur2Cont = document.getElementById('cjur2-container');
var cjur3Cont = document.getElementById('cjur3-container');
var nit = document.getElementById("nit");
var ci = document.getElementById("ci");

if (value === '2') {
    nitCont.style.display = 'block'; // Mostrar campo
    ciCont.style.display = 'none'; // Ocultar campo
    ci.value = "";
    cjurCont.style.display = ''; // Mostrar campo
    
    if (cjur2Cont) {
        cjur2Cont.style.display = ''; // Ocultar campo
    }

    if (cjur3Cont) {
        cjur3Cont.style.display = ''; // Ocultar campo
    }
   
} else {
    nitCont.style.display = 'none'; // Ocultar campo
    ciCont.style.display = 'block'; // Mostrar campo
    nit.value = "";
    cjurCont.style.display = 'none'; // Ocultar campo
    if (cjur2Cont) {
        cjur2Cont.style.display = 'none'; // Ocultar campo
    }
    if (cjur3Cont) {
        cjur3Cont.style.display = 'none'; // Ocultar campo
    }
}

//Verificar dado el cliente si es Ci o Nit
if (tipoIdentificacion == 1){
    nitCont.style.display = 'none'; // Ocultar campo
    nit.value = "";
    ciCont.style.display = 'block'; // Mostrar campo
    document.getElementById('ci').value = numeroIdentificacion;
    document.getElementById('ci_o').value = numeroIdentificacion;
}else if(tipoIdentificacion == 2){
    ciCont.style.display = 'none'; // Ocultar campo
    ci.value = "";
    nitCont.style.display = 'block'; // Mostrar campo
    document.getElementById('nit').value = numeroIdentificacion;
    document.getElementById('nit_o').value = numeroIdentificacion;
}

//Hab/Deshab campos dependientes Ci o Nit, si se cambia de opción 
document.getElementById('tipo_solicitante').addEventListener('change', function () {
    var value = this.value;
    var nitCont = document.getElementById('nit-container');
    var ciCont = document.getElementById('ci-container');
    var cjurCont = document.getElementById('cjur-container');
    var nit = document.getElementById("nit");
    var ci = document.getElementById("ci");

    // Elimina los campos adicionados de representantes si se cambia el tipo de solicitante 
    var parentDiv = document.getElementById('campos'); 
    while (parentDiv.children.length > 1) {
        parentDiv.removeChild(parentDiv.lastChild);
        cont = 2;
    }
    
    if (value === '2') {
        nitCont.style.display = 'block'; // Mostrar campo
        nit.value = "";
        ciCont.style.display = 'none'; // Ocultar campo
        ci.value = "";
        cjurCont.style.display = ''; // Mostrar campo
    } else {
        nitCont.style.display = 'none'; // Ocultar campo
        ciCont.style.display = 'block'; // Mostrar campo
        nit.value = "";
        cjurCont.style.display = 'none'; // Ocultar campo
    }
});

// Obtiene el Cliente dado el Tipo de Solicitante
$("#tipo_solicitante").change(function(event) {
    if ($(this).val())
      getCliente($(this).val());
});

function getCliente(tipoSolicitante) {
    var zone = $("#cliente");
    $.ajax({
        url: contratosObtClienteUrl + '/' +tipoSolicitante,
        method: 'get',
        data: {'tipo_solicitante':tipoSolicitante},
        beforeSend: function(){
        zone.attr('disabled', true);
        },
        success: function (response) {
        zone.attr('disabled', false).html(response.item);
        },
        error: function() {
        alert('Error al cargar el código de cliente.');
        }  
    });
}

// Asigna Numero de Identificación cuando se selecciona el Cliente
$("#cliente").change(function(event) {
    var selectedOption = $(this).find(':selected');
    var numeroIdentificacion = selectedOption.data('numero-identificacion');
    var tipoIdentificacion = selectedOption.data('tipo-identificacion');
    var nitCont = document.getElementById('nit-container');
    var ciCont = document.getElementById('ci-container');
    var nit = document.getElementById("nit");
    var ci = document.getElementById("ci");
    if (tipoIdentificacion == 1){
        nitCont.style.display = 'none'; // Ocultar campo
        nit.value = "";
        ciCont.style.display = 'block'; // Mostrar campo
        document.getElementById('ci').value = numeroIdentificacion;
        document.getElementById('ci_o').value = numeroIdentificacion;
    }else if(tipoIdentificacion == 2){
        ciCont.style.display = 'none'; // Ocultar campo
        ci.value = "";
        nitCont.style.display = 'block'; // Mostrar campo
        document.getElementById('nit').value = numeroIdentificacion;
        document.getElementById('nit_o').value = numeroIdentificacion;
    }
});

document.addEventListener("submit", function (event) {
    const codigoInput = this.querySelector("#codigo");
    const codigoInicial = codigoInput.getAttribute("data-original-value");
    // Verifica que el evento provenga de un formulario con el ID que deseas manejar
    if (event.target.id === "form_reg_contrato" || event.target.id === "form_edit_contrato") {
        event.preventDefault();

        const form = event.target; // Obtiene el formulario dinámicamente
        const codigoContrato = form.querySelector("#codigo").value;
        const errorSpan = form.querySelector("#error-codigo"); // Busca dentro del formulario correspondiente

        // Limpia el mensaje de error
        errorSpan.textContent = "";

        $.ajax({
            url: verificaCodigoContrato,
            method: 'get',
            data: { codigo: codigoContrato },
            beforeSend: function () {
                form.querySelector("button[type='submit']").setAttribute('disabled', true);
            },
            success: function (response) {
                if (form.id === 'form_reg_contrato' && response.cont > 0) {
                    errorSpan.textContent = "El Código ya se encuentra registrado, ingrese uno diferente.";
                    form.querySelector("#codigo").focus();
                } else if(form.id == 'form_edit_contrato'){
                    if (codigoInicial !== codigoContrato && response.cont > 0 ){
                        errorSpan.textContent = "El Código ya se encuentra registrado, ingrese uno diferente.";
                        form.querySelector("#codigo").focus();
                    } else {
                        form.submit();
                    }
                } else {
                    form.submit();
                }
            },
            error: function () {
                alert("Error al verificar el código. Intente nuevamente.");
            },
            complete: function () {
                form.querySelector("button[type='submit']").removeAttribute('disabled');
            }
        });
    }
}, true);

