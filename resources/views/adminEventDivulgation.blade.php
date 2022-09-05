@foreach ($events as $event)
<div class="grid-item" id="event-{{ $event->id_evento }}">
  <div class="local-image">
    <img src="{{ $event->imagem }}" class="card-img-top" alt="Nome Evento" />
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $event->nome }}</h5>
    <div class="card-text">
      <p class="localization"><i class="icon-map-pin two"></i>{{ $event->local_evento }}</p>
      <p class="time"><i class="icon-clock"></i>{{ __($event->data_evento) }}</p>
    </div>
  </div>
  <div class="btn-delete-event">
    <button type="button" class="btn-delete" data-toggle="modal" data-target="#deleteEvent-{{ $event->id_evento }}" value="Excluir">{{ __('Excluir') }}</button>
  </div>
</div>

<div class="modal fade" id="deleteEvent-{{ $event->id_evento }}" tabindex="-1" role="dialog" aria-labelledby="deleteEventTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content delete">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteEventLongTitle">{{ __('Excluir') }}</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body delete">
        {{ __('Tem certeza que deseja excluir esse evento?') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-confirmation" data-dismiss="modal">{{ __('Cancelar') }}</button>
        <button type="button" class="btn btn-primary delete" onclick="deleteEvent({{ $event->id_evento }})">{{ __('Excluir') }}</button>
      </div>
    </div>
  </div>
</div>
@endforeach