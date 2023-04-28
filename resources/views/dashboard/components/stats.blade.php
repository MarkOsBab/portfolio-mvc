<div class="d-flex justify-content-evenly align-items-center flex-wrap">
    <div class="col m-2">
        <div class="d-flex justify-content-center align-items-center bg-white rounded-5" style="max-height: 120px;">
            <div class="col bg-primary text-center py-5 rounded-end rounded-3" style="max-height: 120px;">
                <i class="fa-solid fa-layer-group fa-2xl"></i>
            </div>
            <div class="col m-2">
                <p class="text-muted">Proyectos publicados</p>
                <h1 class="text-dark"><span class="text-primary">#</span>{{$projectsCount}}</h1>
            </div>
        </div>
    </div>
    <div class="col m-2">
        <div class="d-flex justify-content-center align-items-center bg-white rounded-5" style="max-height: 120px;">
            <div class="col bg-primary text-center py-5 rounded-end rounded-3" style="max-height: 120px;">
                <i class="fa-solid fa-gears fa-2xl"></i>
            </div>
            <div class="col m-2">
                <p class="text-muted">Servicios publicados</p>
                <h1 class="text-dark"><span class="text-primary">#</span>{{$servicesCount}}</h1>
            </div>
        </div>
    </div>
    <div class="col m-2">
        <div class="d-flex justify-content-center align-items-center bg-white rounded-5" style="max-height: 120px;">
            <div class="col bg-primary text-center py-5 rounded-end rounded-3" style="max-height: 120px;">
                <i class="fa-solid fa-newspaper fa-2xl"></i>
            </div>
            <div class="col m-2">
                <p class="text-muted">Noticias publicadas</p>
                <h1 class="text-dark"><span class="text-primary">#</span>{{$newsCount}}</h1>
            </div>
        </div>
    </div>
    <div class="col m-2">
        <div class="d-flex justify-content-center align-items-center bg-white rounded-5" style="max-height: 120px;">
            <div class="col bg-primary text-center py-5 rounded-end rounded-3" style="max-height: 120px;">
                <i class="fa-solid fa-tags fa-2xl"></i>
            </div>
            <div class="col m-2">
                <p class="text-muted">Tags totales</p>
                <h1 class="text-dark"><span class="text-primary">#</span>{{$tagsCount}}</h1>
            </div>
        </div>
    </div>
</div>
@props(['projectsCount', 'servicesCount', 'newsCount'])