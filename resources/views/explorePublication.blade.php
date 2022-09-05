@foreach($publications as $post)
<div class="grid-item">
  <div class="local-image">
    <img src="{{ $post->midia }}" class="card-img-top" alt="{{ $post->nome_ponto_turistico }}" />
    <div class="open-image">
      <button type="button" name="btn" class="btn-see-more" data-toggle="modal" data-target="#post-modal-{{ $post->id_publicacao }}" value="Abrir Publicação">{{ __('Abrir Publicação') }}</button>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" onfocus="overlapModalClose({{ $post->id_publicacao }})" id="post-modal-{{ $post->id_publicacao }}" tabindex="-1" role="dialog" aria-labelledby="post-modal-label-{{ $post->id_publicacao }}" aria-hidden="true">
    <div class="close-publication">
      <button type="button" class="close close-all" data-dismiss="modal" aria-label="Close">
        <span class="close-post" aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-dialog pub" role="document">
      <div class="modal-content">
        <div class="modal-body modal-body-explore">
          <div class="modal-image">
            <img src="{{ $post->midia }}" class="img-publication" alt="{{ $post->nome_ponto_turistico }}" />
          </div>
          <div class="container-information">
            <!-- Informações Usuário -->
            <div class="modal-header modal-header-explore justify-content-between">
              <div class="user">
                <div class="user-image">
                  <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="Foto de Perfil do Usuário" />
                </div>
                <div class="user-information">
                  <p class="user-name">
                    {{ $post->nome }}
                  </p>
                  <p class="user-localization">
                    {{ $post->nome_ponto_turistico }}
                  </p>
                </div>
              </div>
              <!-- Denuncia -->
              <button class="report" type="button" data-toggle="modal" data-target="#report-post-modal-{{ $post->id_publicacao }}">
                <i class="icon-alert-triangle report"></i>
              </button>
            </div>
            <!-- Comentário Publicação -->
            <div class="comment-publication">
              <div class="comment">
                <div class="user">
                  <div class="user-image">
                    <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="Foto de Perfil do Usuário" />
                  </div>
                </div>
                <p class="user-comment">
                  <span class="name-comment">{{ $post->nome }}</span>
                  {{ $post->legenda }}
                </p>
              </div>
              <p class="post-date">
                @if(is_numeric($post->updated_at))
                @if($post->updated_at == 0)
                {{ __('Editado - Há menos de um dia') }}
                @else
                {{ __('Editado - Há') }} {{ $post->updated_at }} {{ __('dias') }}
                @endif
                @endif
                @if(is_numeric($post->data))
                @if($post->data == 0)
                {{ __('Há menos de um dia') }}
                @else
                {{ __('Há') }} {{ $post->data }} {{ __('dias') }}
                @endif
                @endif
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" onfocus="overlapModal({{ $post->id_publicacao }})" onblur="overlapModalClose({{ $post->id_publicacao }})" id="report-post-modal-{{ $post->id_publicacao }}" tabindex="-1" aria-labelledby="report-post-modal-label-{{ $post->id_publicacao }}" aria-hidden="true">
    <div class="modal-dialog explore">
      <div class="modal-content explore">
        <div class="modal-header">
          <h5 class="modal-title" id="report-post-modal-title-{{ $post->id_publicacao }}">{{ __('DENÚNCIA') }}</h5>
        </div>
        <div class="modal-body d-flex justify-content-center text-center align-items-center">
          <p>{{ __('Deseja mesmo denunciar essa publicação') }}?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn cancel close-all" aria-label="Close" data-dismiss="modal" onclick="overlapModalClose({{ $post->id_publicacao }})">{{ __('Cancelar') }}</button>

          <button type="button" class="btn denounce" data-toggle="modal" data-target="#report-post-modal-two-{{ $post->id_publicacao }}">
            {{ __('Denunciar') }}
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" onfocus="overlapModal({{ $post->id_publicacao }})" id="report-post-modal-two-{{ $post->id_publicacao }}" tabindex="-1" aria-labelledby="report-post-modal-two-label-{{ $post->id_publicacao }}" aria-hidden="true">
    <div class="modal-dialog explore">
      <div class="modal-content explore-two">
        <div class="modal-header ">
          <div class="text-center w-100 position-absolute">
            <h5 class="modal-title" id="report-post-modal-two-title-{{ $post->id_publicacao }}">{{ __('Denunciar') }}</h5>
          </div>
          <button type="button" class="btn-close close-all" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="formReport">
          @csrf
          <div class="modal-body d-flex flex-column justify-content-center align-items-center">
            <label class="my-3" for="motiveDenounces">{{ __('Por que deseja denunciar essa publicação') }}?</label>
            <textarea class="p-2" name="motiveDenounces" placeholder="{{ __('Explique seu motivo') }}" id="motive-denounces-{{ $post->id_publicacao }}" cols="50" rows="10"></textarea>
            <input type="hidden" name="idPostDenouce" value="{{ $post->id_publicacao }}">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn denounce">{{ __('Enviar') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach