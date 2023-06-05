/// abrir modal para poner el foco en el primer input

function focusInputModal(modal,input){

    /// primero abrimos el modal
    $('#'+modal).modal("show")
    $("#"+modal).on('shown.bs.modal', function () {
        $("#"+input).focus();
    });
}

/// pasar enter

function  eventEnter(input_Verificar,input_Secundario) {
   
    input_Verificar.keypress(function(evento){
     
        /// cuando doy enter

        if(evento.which === 13)
        {
          evento.preventDefault() /// no recargar la página al dar enter  
            /// verificamos si el input no esta vacio

            if($(this).val().trim().length == 0)
            {
                $(this).focus();
            }
            else
            {
                input_Secundario.focus()
            }
        }
    });
}

/// resetear el formulario

function resetForm(formularioId)
{
    $('#'+formularioId)[0].reset();
}

