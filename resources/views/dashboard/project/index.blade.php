@extends('dashboard.index')
@section('container')
    <div class="p-3">
        <div class="container-fluid">
            <h1>Proyectos</h1>
            <a class="btn btn-primary m-2" href="{{route('projects.create')}}">
                Crear nuevo
            </a>
            <div class="py-3">
                @if(session('status'))
                    <div class="alert alert-warning">{{ session('status') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-dark table-bordered table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($projects as $item)
                      <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <b>...</b>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{route('projects.edit', $item->id)}}">
                                            <i class="fa-solid fa-pen-to-square text-info"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <form id="delete-form" action="{{ route('projects.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="fa-solid fa-trash text-danger"></i> Eliminar
                                            </button>   
                                        </form>
                                        <button type="button" class="dropdown-item" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                            <i class="fa-solid fa-trash text-danger"></i> Eliminar
                                        </button>                                                                                                                    
                                    </li>
                                </ul>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <div class="justify-content-center">
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection