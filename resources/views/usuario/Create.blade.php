@extends($this->layout("app"))

@section('titulo','Crear usuarios')

@section('contenido')
        <div class="card border-primary">
            <div class="card-header bg bg-info"><h4>Crear estudiantes</h4></div>

            <form action="{{$this->route("estudiante/save")}}" method="post">
                
                <div class="card-body">
                    <input type="hidden" name="token_" value="{{$this->get_Csrf()}}">
                    <div class="card-text"><h5>Datos del estudiante</h5></div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-5 col-12">
                            <div class="form-group">
                                <label for="dni">DNI(*)</label>
                                <input type="text" name="dni" id="dni" class="form-control"
                                placeholder="DNI....">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-7 col-12">
                            <div class="form-group">
                                <label for="nombres">NOMBRES(*)</label>
                                <input type="text" name="nombres" id="nombres" class="form-control"
                                placeholder="NOMBRES....">
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 col-md-5 col-12">
                            <div class="form-group">
                                <label for="apellidos">APELLIDOS(*)</label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control"
                                placeholder="APELLIDOS....">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-7 col-12">
                            <div class="form-group">
                                <label for="dni">TELEFONO</label>
                                <input type="text" name="telefono" id="telefono" class="form-control"
                                placeholder="TELEFONO....">
                            </div>
                        </div>

                        <div class="col-xl-9 col-lg-8  col-12">
                            <div class="form-group">
                                <label for="direccion">DIRECCIÓN</label>
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                placeholder="DIRECCIÓN....">
                            </div>
                        </div>
                    </div>

                    <div class="card-text"><h5>Datos del usuario</h5></div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username">USERNAME(*)</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                    placeholder="USERNAME....">
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-7 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email_">EMAIL(*)</label>
                                    <input type="email" name="email_" id="email_" class="form-control"
                                    placeholder="EMAIL....">
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-5 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password">PASSWORD(*)</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                    placeholder="PASSWORD....">
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-7 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="foto">PASSWORD(*)</label>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>
                            </div>
                        </div>

                </div>

                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-12 ">
                            <button class="btn btn-primary btn-block" name="grabar">Guardar
                                <i class="fas fa-save"></i>
                            </button>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-4 col-12 ">
                            <button class="btn btn-danger btn-block" name="cancelar">Cancelar
                                <i class="fas fa-window-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
 
@endsection

 