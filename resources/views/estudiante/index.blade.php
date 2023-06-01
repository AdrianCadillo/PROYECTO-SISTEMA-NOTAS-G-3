@extends($this->layout("app"))

@section('titulo','listado de estudiantes')

@section('contenido')
<div class="card">
    <div class="card-header"><h5>Listado de estudiantes</h5></div>

    <div class="card-body">
        <table class="table table-bordered table-striped" id="Tabla-estudiantes">
          <thead>
            <tr>
                <th>DNI</th>
                <th>ESTUDIANTE</th>
                <th>CURSOS MATRICULADOS</th>
            </tr>
          </thead>
           
        </table>
    </div>
</div>
 
@endsection

@section('js')
<script>
$(document).ready(function() {
  mostrarEstudiantes();
});

function mostrarEstudiantes()
{
    var TablaEstudiantes= $('#Tabla-estudiantes').DataTable({
    retrieve:true,
    "ajax":{
     url:"{{URL_BASE}}estudiante/showEstudiante",
     method:"GET",
     dataSrc:"estudiantes",
    },
    "columns":[
        {"data":"dni",render:function(dta){return '<p class="text-white">'+dta+'</p>'}},
        {"data":"estudiante",render:function(dta){return '<p class="text-white">'+dta+'</p>'}},
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
    ]
   }).ajax.reaload();
}
</script>
@endsection