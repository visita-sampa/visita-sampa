@foreach($publications as $post)
<div class="grid-item">
  <div class="local-image">
    <img src="{{ $post->midia }}" class="card-img-top" alt="{{ $post->nome_ponto_turistico }}" />
    <div class="open-image">
      <button type="button" name="btn" class="btn-see-more" data-toggle="modal" data-target="#post-modal-{{ $post->id_publicacao }}" value="Abrir Publicação">{{ __('Abrir Publicação') }}</button>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="post-modal-{{ $post->id_publicacao }}" tabindex="-1" role="dialog" aria-labelledby="post-modal-label-{{ $post->id_publicacao }}" aria-hidden="true">
    <div class="close-publication">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="close-post" aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-dialog modal-dialog-tourist-spot" role="document">
      <div class="modal-content">
        <div class="modal-body modal-body-tourist-spot">
          <div class="modal-image">
            <img src="{{ $post->midia }}" class="img-publication" alt="{{ $post->nome_ponto_turistico }}" />
          </div>
          <!-- Informações Usuário -->
          <div class="modal-header modal-header-tourist-spot">
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
              <i class="icon-alert-triangle"></i>
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
              Editado - Há menos de um dia
              @else
              Editado - Há {{ $post->updated_at }} dias
              @endif
              @endif
              @if(is_numeric($post->data))
              @if($post->data == 0)
              Há menos de um dia
              @else
              Há {{ $post->data }} dias
              @endif
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="report-post-modal-{{ $post->id_publicacao }}" tabindex="-1" aria-labelledby="report-post-modal-label-{{ $post->id_publicacao }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-tourist-spot">
      <div class="modal-content">
        <div class="modal-header modal-header-tourist-spot">
          <h5 class="modal-title" id="report-post-modal-title-{{ $post->id_publicacao }}">{{ __('DENÚNCIA') }}</h5>
        </div>
        <div class="modal-body">
          <p>{{ __('Deseja mesmo denunciar essa publicação') }}?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn cancel" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>

          <button type="button" class="btn denounce" data-bs-toggle="modal" data-bs-target="#report-post-modal-two-{{ $post->id_publicacao }}">
            {{ __('Denunciar') }}
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="report-post-modal-two-{{ $post->id_publicacao }}" tabindex="-1" aria-labelledby="report-post-modal-two-label-{{ $post->id_publicacao }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-tourist-spot">
      <div class="modal-content two">
        <div class="modal-header modal-header-tourist-spot">
          <div class="text">
            <h5 class="modal-title" id="report-post-modal-two-title-{{ $post->id_publicacao }}">{{ __('Denunciar') }}</h5>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body two">
          <p>{{ __('Por que deseja denunciar essa publicação') }}?</p>
          <textarea name="motive-denounces" placeholder="{{ __('Explique seu motivo') }}" id="motive-denounces-{{ $post->id_publicacao }}" cols="50" rows="10"></textarea>
        </div>
        <div class="modal-footer two">
          <button type="button" class="btn denounce">{{ __('Enviar') }}</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach