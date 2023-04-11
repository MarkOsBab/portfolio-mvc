<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <li class="nav-item d-md-none d-sm-block">
            <a class="nav-link" href="{{route('dashboard')}}">
              Inicio
            </a>
          </li>
          <li class="nav-item d-md-none d-sm-block">
            <a class="nav-link" href="{{route('projects.index')}}">
              Proyectos
            </a>
          </li>
          <li class="nav-item d-md-none d-sm-block">
            <a class="nav-link" href="{{route('projects.index')}}">
              Servicios
            </a>
          </li>
          <li class="nav-item d-md-none d-sm-block">
            <a class="nav-link" href="{{route('projects.index')}}">
              Contacto
            </a>
          </li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="nav-link active" aria-current="page" href="#" onclick="this.parentNode.submit()"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
          </form>
        </div>
      </div>
    </div>
</nav>