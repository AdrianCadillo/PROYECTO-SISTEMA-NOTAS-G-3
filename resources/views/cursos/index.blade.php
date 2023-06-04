@extends($this->layout("app"))

@section('titulo','listado de cursos')

@section('contenido')
<div class="card">
    <div class="card-header">
        <h5 class=" float float-start">Listado de cursos</h5>
        <button class="btn btn-primary float float-end" id="new-curso" onclick="create()"><b>nuevo</b><i
                class="fas fa-plus"></i></button>
    </div>
    <div class="card-body table table-responsive">
        <table class="table table-bordered table-striped table-sm" id="Tabla-cursos">
            <thead>
                <tr>
                    <th>CATEGORÍA</th>
                    <th>NOMBRE CURSO</th>
                    <th>DESCRIPCIÓN</th>
                    <th>DOCENTE</th>
                </tr>
            </thead>

        </table>
    </div>
</div>
{{-- MODAL PARA CREAR CURSOS ----}}

<div class="modal fade" id="modalcursos">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h5>Crear cursos</h5>
                <button type="button" class="btn-close cerrar" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="form_curso">
                <input type="hidden" name="token_" value="{{$this->get_Csrf()}}">
                <div class="modal-body">
                    <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                        <label for="id_categoria">Categoría(*)</label>
                        <select name="id_categoria" id="id_categoria" class="form-select"></select>
                    </div>
    
                    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-6 col-12">
                        <label for="nombre_curso" class="form-label">Nombre curso(*)</label>
                        <input type="text" name="nombre_curso" id="name_curso" class="form-control" placeholder="nombre curso....">
                    </div>
    
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción</label>
                       <textarea name="descripcion" id="descripcion" cols="30" rows="6" class="form-control" placeholder="Describa el curso...."></textarea>
                    </div>
    
                    <div class="col-12">
                        <label for="docente" class="form-label">Docente(*)</label>
                        <select name="id_docente" id="id_docente" class="form-select"></select>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                            <button class="btn btn-success" id="save_curso"><b>Guardar</b></button>
                            <button class="btn btn-info" id="crear-docente"><b>crear docente</b></button>
                 </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
  $(document).ready(function(){
   MostrarCursos()

  }); 
  
  /// mostrar los cursos
  function MostrarCursos()
  {
    var TablaCursos = $('#Tabla-cursos').DataTable({})
  }
  function create()
  {
    $('#modalcursos').modal("show")
  }
</script> 
@endsection