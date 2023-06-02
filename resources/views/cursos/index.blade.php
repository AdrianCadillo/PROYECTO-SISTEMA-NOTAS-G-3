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
        <table class="table table-bordered table-striped" id="Tabla-cursos">
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

<div class="modal fade" id="modal-crear-estudiante">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Crear cursos</h5>
                <button type="button" class="btn-close" id="salir" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="token_" value="{{$this->get_Csrf()}}">

                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="categoria" class="form-label">Categoría(*)</label>
                                <select name="categoria" id="categoria" class="form-select">

                                </select>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-7 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="nombre_curso" class="form-label">NOMBRE CURSO(*)</label>
                                <input type="text" name="name_curso" id="name_curso" class="form-control">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-7 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="descripcion" class="form-label">DESCRIPCIÓN(*)</label>
                                <input type="text" name="descripcion" id="descripcion" class="form-control">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-5 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="docente" class="form-label">Docente(*)</label>
                                <select name="docente" id="docente" class="form-select">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" id="save"><i class="fas fa-save"></i>Guardar</button>

                    <button class="btn btn-info " id="save_cat"><i class="fas fa-plus"></i>nueva categoría</button>

                    <button class="btn btn-danger " id="save_doc"><i class="fas fa-plus"></i>craer docente</button>
                </div>
            </form>
        </div>
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
    $('#modal-crear-estudiante').modal("show")
  }
</script> 
@endsection