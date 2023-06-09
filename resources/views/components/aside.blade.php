<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{$this->route("dashboard")}}" class="brand-link">
      <img src="{{$this->asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistema de notas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{$this->asset("dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{$this->route("dashboard")}}" class="d-block">{{$this->profile()->username}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if ($this->hasPermission("Administrador"))
          <li class="nav-item">
            <a href="{{$this->route("usuario")}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              
              </p>
            </a>
          </li>
          @endif

          @if ($this->hasPermission("Administrador"))
          <li class="nav-item">
            <a href="{{$this->route("estudiante")}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Estudiantes
              </p>
            </a>
          </li>
          @endif

          @if ($this->hasPermission("Administrador"))
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Docentes
              </p>
            </a>
          </li>
          @endif

          @if ($this->hasPermission("Administrador"))
          <li class="nav-item">
            <a href="{{$this->route("curso")}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Cursos
              </p>
            </a>
          </li>
          @endif

          @if ($this->hasPermission("Administrador"))
          <li class="nav-item">
            <a href="{{$this->route("semestreacademico")}}" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                semestre académico
              </p>
            </a>
          </li>
          @endif

          @if ($this->hasPermission("Estudiante"))
           
          @if ($this->AperturaInscripcion())
          <li class="nav-item">
            <a href="{{$this->route("inscripcion")}}" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Inscripción <span>{{$this->getSemestre()[0]->name_semestre_academico}}</span>
              </p>
            </a>
          </li>
          @endif
          @endif

          @if ($this->hasPermission("Estudiante"))
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Boleta de notas
              </p>
            </a>
          </li>
          @endif

          @if ($this->hasPermission("Docente"))

           @if($this->AperturaLlenadoNotas())
          <li class="nav-item">
            <a href="{{$this->route("docente/llenadonotas")}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Llenado de notas
              </p>
            </a>
          </li>
          @endif
          @endif

          @if ($this->hasPermission("Administrador"))

          <li class="nav-item">
            <a href="{{$this->route("configuracion")}}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Configuración
              </p>
            </a>
          </li>

          @endif
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>