@extends($this->layout("app"))

@section('titulo','Crear semestre academico')

@section('contenido')
<div class="col">
    <div class="card border-info">
        <div class="card-header">
            <h4 class="float-end">Listado de semestres</h4>
            <a href="{{$this->route("semestreacademico/create")}}" class="btn btn-primary float-start">Nuevo <i
                    class="fas fa-plus"></i></a>
        </div>

        <div class="card-body">
            @if ($this->ExistSession("mensaje"))
            @if ($this->getSession("mensaje") == 1)
            <div class="alert alert-success">
                Semestre académico actualizado
            </div>
            @else
            <div class="alert alert-danger">
                Error al crear nuevo semestre académico
            </div>
            @endif
            @php
            $this->destroySession("mensaje")
            @endphp
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Semestre académico</th>
                        <th>Fecha Inicio Inscripción</th>
                        <th>Fecha Cierre inscripción</th>
                        <th>Fecha Inicio notas</th>
                        <th>Fecha Cierre notas</th>
                        <th>GESTIONAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($SemestreAcademicos as $semestre)
                    <tr>
                        <td>{{$semestre->name_semestre_academico}}</td>
                        <td>{{$semestre->FII}}</td>
                        <td>{{$semestre->FCI}}</td>
                        <td>{{$semestre->FIN}}</td>
                        <td>{{$semestre->FCN}}</td>
                        <td>
                            <a href="{{$this->route("semestreacademico/editar/".$semestre->id_semestre_academico)}}"
                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection