<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Meu Perfil') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/user.css" rel="stylesheet" />
  <link href="/assets/icon/style.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
      <div class="container">
        <a href="home">
          <img class="logo" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
        </a>
        <div class="sec-center">
          <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
          <label class="for-dropdown" for="dropdown">
            <i class="icon-arrow_drop_down"></i>
            <img src="{{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}}" alt="" class="profile-img-menu rounded-circle" alt="Foto Perfil Usuário" />
            <!-- <i class="icon-user"></i> -->
          </label>
          <div class="section-dropdown">
            <input class="dropdown-profile" type="checkbox" id="dropdown-profile" name="dropdown-profile" />
            <label class="for-dropdown-profile" for="dropdown-profile">
              <a href="user">
                <i class="icon-user"></i>
                <span>{{ __('Meu Perfil') }}</span>
              </a>
            </label>

            <input class="dropdown-settings" type="checkbox" id="dropdown-settings" name="dropdown-settings" />
            <label class="for-dropdown-settings" for="dropdown-settings" onclick="openModal('#modalConfiguration')">
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
                  <a href="{{ route(Route::currentRouteName(), 'pt') }}">
                    <i class="icon-brazil"></i>
                    PT-BR
                  </a>
                </li>
                <li class="english">
                  <a href="{{ route(Route::currentRouteName(), 'en') }}">
                    <i class="icon-usa"></i>
                    EN-US
                  </a>
                </li>
              </ul>
            </label>

            <input class="dropdown-paper" type="checkbox" id="dropdown-paper" name="dropdown-paper" />
            <label class="for-dropdown-paper" for="dropdown-paper" onclick="openModal('#modalTerms')">
              <i class="icon-paper"></i>
              <span id="terms" data-toggle="modal" data-target="#modalTerms">{{ __('Termo de Uso') }}</span>
            </label>

            <input class="dropdown-alert" type="checkbox" id="dropdown-alert" name="dropdown-alert" />
            <label class="for-dropdown-alert" for="dropdown-alert" onclick="openModal('#modalAbout')">
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
                <form id="formConfig" method="POST" action="{{ route('update.profile', app()->getLocale()) }}">
                  @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalConfigurationTitle">{{ __('Configurações') }}</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                      <!-- <span aria-hidden="true">&times;</span> -->
                    </button>
                  </div>
                  <div class="modal-body modal-body-user">
                    <div id="image-preview" style="background-image: url({{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}})" alt="" class="profile-img rounded-circle">
                    </div>
                    <label for="profile-pic" class="change-picture">
                      {{ __('Alterar foto de perfil') }}
                    </label>
                    <input type="file" name="profile-pic" id="profile-pic" class="d-none image-upload" />
                    <input type="hidden" name="base64image" id="base64image">
                    <div class="bio">
                      <span class="bio-title"><i class="icon-user"></i>{{ __('Editar Perfil') }}</span>
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingName" name="floatingName" placeholder="{{ __('Nome') }}" value="{{Auth::user()->nome}}">
                        <label for="floatingName">{{ __('Nome') }}</label>
                      </div>

                      <div class="form-floating" id="usernameContent">
                          <input type="text" class="form-control" id="floatingUsername" name="floatingUsername" placeholder="{{ __('Nome de usuário') }}" value="{{Auth::user()->nome_usuario}}">
                          <label for="floatingUsername">{{ __('Nome de usuário') }}</label>
                          <span id="loading" class="messageLoading">Verificando nome...</span>
                      </div>

                      <div class="form-floating textarea">
                        <textarea class="form-control" id="floatingBio" name="floatingBio" maxlength="128" placeholder="Bio">{{Auth::user()->descricao}}</textarea>
                        <label for="floatingBio">Bio</label>
                      </div>
                    </div>
                    <div class="password">
                      <span class="password-title"><i class="icon-lock"></i>{{ __('Senha') }}</span>
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="{{ __('Senha atual') }}">
                        <label for="floatingPassword">{{ __('Senha atual') }}</label>
                      </div>
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingNewPassword" name="floatingNewPassword" placeholder="{{ __('Nova senha') }}">
                        <label for="floatingNewPassword">{{ __('Nova senha') }}</label>
                      </div>
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingRepeatPassword" name="floatingRepeatPassword" placeholder="Repita a nova senha">
                        <label for="floatingRepeatPassword">Repita a nova senha</label>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary close" id="btn-close" data-dismiss="modal" onclick="closeModal()">{{ __('Fechar') }}</button>
                    <button type="submit" class="btn btn-primary save" id="btn-submit">{{ __('Salvar') }}</button>
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
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
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
                  <h5 class="modal-title" id="modalAboutTitle">{{ __('Sobre') }} Visita Sampa</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <!-- <span aria-hidden="true">&times;</span> -->
                  </button>
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
  </header>
  <div class="w-100 d-flex justify-content-center">
    <nav class="nav-bottom position-fixed">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('feed', app()->getLocale()) }}">
            <i class="icon-image" data-bs-toggle="tooltip" data-bs-placement="top" title="Feed"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user', app()->getLocale()) }}">
            <i class="icon-user" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Perfil') }}"></i>
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
          <a class="nav-link" href="{{ route('quiz', app()->getLocale()) }}">
            <i class="icon-edit-3" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Teste de Personalidade') }}"></i>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <main class="profile-page">
    <section class="profile d-flex justify-content-center m-5">
      @Auth
      <div class="profile-container d-flex">
        <div class="rounded-circle position-relative">
          <img src="{{ $user->foto_perfil == '' ? '/img/users/profileDefault.png' : $user->foto_perfil}}" alt="" class="profile-img rounded-circle" />
        </div>
        <div class="bio">
          <h3>{{$user->nome}}</h3>
          <h4>&#64;{{$user->nome_usuario}}</h4>
          <p>{{$user->descricao}}</p>
          <div class="bio-footer d-grid">
            <span>{{ __('Tipo de perfil') }}</span>
            @csrf @if(!$profile->isEmpty()) @foreach ($profile as $prof)
            <strong><span>{{$prof->nome_classificacao}}</span></strong>
            @endforeach @else
            <strong><span>-</span></strong>
            @endif
            <span>
              @if($user->nome_usuario == Auth::user()->nome_usuario)
              {{ __('Minhas publicações') }}
              @else
              {{ __('Publicações')  }}
              @endif
            </span>
            @if($publications)
            <strong><span>{{$publications->count()}}</span></strong>
            @else
            <strong><span>-</span></strong>
            @endif
          </div>
        </div>
      </div>
      @endAuth
    </section>
    <section class="posts d-grid justify-content-center" id="post-container">
      @include('userPublication')
    </section>
    <div class="ajax-load text-center">
      <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Carregando...</span>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="liveToastBtn">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        @if(session('msgUpdateProfileSuccess'))
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          Sucesso
        </strong>
        @elseif(session('msgPasswordComparisonFailed') || session('msgUnfilledPasswordFields') || session('msgInvalidCurrentPassword') || session('msgUpdateProfileFail'))
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          Falha
        </strong>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        @if(session('msgUpdateProfileSuccess'))
        {{ session('msgUpdateProfileSuccess') }}

        @elseif(session('msgPasswordComparisonFailed'))
        {{ session('msgPasswordComparisonFailed') }}

        @elseif(session('msgUnfilledPasswordFields'))
        {{ session('msgUnfilledPasswordFields') }}

        @elseif(session('msgInvalidCurrentPassword'))
        {{ session('msgInvalidCurrentPassword') }}

        @elseif(session('msgUpdateProfileFail'))
        {{ session('msgUpdateProfileFail') }}

        @endif
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg imagecrop" id="model" tabindex="-1" role="dialog" aria-labelledby="modalCropProfilePic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cortar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-md-11">
                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" class="d-block mw-100">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelCrop">Cancelar</button>
          <button type="button" class="btn btn-primary crop" id="crop">Cortar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/user.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

  <script>
    @if(session('msgUpdateProfileSuccess') || session('msgPasswordComparisonFailed') || session('msgUnfilledPasswordFields') || session('msgInvalidCurrentPassword') || session('msgUpdateProfileFail'))
    $(document).ready(function() {
      $("#liveToastBtn").click();
    });
    @endif

    $(document).ready(function() {
      $('#floatingUsername').on('focusout', function() {
        var value = $(this).val();
        $('#btn-submit').addClass("disabled");
        
        $.ajax({
            url: "{{ route('username.availability', app()->getLocale()) }}",
            type: 'GET',
            data: {
              'floatingUsername': value
            },
            beforeSend: () => {
              let msg = document.getElementById("msgUsername");
	            if (msg) 
                usernameContent.removeChild(msg);;
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
                usernameContent.removeChild(msg);
            } else {
              msgAlert(usernameContent,'Nome já utilizado','msgUsername');
              usernameFlag = false;
            }
          })
      });
    });
  </script>
</body>

</html>