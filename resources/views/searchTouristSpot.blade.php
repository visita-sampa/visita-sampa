@foreach($touristSpot as $place)
<a href="{{ route('touristSpot.show', ['language'=>app()->getLocale(), 'id'=>$place->id_ponto_turistico]) }}" onclick="event.stopPropagation();">
  <li class="list-group-item border-top-0 border-start-0 border-end-0">
    {{ $place->nome_ponto_turistico }}
  </li>
</a>
@endforeach