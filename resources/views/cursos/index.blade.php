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
                    <th>GESTIONAR</th>
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

    {{--MODAL PARA CREAR DOCENTES---}}
    <!-- modalpara para docentes ---->
<div class="modal fade" id="modaldocente">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header"><h5>Crear Docentes</h5>
                <button type="button" class="btn-close cerrar-modal-docente" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
                <div class="modal-body">
                    <div class="m-2" style="display: none" id="alerta-warning">
                        <div class="alert alert-warning errores_alerta">
                             
                        </div>
                    </div>
                    <form action="" method="post" id="form-docente" enctype="multipart/form-data">
                    <div class="m-2" id ="alerta-errores" style="display:none">
                     <div class="alert alert-warning" id="errores">
                         
                     </div>
                    </div>
                    <input type="hidden" name="token_" value="{{$this->get_Csrf()}}">
                    <div class="card-text"><h5>Datos del Docente</h5></div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-5 col-12">
                            <div class="form-group">
                                <label for="dni">DNI(*)</label>
                                <input type="text" name="dni" id="dni" class="form-control"
                                placeholder="DNI...." value="{{$this->old("dni")}}">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-7 col-12">
                            <div class="form-group">
                                <label for="nombres">NOMBRES(*)</label>
                                <input type="text" name="nombres" id="nombres" class="form-control"
                                placeholder="NOMBRES...." value="{{$this->old("nombres")}}">
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 col-md-5 col-12">
                            <div class="form-group">
                                <label for="apellidos">APELLIDOS(*)</label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control"
                                placeholder="APELLIDOS...." value="{{$this->old("apellidos")}}">
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
                                placeholder="USERNAME...." value="{{$this->old("username")}}">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-7 col-md-6 col-12">
                            <div class="form-group">
                                <label for="email_">EMAIL(*)</label>
                                <input type="text" name="email_" id="email_" class="form-control"
                                placeholder="EMAIL...." value="{{$this->old("email_")}}">
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
                   </form>
                </div>
                <div class="modal-footer">
                            <button class="btn btn-success" id="save-docente"><b>Guardar</b></button>
                 </div>
                </div>
 
        </div>
    </div>
@endsection

