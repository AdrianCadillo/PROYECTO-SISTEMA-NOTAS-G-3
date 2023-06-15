@extends($this->layout("app"))

@section('titulo','listado de cursos')

@section('contenido')
<div class="card text-center">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" id="MiTab">
        <li class="nav-item">
          <a class="nav-link active" aria-current="true" href="#copia">Copia de seguridad</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#restore">Restauración del sistema</a>
        </li>
      </ul>
    </div>
    <div class="card-body">

       @if ($this->ExistSession("mensaje"))
        @if ($this->getSession("mensaje") == 1)
        <div class="alert alert-success">
            La restauración del sistema se a realizado correctamente
        </div>
        @else
        <div class="alert alert-danger">
            Error al restaurar el sistema
        </div>
        @endif
        
        @php
        $this->destroySession("mensaje")
        @endphp
        @endif
        
        
        @if ($this->ExistSession("error"))
        
        <div class="alert alert-danger">
            {{$this->getSession("error")}}
        </div>
        
        @php
        $this->destroySession("error")
        @endphp
        @endif
        <div class="tab-content" id="nav-tabContent">
            {{--COPIA DE SEGURIDAD---}}
            <div class="tab-pane fade show active" id="copia" role="tabpanel" >
               <form action="{{$this->route("configuracion/CopiaSeguridad")}}" method="post">
                <input type="hidden" name="token_" value="{{$this->get_Csrf()}}">
                <label for="" class="form-label float-start">Nombre de la copia de seguridad (*)</label>
                <input type="text" name="copia" class="form-control" placeholder="Nombre de la copia..."
                autofocus required>
                <button class="btn btn-primary float-end m-2"> Exportar</button>
               </form>
            </div>

            {{-- RESTAURAR SISTEMA ---}}
            <div class="tab-pane fade" id="restore" role="tabpanel" >
                <form action="{{$this->route("configuracion/restore")}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token_" value="{{$this->get_Csrf()}}">
                    <label for="" class="form-label float-start">Seleccione un archivo sql(*)</label>
                    <input type="file" name="archivo_copia" class="form-control" >
                    <button class="btn btn-primary float-end m-2"> Importar</button>
                </form> 
            </div>
           
          </div>
    </div>
  </div>
@endsection

@section('js')
<script>
     $(document).ready(function(){

        $('#MiTab').on('click','a',function(evento){

            evento.preventDefault();
            
            $(this).tab("show")
        });
     })
</script>
@endsection