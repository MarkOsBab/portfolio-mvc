@extends('app')
@section('content')
<main>
    @include('dashboard.components.navbar')
    <div class="d-flex">
        <div class="col-1">
            @include('dashboard.components.aside')
        </div>
        <div class="col">
            @yield('container') 
        </div>
    </div>
</main>
@endsection