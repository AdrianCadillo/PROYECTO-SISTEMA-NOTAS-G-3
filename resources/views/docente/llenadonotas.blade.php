@extends($this->layout("app"))

@section('titulo','Crear usuarios')

@section('contenido')
<div class="col">
<div class="card">
    <div class="card-header">
        <h5>Ingreso de notas</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="curso">Seleccione un curso</label>
            <select name="curso" id="curso" class="form-select">
                <option disabled selected>--- Tus Cursos asignados ----</option>
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id_curso}}">{{$curso->nombre_curso}}</option>
                @endforeach
            </select>
         </div>

         <div class="table table-responsive table-striped">
            <table class="table table-bordered">
                <thead>
                    <th class="d-none">Id Estudiante</th>
                    <th>Estudiante</th>
                    <th>PP</th>
                    <th>PT</th>
                    <th>EP</th>
                    <th class="text-center">INGRESAR</th>
                    {{-- <button id="ingresar" class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil"></i></button>--}}
                </thead>
                <tbody id="listadoEstudiantes"></tbody>
            </table>
         </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script>

var Id_Curso_;
$(document).ready(function(){
  
  $('#curso').change(function(){

    Id_Curso_ = $(this).val();

    mostrarEstudiantesInscritos(Id_Curso_);
  });

/// realizar el ingreso de notas
$('#listadoEstudiantes').on('click','#ingresar',function(){

/// obtenemos los datos del estudiante a ingresar su nota
let Fila_Seleccionado = $(this).closest('tr') /// fila seleccionado
let ESTUDIANTE_CURSO = Fila_Seleccionado.find('td').eq(0).text();
let ESTUIDNATE = Fila_Seleccionado.find('td').eq(1).text();
let PP = Fila_Seleccionado.find('#pp');
let PT = Fila_Seleccionado.find('#pt');
let EP = Fila_Seleccionado.find('#ep');

if(PP.val().trim().length == 0 || parseInt(PP.val().trim())<0 ||parseInt(PP.val().trim())>20)
    {
    PP.focus();
    Swal.fire({
    title:"Mensaje del sistema",
    text:"Error, el campo de PP está vació , ingrese una nota de [0-20]",
    icon:"warning"
    })
    }
    else
    {
    if(PT.val().trim().length == 0 || parseInt(PT.val().trim())<0 || parseInt(PT.val().trim())> 20)
        {
        PT.focus()
        Swal.fire({
        title:"Mensaje del sistema",
        text:"Error, el campo de PT está vació , ingrese una nota de [0-20]",
        icon:"warning"
        })
        }
        else{
        if(EP.val().trim().length == 0 || parseInt(EP.val().trim())<0 || parseInt(EP.val().trim())> 20)
            {
            EP.focus()
            Swal.fire({
            title:"Mensaje del sistema",
            text:"Error, el campo de EP está vació , ingrese una nota de [0-20]",
            icon:"warning"
            })
            }else
            {

            /// proceso de ingreso de notas
            $.ajax({
            url:"{{$this->route('llenadonotas/procesoLlenadoNotas')}}",
            method:"POST",
            data:{token_:"{{$this->get_Csrf()}}",estudiante:ESTUDIANTE_CURSO,pp:PP.val(),pt:PT.val(),ep:EP.val()},
            success:function(response)
            {
            response = JSON.parse(response);
            if(response.response == 1)
            {
            Swal.fire({
            title:"Mensaje del sistema",
            text:"El ingreso de notas para el estudiante "+ESTUIDNATE+" se ingresó correctamente",
            icon:"success"
            }).then(function(){
            mostrarEstudiantesInscritos(Id_Curso_);
            })
            }
            else
            {
            Swal.fire({
            title:"Mensaje del sistema",
            text:"Error al ingresar notas del estudiante "+ESTUIDNATE,
            icon:"error"
            })
            }
            }
            })
            }
            }
            }

});
});

/// mostrar los estudiantes inscritos a un curso
function mostrarEstudiantesInscritos(Id_Curso)
{
    let tr = '';
    $.ajax({
        url:"{{$this->route('llenadonotas/mostrarEstudiantesInscritos')}}",
        method:"POST",
        data:{token_:"{{$this->get_Csrf()}}",curso_id:Id_Curso},
        success:function(response)
        {
            response = JSON.parse(response);

            if(response.response.length > 0)
            {
                response.response.forEach(estudiante => {
                    
                    tr+=`
                     <tr>
                        <td class='d-none'>`+estudiante.id_estudiante_curso+`</td>
                        <td>`+estudiante.apellidos+'  '+estudiante.nombres+`</td>
                        <td><input type='text' id='pp' class='form-control table-input  col-12' ></td>
                        <td><input type='text' id='pt' class='form-control table-input col-12' ></td>
                        <td><input type='text' id='ep' class='form-control table-input col-12' ></td>
                        <td class='text-center'><button id='ingresar' class='btn btn-outline-primary btn-sm'><i class='fas fa-pencil'></i></td>    
                    </tr>
                    `;
                });
            }
            else
            {
                tr+= '<td colspan="5" class="text-center text-danger">No hay estudiantes para mostrar...</td>';
            }
            $('#listadoEstudiantes').html(tr);

            ValidarEnterInput()

        }
    })
}

function ValidarEnterInput()
{
    $('#listadoEstudiantes tr').on('keypress',function(evento){
            if(evento.which === 13)
            {
                if($(this).find('#pp').val().trim().length ==0)
                {
                    $(this).find('#pp').focus();
                }
                else
                {
                   if($(this).find("#pt").val().trim().length === 0)
                   {
                    $(this).find("#pt").focus();
                   }
                   else{
                    if($(this).find('#ep').val().trim().length ==0)
                    {
                        $(this).find('#ep').focus()
                    }
                   }
                }
                
            }
        });
    }
</script>  
@endsection