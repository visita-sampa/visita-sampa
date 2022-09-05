@if(Auth::user()->id_usuario == 1)
<nav class="nav-bottom position-fixed">
  <ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('adminReport', app()->getLocale()) }}">
        <i class="icon-alert-triangle" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Denúncias') }}"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('explore', app()->getLocale()) }}">
        <i class="icon-globe" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Explorar') }}"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('event', app()->getLocale()) }}">
        <i class="icon-map-pin" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Eventos') }}"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="adminEvents">
        <i class="icon-edit-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Criar Evento') }}"></i>
      </a>
    </li>
  </ul>
</nav>
@else
<nav class="nav-bottom position-fixed">
  <ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('feed', app()->getLocale()) }}">
        <i class="icon-image" data-bs-toggle="tooltip" data-bs-placement="top" title="Feed"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('explore', app()->getLocale()) }}">
        <i class="icon-globe" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Explorar') }}"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('user', app()->getLocale()) }}">
        <i class="icon-user" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Perfil') }}"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('event', app()->getLocale()) }}">
        <i class="icon-map-pin" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Eventos') }}"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('quiz', app()->getLocale()) }}">
        <i class="icon-edit-3" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Teste de Personalidade') }}"></i>
      </a>
    </li>
  </ul>
</nav>
@endif