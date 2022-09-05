@if (Auth::user())
<nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
  <div class="container">
    <a href="{{ route('home', app()->getLocale()) }}">
      <img class="logo" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
    </a>
    <div class="sec-center">
      <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
      <label class="for-dropdown" for="dropdown">
        <i class="icon-arrow_drop_down"></i>
        <img src="{{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}}" alt="" class="profile-img-menu rounded-circle" alt="Foto Perfil Usuário" />
      </label>
      <div class="section-dropdown">
        <input class="dropdown-profile" type="checkbox" id="dropdown-profile" name="dropdown-profile" />
        <label class="for-dropdown-profile" for="dropdown-profile">
          <a href="user">
            <i class="icon-user"></i>
            <span>{{ __('Meu Perfil') }}</span>
          </a>
        </label>

        <input class="dropdown-settings" type="checkbox" id="dropdown-settings" name="dropdown-settings" data-bs-toggle="dropdown"/>
        <label class="for-dropdown-settings" for="dropdown-settings" data-bs-toggle="dropdown">
          <i class="icon-settings"></i>
          <span id="config" data-toggle="modal" data-target="#modalConfiguration">{{ __('Configurações') }}</span>
        </label>

        <input class="dropdown-translate" type="checkbox" id="dropdown-translate" name="dropdown-translate" />
        <label class="for-dropdown-translate" for="dropdown-translate" id="for-dropdown-translate">
          <div class="option-translate">
            <i class="icon-translate"></i>
            <span>{{ __('Idioma') }}<i class="icon-arrow_drop_down"></i></span>
          </div>
          <ul class="translate" id="translate">
            <li class="portuguese">
              <a href="{{ route(Route::currentRouteName(), 'pt') }}" id="pt-br">
                <i class="icon-brazil"></i>
                PT-BR
              </a>
            </li>
            <li class="english">
              <a href="{{ route(Route::currentRouteName(), 'en') }}" id="en-us">
                <i class="icon-usa"></i>
                EN-US
              </a>
            </li>
          </ul>
        </label>

        <input class="dropdown-paper" type="checkbox" id="dropdown-paper" name="dropdown-paper" />
        <label class="for-dropdown-paper" for="dropdown-paper">
          <i class="icon-paper"></i>
          <span id="terms" data-toggle="modal" data-target="#modalTerms">{{ __('Termo de Uso') }}</span>
        </label>

        <input class="dropdown-alert" type="checkbox" id="dropdown-alert" name="dropdown-alert" />
        <label class="for-dropdown-alert" for="dropdown-alert">
          <i class="icon-alert-circle"></i>
          <span id="about" data-toggle="modal" data-target="#modalAbout">{{ __('Sobre') }}</span>
        </label>

        <input class="dropdown-log-out" type="checkbox" id="dropdown-log-out" name="dropdown-log-out" />
        <label class="for-dropdown-log-out" for="dropdown-log-out">
          <a href="{{ route('logout', app()->getLocale()) }}">
            <i class="icon-log-out"></i>
            <span>{{ __('Sair') }}</span>
          </a>
        </label>
      </div>

      <!-- Modais -->
      <div class="modal fade" id="modalConfiguration" tabindex="-1" role="dialog" aria-labelledby="modalConfiguration" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form method="POST" action="{{ route('update.profile', app()->getLocale()) }}">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="modalConfigurationTitle">{{ __('Configurações') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body modal-body-user">
                <div style="background-image: url({{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}})" alt="" class="profile-img rounded-circle" id="image-preview"></div>
                <label for="profile-pic" class="change-picture">
                  {{ __('Alterar foto de perfil') }}
                </label>
                <input type="file" name="profile-pic" id="profile-pic" class="d-none image-upload image-upload-config" />
                <input type="hidden" name="base64image" id="base64image" />
                <div class="bio">
                  <span class="bio-title"><i class="icon-user"></i>{{ __('Editar Perfil') }}</span>
                  <div class="form-floating" id="nameContent">
                    <input type="text" class="form-control" id="floatingName" placeholder="{{ __('Nome') }}" value="{{Auth::user()->nome}}">
                    <label for="floating-name">{{ __('Nome') }}</label>
                  </div>
                  <div class="form-floating" id="usernameContentFloating">
                    <input type="text" class="form-control" id="floatingUsername" placeholder="{{ __('Nome de usuário') }}" value="{{Auth::user()->nome_usuario}}">
                    <label for="floating-user-name">{{ __('Nome de usuário') }}</label>
                    <span id="loading" class="loading-username">Verificando nome</span>
                  </div>
                  <div class="form-floating textarea">
                    <textarea class="form-control" id="floatingBio" maxlength="128" placeholder="Bio">{{Auth::user()->descricao}}</textarea>
                    <label for="floating-bio">Bio</label>
                  </div>
                </div>
                <div class="password">
                  <span class="password-title"><i class="icon-lock"></i>{{ __('Senha') }}</span>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="{{ __('Senha atual') }}">
                    <label for="floating-password">{{ __('Senha atual') }}</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingNewPassword" placeholder="{{ __('Nova senha') }}">
                    <label for="floating-new-password">{{ __('Nova senha') }}</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingRepeatPassword" placeholder="Repita a nova senha">
                    <label for="floating-repeat-password">{{ __('Repita a nova senha') }}</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">{{ __('Fechar') }}</button>
                <button type="submit" class="btn btn-primary save">{{ __('Salvar') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalTerms" tabindex="-1" aria-labelledby="modalTerms" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTermsTitle">{{ __('Termo de Uso') }}</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <!-- <span aria-hidden="true">&times;</span> -->
              </button>
            </div>
            <div class="modal-body text-center p-3">
              <h6><u>{{ __('Política de Privacidade e Proteção de Dados Pessoais') }}</u></h6>
              <p>
                <em>{{ __('Atualizado em') }} 17/08/2022</em>
              </p>
              <br />
              <div class="text-start">
                <p>
                  {{ __('Ao utilizar o sistema, você está concordando com os Termos de Uso') }}.
                </p>
                <p>
                  {{ __('Os dados utilizados pelo sistema não são públicos e não serão divulgados pela entidade responsável pela aplicação') }}.
                </p>
                <p>
                  {{ __('Para manter a rede funcionando de maneira amigável, o usuário não deve postar fotos indevidas no website, além de publicar apenas fotos condizente com o local selecionado no roteiro') }}.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalAbout" tabindex="-1" aria-labelledby="modalAbout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAboutTitle">{{ __('Sobre') }}</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
              <img class="logo my-3" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
              <p>
                {{ __('Plataforma WEB com informações a respeito da cultura paulistana, indicações de locais da cidade e eventos que ocorrerão') }}
              </p>
              <p class="text-blue my-3">
                {{ __('Fale Conosco') }}
              </p>
              <div class="d-flex justify-content-evenly mb-3">
                <div class="email">
                  <a href="mailto:sigma5.equipe@gmail.com" class="text-decoration-none text-dark fs-6">
                    <i class="icon-mail fs-6"></i>
                    <h6 class="fs-6" title="sigma5.equipe@gmail.com">E-mail</h6>
                  </a>
                </div>
                <div class="form">
                  <a href="{{ route('contact', app()->getLocale()) }}" class="text-decoration-none text-dark fs-6">
                    <i class="icon-message-circle fs-6"></i>
                    <h6 class="fs-6">{{ __('Formulário') }}</h6>
                  </a>
                </div>
              </div>
              <p>
                {{ __('Para mais informações, entre em um dos links abaixo') }}:
              </p>
              <div class="d-flex justify-content-around mt-3">
                <a href="https://sigma-equipe.blogspot.com" class="text-decoration-none text-dark" target="_blank">
                  <i class="icon-blogger fs-5"></i>
                </a>
                <a href="https://github.com/visita-sampa" class="text-decoration-none text-dark" target="_blank">
                  <i class="icon-github fs-5"></i>
                </a>
                <a href="https://www.youtube.com/channel/UCQ9lG55gNSXKlr6X9af336w/featured" class="text-decoration-none text-dark" target="_blank">
                  <i class="icon-youtube-play fs-5"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<script>
  $('#modalConfiguration').appendTo("body");
  $('#modalTerms').appendTo("body");
  $('#modalAbout').appendTo("body");

  $(document).ready(function() {
      $('#floatingUsername').on('focusout', function() {
        var value = $(this).val();
        $('#btn-submit').addClass("disabled");

        let msg = document.getElementById("msgUsername");
        if (msg) usernameContentConfig.removeChild(msg);
        if (value === "") {
          msgAlert(usernameContentConfig, "Campo obrigatório", "msgUsername");
          usernameFlag = false;
          return;
        }
        $.ajax({
            url: "{{ route('username.availability', app()->getLocale()) }}",
            type: 'GET',
            data: {
              'floatingUsername': value
            },
            beforeSend: () => {
              let msg = document.getElementById("msgUsername");
	            if (msg)
                usernameContentConfig.removeChild(msg);;
              $("#loading").css('display','block');
              usenameFlag = false;
            },
            complete: () => {
              $("#loading").css('display','none');
            }
          })
          .done((response) => {
            if (response) {
              $('#btn-submit').removeClass("disabled");

              let msg = document.getElementById("msgUsername");
              usernameFlag = true;
	            if (msg)
                usernameContentConfig.removeChild(msg);
            } else {
              msgAlert(usernameContentConfig,'Nome já utilizado','msgUsername');
              usernameFlag = false;
            }
          })
      });
    });


</script>

@else
<nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
  <div class="container">
    <a href="{{ route('home', app()->getLocale()) }}">
      <img class="logo" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
    </a>

    <div class="sec-center">
      <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
      <label class="for-dropdown" for="dropdown">
        <i class="icon-menu"></i>
      </label>
      <div class="section-dropdown">
        <input class="dropdown-profile" type="checkbox" id="dropdown-profile" name="dropdown-profile" />
        <label class="for-dropdown-profile user" for="dropdown-profile">
          <a href="{{ route('signup', app()->getLocale()) }}">
            <i class="icon-user"></i>
            <span>{{ __('Criar conta')}}</span>
          </a>
        </label>

        <input class="dropdown-translate" type="checkbox" id="dropdown-translate" name="dropdown-translate" />
        <label class="for-dropdown-translate user-account" for="dropdown-translate" id="for-dropdown-translate">
          <div class="option-translate">
            <i class="icon-translate"></i>
            <span class="user-without-account">{{ __('Idioma') }}<i class="icon-arrow_drop_down"></i></span>
          </div>
          <ul class="translate" id="translate">
            <li class="portuguese">
              <a href="{{ route(Route::currentRouteName(), 'pt') }}" id="pt-br">
                <i class="icon-brazil"></i>
                PT-BR
              </a>
            </li>
            <li class="english user">
              <a href="{{ route(Route::currentRouteName(), 'en') }}" id="en-us">
                <i class="icon-usa"></i>
                EN-US
              </a>
            </li>
          </ul>
        </label>
      </div>
    </div>
  </div>
</nav>
@endif