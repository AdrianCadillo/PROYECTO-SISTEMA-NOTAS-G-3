@extends($this->layout("app"))

@section('titulo','listado de usuarios')

@section('contenido')
<div class="card">
    <div class="card-header">
        <h5 class=" float float-start">Listado de usuarios</h5>
        <a href="{{$this->route("usuario/create")}}" class="btn btn-primary float float-end"><b>nuevo</b><i class="fas fa-plus"></i></a>
    </div>
    <div class="card-body">
        <form action="{{$this->route("usuario/reporteTxt")}}" method="post">
            <input type="hidden" name="token_" value="{{$this->get_Csrf()}}">
            <button class="btn btn-danger mb-1"><i class="fas fa-file"></i> Generar reporte txt</button>
        </form>
        <table class="table table-bordered table-striped" id="Tabla-estudiantes">
          <thead>
            <tr>
                <th>#</th>
                <th>USERNAME</th>
                <th>EMAIL</th>
                <th>ROL</th>
                <th>FOTO</th>
                <th>ACCIÓN</th>
            </tr>
          </thead>

          <tbody>
            @php $contador =0 @endphp
            @foreach ($listado_usuarios as $usuario)
            @php $contador++ @endphp
                <tr>
                    <td>{{$contador}}</td>
                    <td>{{$usuario->username}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->rol}}</td>
                    <td>
                    <img src="{{$this->getFoto($usuario->foto)}}" alt="" style="width: 32px;height: 37x;border-radius: 50%">
                    </td>
                    <td>
                     <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12 m-2">
                            <a href="" class="btn btn-warning btn-sm" style="border-radius: 50%"><i class="fas fa-edit"></i></a>  
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12 m-2">
                                <button class="btn btn-danger btn-sm" style="border-radius: 50%" onclick=" ConfirmarDelete(`{{$usuario->id_usuario}}`,`{{$usuario->username}}`)"><i class="fas fa-trash-alt"></i></button>
                        </div>

                     </div>
                    </td>
                </tr>
            @endforeach
          </tbody>
           
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    var IdUsuario;
$(document).ready(function(){


});  

function ConfirmarDelete(id,usuario)
{
 IdUsuario =id;

   Swal.fire({
      title: 'Are you sure?',
      text: "Deseas elimianar al usuario "+usuario,
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
}
function Delete_()
{
    $.ajax({
        url:"{{$this->route('estudiante/delete_/')}}"+IdUsuario,
        method:"POST",
        data:{token_:"{{$this->get_Csrf()}}"},
        success:function(response)
        {
            Swal.fire({
                title:"Mensaje del sistema",
                text:"Estudiante eliminado",
                icon:"success"
            })

            mostrarEstudiantes();
        }
    })
}
</script> 
@endsection