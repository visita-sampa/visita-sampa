@foreach ($events as $event)
<div class="grid-item">
  <div class="local-image">
    <img src="{{$event->imagem}}" class="card-img-top" alt="{{$event->nome}}" />
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$event->nome}}</h5>
    <div class="card-text">
      <p class="localization"><i class="icon-map-pin two"></i> {{$event->local_evento}}</p>
      <p class="time"><i class="icon-clock"></i> {{$event->data_evento}}</p>
    </div>
  </div>
  <div class="btn-information">
    <a href="{{$event->link}}" target="_blank" class="btn-see-more">{{ __('Ver Mais') }}</a>
  </div>
</div>
@endforeach