@section('js')
<script src="{{URL_BASE}}public/js/control.js"></script>
<script>
    var dni = $('#dni');
    var nombres = $('#nombres');
    var apellidos = $('#apellidos');
    var username = $('#username');
    var email = $('#email_');
    var Pasword = $('#password');
  $(document).ready(function(){
   MostrarCursos()

   /// mostrar categorias
   mostrarCategorias()

   /// mostrar docentes
   mostrarDocentes()

   /// crear docente

   $('#crear-docente').click(function(evento){
    evento.preventDefault();
    focusInputModal('modaldocente','dni')
   });

   /// cerra modal curso
   $('.cerrar').click(function(){
     $('#modalcursos').modal("hide")
   });

    /// cerra modal crear docnetes
    $('.cerrar-modal-docente').click(function(){
    
     /// ocultamos la alerta
     $('#alerta-warning').hide()

     $('#modaldocente').modal("hide")
    });

    // registrar docente

    $('#save-docente').click(function(){
     crearDocente();
    });

    /// registrar curso

    $('#save_curso').click(function(evento){
    evento.preventDefault();
    crearCursos();
    })

    /// veneto enter de inputs
    // input dni
    eventEnter(dni,nombres) 
    /// input nombres
    eventEnter(nombres,apellidos);
    /// input apellidos
    eventEnter(apellidos,username)
    /// input username
    eventEnter(username,email)
    /// input email   
    eventEnter(email,Pasword) 


  }); 
  
  /// mostrar los cursos
  function MostrarCursos()
  {
    var TablaCursos = $('#Tabla-cursos').DataTable({
     retrieve:true,
     "ajax":{
        url:"{{$this->route('curso/showCursos')}}?token_={{$this->get_Csrf()}}",
        method:"GET",
        dataSrc:"cursos",
     },
     "columns":[
        {"data":"name_categoria",render:function(data){return '<span class="badge badge-success">'+data+'</span>';}},
        {"data":"nombre_curso"},
        {"data":"descripcion"},
        {"data":"nombres"},
        {"defaultContent":
        `
        <div class='row'>
          <div class='col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12 m-xl-0 m-lg-0 m-md-0 m-1'>
          <button class='btn btn-outline-warning btn-sm' id='editar' style='border-radius:50%'><i class='fas fa-edit'></i></button>  
          </div> 
          
          <div class='col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12 m-xl-0 m-lg-0 m-md-0 m-1'>
          <button class='btn btn-outline-danger btn-sm' id='eliminar' style='border-radius:50%'><i class='fas fa-trash-alt'></i></button>  
          </div> 
        </div>
        `
        }
     ]
    }).ajax.reload()
  }
  function create()
  {
    $('#modalcursos').modal("show")
  }


  /// mostrar las categorias

  function mostrarCategorias()
  {
    let Option="<option selected disabled>--- Seleccione ----</option>";
    $.ajax({
        url:"{{$this->route('categoria/showCategorias')}}?token_={{$this->get_Csrf()}}",
        method:"GET",
        success:function(respuesta)
        {
            respuesta = JSON.parse(respuesta);

            respuesta.response.forEach(categoria => {
                Option+="<option value="+categoria.id_categoria+">"+categoria.name_categoria+"</option>";
            });

            $('#id_categoria').html(Option);
        }
    });
  }

  /// mostrar las Docentes

  function mostrarDocentes()
  {
    let Option="<option selected disabled>--- Seleccione ----</option>";
    $.ajax({
        url:"{{$this->route('docente/showDocentes')}}?token_={{$this->get_Csrf()}}",
        method:"GET",
        success:function(respuesta)
        {
            respuesta = JSON.parse(respuesta);

            respuesta.response.forEach(categoria => {
                Option+="<option value="+categoria.id_docente+">"+categoria.nombres+"</option>";
            });

            $('#id_docente').html(Option);
        }
    });
  }

  /// crear docente 
  function crearDocente()
  {
    var li="";
    let DataForm = new FormData(document.getElementById('form-docente'))
    $.ajax({
        url:"{{$this->route('docente/crearDocente')}}",
        method:"POST",
        data:DataForm,
        processData:false,
        contentType:false,
        success:function(respuesta)
        {
            respuesta = JSON.parse(respuesta);

            if(typeof respuesta.response === 'object')
            {
                $('#alerta-warning').show(600) /// mostrar la alerta 600 milisengundos

                respuesta.response.forEach(errores => {
                    li+="<li>"+errores+"</li>";
                });

                $('.errores_alerta').html(li)
            }
            else{
               if(respuesta.response == 1)
               {
                 Swal.fire({
                    title:"Mensaje del sistema",
                    text:"Docente registrado correctamente",
                    icon:"success"
                 }).then(function(){
                    mostrarDocentes();
                    resetForm('form-docente')
                 })
               }
               else{
                Swal.fire({
                    title:"Mensaje del sistema",
                    text:"error, el archivo seleccionado es incorrecto",
                    icon:"error"
                 })
               }
            }
            
        }
    });
  }

  /// crear cursos

  function crearCursos()
  {
    $.ajax({
        url:"{{$this->route('curso/save')}}",
        method:"POST",///#
        data:$('#form_curso').serialize(),
        success:function(respuesta)
        {
            respuesta = JSON.parse(respuesta);

            if(respuesta.response === 'existe')
            {
                Swal.fire({
                    title:"Mensaje del sistema",
                    text:"el curso con ese nombre ya existe",
                    icon:"warning"
                 })
            }
            else{

                if(respuesta.response == 1)
                {
                    Swal.fire({
                    title:"Mensaje del sistema",
                    text:"curso registrado correctamente",
                    icon:"success"
                 }).then(function(){
                    MostrarCursos();
                    resetForm('form_curso')
                    /// mostrar los cursos
                 });
                }
                else{
                    Swal.fire({
                    title:"Mensaje del sistema",
                    text:"error al registrar curso",
                    icon:"error"
                 })
                }
            }

            
        }
    });
  }

  

</script> 
@endsection