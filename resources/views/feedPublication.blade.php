@foreach ($publications as $post)
<div class="card">
  <div class="user">
    <div class="user-image">
      <img src="{{$post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="{{ __('Foto de Perfil do Usuário') }}" />
    </div>
    <div class="post-header">
      <p class="user-name">
        {{$post->nome_usuario}}
      </p>
      <button class="report" type="button" data-bs-toggle="modal" data-bs-target="#report-post-modal-{{ $post->id_publicacao }}">
        <i class="icon-alert-triangle"></i>
      </button>
      <div class="modal fade" id="report-post-modal-{{ $post->id_publicacao }}" tabindex="-1" aria-labelledby="report-post-modal-label-{{ $post->id_publicacao }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content modal-content-feed">
            <div class="modal-header">
              <h5 class="modal-title" id="report-post-modal-title-{{ $post->id_publicacao }}">{{ __('DENÚNCIA') }}</h5>
            </div>
            <div class="modal-body modal-body-feed">
              <p>{{ __('Deseja mesmo denunciar essa publicação') }}?</p>
            </div>
            <div class="modal-footer modal-footer-feed">
              <button type="button" class="btn cancel" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>

              <button type="button" class="btn denounce" data-bs-toggle="modal" data-bs-target="#report-post-modal-two-{{ $post->id_publicacao }}">
                {{ __('Denunciar') }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="report-post-modal-two-{{ $post->id_publicacao }}" tabindex="-1" aria-labelledby="report-post-modal-two-label-{{ $post->id_publicacao }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content modal-content-feed two">
            <div class="modal-header">
              <div class="text">
                <h5 class="modal-title" id="report-post-modal-two-title-{{ $post->id_publicacao }}">{{ __('Denunciar') }}</h5>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="formReport">
              @csrf
              <div class="modal-body modal-body-feed two">
                <label for="motiveDenounces">{{ __('Por que deseja denunciar essa publicação') }}?</label>
                <textarea name="motiveDenounces" placeholder="{{ __('Explique seu motivo') }}" id="motive-denounces-{{ $post->id_publicacao }}" cols="50" rows="10"></textarea>
                <input type="hidden" name="idPostDenouce" value="{{ $post->id_publicacao }}">
              </div>
              <div class="modal-footer modal-footer-feed two">
                <button type="submit" class="btn denounce">{{ __('Enviar') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <img src="{{$post->midia}}" class="card-img-top" alt="{{$post->nome_ponto_turistico}}" />
  <div class="card-body">
    <p class="card-text">
      {{$post->legenda}}
    </p>
  </div>
</div>
@endforeach