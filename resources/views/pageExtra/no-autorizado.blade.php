@extends($this->layout('app'))

@section('titulo', 'Page-No-Autorizado')

@section('contenido')
<div class="error-page mt-5 py-3">

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-8 col-md-10 col-12 text-center">
        <h2 class="headline text-danger ">Página no Autorizado</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! lo sentimos, Ppero usted no posee permisos para visitar esta página.</h3>
            <div class="text-center">
                <a href="{{$this->route("dashboard")}}" class="btn btn-primary"><i class="fas fa-home"></i> Ir a la página principal</a>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
<!-- /.error-page -->