@foreach($profiles as $profile)
<a href="{{ route('user.show', ['language'=>app()->getLocale(), 'id'=>$profile->nome_usuario]) }}" onclick="event.stopPropagation();">
  <li class="list-group-item border-top-0 border-start-0 border-end-0">
    {{ $profile->nome }} <span class="text-muted">&#64;{{ $profile->nome_usuario }}</span>
  </li>
</a>
@endforeach