<div class="d-flex flex-column flex-shrink-0 d-sm-none d-md-block" style="width: 4.5rem; background-color: #e3f2fd;">
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center text-dark">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link py-3 border-bottom {{ Request::path() == 'dashboard' ? 'active' : '' }}" title="Inicio" data-bs-toggle="tooltip" data-bs-placement="right">
          <i class="fa-solid fa-house fa-xl"></i>  
        </a>
      </li>
      <li>
        <a href="{{route('projects.index')}}" class="nav-link py-3 border-bottom {{ Request::is('dashboard/projects', 'dashboard/projects/*') ? 'active' : '' }}" title="Proyectos" data-bs-toggle="tooltip" data-bs-placement="right">
          <i class="fa-solid fa-layer-group fa-xl"></i>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link py-3 border-bottom" title="Servicios" data-bs-toggle="tooltip" data-bs-placement="right">
          <i class="fa-solid fa-gears fa-xl"></i>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link py-3 border-bottom" title="Contactos" data-bs-toggle="tooltip" data-bs-placement="right">
          <i class="fa-solid fa-envelope fa-xl"></i>
        </a>
      </li>
    </ul>
</div>