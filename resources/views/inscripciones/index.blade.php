@extends($this->layout("app"))

@section('titulo','Realizar mi inscripción')

@section('contenido')
<div class="col">
    <div class="card border-info">
        <div class="card-header">
            <h4>Realizar mi inscripción</h4>
        </div>
        <div class="card-body table table-responsive">
            <form action="" method="post">
                <table class="table table-bordered table-striped" id="tabla_inscripcion">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CURSO</th>
                            <th>DOCENTE</th>
                            <th class="text-center">INSCRIBIRME</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $contador = 0
                        @endphp
                        @foreach ($cursos as $curso)
                        @php
                            $contador++
                        @endphp
                            <tr>
                                <td>{{$contador}}</td>
                                <td>{{$curso->curso}}</td>
                                <td>{{$curso->docente}}</td>
                                <td class="text-center">
                                    <input type="checkbox" name="curso[]" value="{{$curso->id_curso}}"
                                    style="width: 26px;height: 26px;">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <button class="btn btn-success"><b>Realizar mi inscripción <i class="fas fa-save"></i></b></button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var TablaInscripcion = $('#tabla_inscripcion').DataTable({})
</script>
@endsection