<section id="knowledge">
  <div class="container">
    <h2>Mis conocimientos</h2>
    <div class="container-divider">
      <div class="knowledge-list">
        <ul>
          @foreach ($services as $item)
          <li data-info="{{ json_encode($item) }}">{{ $item->name }}</li>
          @endforeach
          <!-- Agrega más elementos de la lista si es necesario -->
        </ul>
      </div>
      <div class="knowledge-details">
        <div id="knowledge-info" class="knowledge-info"></div>
      </div>
    </div>
  </div>
</section>