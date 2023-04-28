@extends('app')
@section('content')
<main>
    @include('dashboard.components.navbar')
    <div class="d-flex">
        <div class="col-1 d-none d-lg-block d-xl-block">
            @include('dashboard.components.aside')
        </div>
        <div class="col container-fluid">
            @yield('container')
        </div>
    </div>
</main>
@endsection