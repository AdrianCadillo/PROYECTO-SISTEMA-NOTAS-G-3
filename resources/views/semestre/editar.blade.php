@extends($this->layout("app"))

@section('titulo','Crear semestre academico')

@section('contenido')
<div class="col">
    <div class="card border-info">
        <div class="card-header">
            <h5>Crear semestre académico</h5>
        </div>
        <form action="{{$this->route("semestreacademico/update/".$SemestreAcademico->id_semestre_academico)}}" method="post">
            <input type="hidden" class="form-control" name="token_" value="{{$this->get_Csrf()}}">

            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-6 col-12">
                        <label for="name_semestre" class="form-label">Nombre Semestre(*)</label>
                        <input type="text" name="name_semestre_academico" id="name_semestre" class="form-control"
                            placeholder="Nombre semestre academico" autofocus
                            value="{{$SemestreAcademico->name_semestre_academico}}">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-7 col-sm-6 col-12">
                        <label for="fecha_inicio_inscripcion" class="form-label">fecha inicio inscripcion(*)</label>
                        <input type="date" name="fecha_inicio_inscripcion" id="fecha_inicio_inscripcion"
                            class="form-control" value="{{$SemestreAcademico->fecha_inicio_inscripcion}}">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-6 col-12">
                        <label for="fecha_cierre_inscripcion" class="form-label">fecha cierre inscripcion(*)</label>
                        <input type="date" name="fecha_cierre_inscripcion" id="fecha_cierre_inscripcion"
                            class="form-control" value="{{$SemestreAcademico->fecha_cierre_inscripcion}}">
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-7 col-sm-6 col-12">
                        <label for="fecha_inicio_llenadonotas" class="form-label">fecha inicio de llenado de
                            notas(*)</label>
                        <input type="date" name="fecha_inicio_llenadonotas" id="fecha_inicio_llenadonotas"
                            class="form-control" value="{{$SemestreAcademico->fecha_inicio_llenadonotas}}">
                    </div>

                    <div class="col-xl-6 col-lg-6  col-12">
                        <label for="fecha_cierre_llenadonotas" class="form-label">fecha cierre de llenado de
                            notas(*)</label>
                        <input type="date" name="fecha_cierre_llenadonotas" id="fecha_cierre_llenadonotas"
                            class="form-control" value="{{$SemestreAcademico->fecha_cierre_llenadonotas}}">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-outline-primary"><b>Guardar Cambios <i class="fas fa-save"></i></b></button>
            </div>
        </form>
    </div>
</div>

@endsection