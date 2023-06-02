@extends($this->layout("app"))

@section('titulo','listado de estudiantes')

@section('contenido')
<div class="card">
    <div class="card-header">
        <h5 class=" float float-start">Listado de estudiantes</h5>
        <a href="{{$this->route("estudiante/create")}}" class="btn btn-primary float float-end"><b>nuevo</b><i class="fas fa-plus"></i></a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="Tabla-estudiantes">
          <thead>
            <tr>
                <th>DNI</th>
                <th>ESTUDIANTE</th>
                <th>CURSOS MATRICULADOS</th>
                <th>GESTIONAR</th>
            </tr>
        </thead>
           
        </table>
    </div>
</div>

{{-- MODAL PARA EDITAR--}}
<div class="modal fade" id="modal-editar-estudiante">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Editar estudiante</h5>
            </div>

            <form action="" method="post" id="form-editar-modal-estudiante">
                <div class="modal-body">
                <input type="hidden" name="token_" value="{{$this->get_Csrf()}}">
                <div class="form-group">
                    <label for="dni" class="form-label">DNI(*)</label>
                    <input type="text" name="dni" id="dni" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombres" class="form-label">NOMBRES(*)</label>
                    <input type="text" name="nombres" id="nombres" class="form-control">
                </div>

                <div class="form-group">
                    <label for="apellidos" class="form-label">APELLIDOS(*)</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control">
                </div>

                <div class="form-group">
                    <label for="telefono" class="form-label">TELEFONO</label>
                    <input type="text" name="telefono" id="telefono" class="form-control">
                </div>

                <div class="form-group">
                    <label for="direccion" class="form-label">DIRECCIÓN(*)</label>
                    <input type="text" name="direccion" id="direccion" class="form-control">
                </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" id="save"><i class="fas fa-save"></i>Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

var IdEstudiante;

$(document).ready(function() {
  mostrarEstudiantes();

  $('#save').click(function(evt){
    evt.preventDefault();/// no recarga la página
    
    Update();
  });
});

function mostrarEstudiantes()
{
    var TablaEstudiantes= $('#Tabla-estudiantes').DataTable({
    retrieve:true,/// con eta propiedad no se realiza cambios en las propiedades
    "ajax":{
     url:"{{URL_BASE}}estudiante/showEstudiante?token_={{$this->get_Csrf()}}",
     method:"GET",
     dataSrc:"estudiantes",
    },
    "columns":[
        {"data":"dni"},
        {"data":"estudiante"},
        {"data":"cursos_matriculados",render:function(dta){
            let data = '';

            if(dta.length > 0)
            {
                dta.forEach(element => {
                     data += '<span class="badge badge-success">'+element+'</span> '; 
                });
            }
            else{
                data = '<span class="badge badge-danger">No hay curso matriculados</span>'; 
            }

            return data;
        }},
        {"defaultContent":`
          <div class='row'>
          <div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 m-2'>
          <button class='btn btn-warning btn-sm' id='editar'><i class='fas fa-edit'></i></button>  
          </div>  
          <div class='col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 m-2'>
            <button class='btn btn-danger btn-sm' id='eliminar'><i class='fas fa-trash-alt'></i></button>    
          </div>  
          </div>
        `}
    ]
   }).ajax.reload(); /// refrescar el datatable

   editar('#Tabla-estudiantes tbody',TablaEstudiantes)
   ConfirmDelete('#Tabla-estudiantes tbody',TablaEstudiantes)
}

/// editar estudiantes

function editar(Tbody,Tabla)
{
    $(Tbody).on('click','#editar',function(){
      /// obtener la final seleccionado
      /// let | var | const
      let fila = $(this).parents('tr');

      /// verificamos que la fila al momento de estar en pantallas pequeños

      if(fila.hasClass("child"))
      {
        fila = fila.prev();
      }

      /// obtengo los datos

      let Datos = Tabla.row(fila).data();

      IdEstudiante =Datos.id_estudiante;

      /// abrimos el modal de editar

      $('#dni').val(Datos.dni);
      $('#nombres').val(Datos.nombres);
      $('#apellidos').val(Datos.apellidos);
      $('#telefono').val(Datos.telefono);
      $('#direccion').val(Datos.direccion);

      $('#modal-editar-estudiante').modal('show')
    });
}

function Update()
{
    $.ajax({
        url:"{{$this->route('estudiante/update/')}}"+IdEstudiante,
        method:"POST",
        data:$('#form-editar-modal-estudiante').serialize(),
        success:function(response)
        {
            alert(response)

            mostrarEstudiantes();
        }
    })
}

/// confirmar antes de eliminar

function ConfirmDelete(Tbody,Tabla)
{
    $(Tbody).on('click','#eliminar',function(){
      /// obtener la final seleccionado
      /// let | var | const
      let fila = $(this).parents('tr');

      /// verificamos que la fila al momento de estar en pantallas pequeños

      if(fila.hasClass("child"))
      {
        fila = fila.prev();
      }

      /// obtengo los datos

      let Datos = Tabla.row(fila).data();

      IdEstudiante =Datos.id_usuario;
      Swal.fire({
      title: 'Are you sure?',
      text: "Deseas elimianar al estudiante "+Datos.estudiante,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
       if (result.isConfirmed) {
       /// proceso para eliminar
       Delete_();
      }
     })
      
    });
}

function Delete_()
{
    $.ajax({
        url:"{{$this->route('estudiante/delete_/')}}"+IdEstudiante,
        method:"POST",
        data:{token_:"{{$this->get_Csrf()}}"},
        success:function(response)
        {
            Swal.fire({
                title:"Mensaje del sistema",
                text:"Estudiante eliminado",
                icon:"success"
            }).then(function(){
             location.href='/usuario';
            });
        }
    })
}
</script>
@endsection