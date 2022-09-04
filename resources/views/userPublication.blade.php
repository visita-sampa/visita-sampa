@foreach($publications as $post)
<div class="grid-item" id="post-{{ $post->id_publicacao }}">
  <div class="local-image">
    <img src="{{ $post->midia }}" class="card-img-top" alt="" />
    <div class="open-image">
      <button type="button" name="btn" class="btn-see-more" data-toggle="modal" data-target="#post-modal" value="Abrir Publicação">{{ __('Abrir Publicação') }}</button>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="post-modal" tabindex="-1" role="dialog" aria-labelledby="post-modal-label" aria-hidden="true">
    <div class="close-publication">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="close-post" aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-dialog modal-dialog-explore" role="document">
      <div class="modal-content">
        <div class="modal-body modal-body-explore">
          <div class="modal-image">
            <img src="{{ $post->midia }}" class="img-publication" alt="" />
          </div>
          <!-- Informações Usuário -->
          <div class="container-info">
            <div class="modal-header modal-header-explore">
              <div class="user">
                <div class="user-image">
                  <img src="{{ $user->foto_perfil == '' ? '/img/users/profileDefault.png' : $user->foto_perfil}}" alt="Foto de Perfil do Usuário" />
                </div>
                <div class="user-information">
                  <p class="user-name">
                    {{ $user->nome }}
                  </p>
                  <p class="user-localization">
                  {{ $post->nome_ponto_turistico }}
                  </p>
                </div>
              </div>
              <!-- Editar -->
              <div class="edit-publication">
                <button class="edit" type="button">
                  <i class="icon-more-vertical" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar ou Excluir" data-toggle="modal" data-target="#editModal"></i>
                </button>
              </div>

              <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered edit-modal" role="document">
                  <div class="modal-content edit-modal">
                    <form method="POST" action="{{ route('update.publication', ['language'=>app()->getLocale(), 'id'=>$post->id_publicacao]) }}">
                      @csrf
                      <div class="modal-header edit-modal">
                        <h5 class="modal-title" id="editModalTitle">Editar ou Excluir</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body edit-modal">
                        <h5 class="title-edit">Editar</h5>
                        <div class="form-floating textarea">
                          <textarea class="form-control" id="floatingLegend" name="floatingLegend" placeholder="Legenda">{{ $post->legenda }}</textarea>
                          <label for="floating-legend">Legenda</label>
                        </div>
  
                        <h5 class="title-edit">Deseja excluir publicação?</h5>
                        <button class="delete" type="button" onclick="deletePublication({{ $post->id_publicacao}} )"><i class="icon-alert-circle"></i>Excluir publicação</button>
                      </div>
                      <div class="modal-footer edit-modal">
                        <button type="button" class="btn close" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn save">Salvar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Comentário Publicação -->
            <div class="comment-publication">
            <div class="comment">
              <div class="user">
                <div class="user-image">
                  <img src="{{ $user->foto_perfil == '' ? '/img/users/profileDefault.png' : $user->foto_perfil}}" alt="Foto de Perfil do Usuário" />
                </div>
              </div>
              <p class="user-comment">
                <span class="name-comment">{{ $user->nome }}</span>
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
  </div>
</div>
@endforeach