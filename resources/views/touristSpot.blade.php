<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Ponto Turístico') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/touristSpot.css" rel="stylesheet" />
  <link href="/assets/icon/style.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}" />
</head>

<body>
  <header>
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
            <!-- <i class="icon-user"></i> -->
          </label>
          <div class="section-dropdown">
            <input class="dropdown-profile" type="checkbox" id="dropdown-profile" name="dropdown-profile" />
            <label class="for-dropdown-profile" for="dropdown-profile">
              <a href="{{ route('user', app()->getLocale()) }}">
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
                <div class="modal-header">
                  <h5 class="modal-title" id="modalConfigurationTitle">{{ __('Configurações') }}</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <!-- <span aria-hidden="true">&times;</span> -->
                  </button>
                </div>
                <div class="modal-body modal-body-user">
                  <img src="{{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}}" alt="" class="profile-img rounded-circle" />
                  <label for="profile-pic" class="change-picture">
                    {{ __('Alterar foto de perfil') }}
                  </label>
                  <input type="file" name="profile-pic" id="profile-pic" class="d-none" />
                  <div class="bio">
                    <span class="bio-title"><i class="icon-user"></i>{{ __('Editar Perfil') }}</span>
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floating-name" placeholder="{{ __('Nome') }}" value="{{Auth::user()->nome}}">
                      <label for="floating-name">{{ __('Nome') }}</label>
                    </div>
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floating-user-name" placeholder="{{ __('Nome de usuário') }}" value="{{Auth::user()->nome_usuario}}">
                      <label for="floating-user-name">{{ __('Nome de usuário') }}</label>
                    </div>
                    <div class="form-floating textarea">
                      <textarea class="form-control" id="floating-bio" maxlength="128" placeholder="Bio">{{Auth::user()->descricao}}</textarea>
                      <label for="floating-bio">Bio</label>
                    </div>
                  </div>
                  <div class="password">
                    <span class="password-title"><i class="icon-lock"></i>{{ __('Senha') }}</span>
                    <div class="form-floating">
                      <input type="password" class="form-control" id="floating-password" placeholder="{{ __('Senha atual') }}">
                      <label for="floating-password">{{ __('Senha atual') }}</label>
                    </div>
                    <div class="form-floating">
                      <input type="password" class="form-control" id="floating-new-password" placeholder="{{ __('Nova senha') }}">
                      <label for="floating-new-password">{{ __('Nova senha') }}</label>
                    </div>
                    <div class="form-floating">
                      <input type="password" class="form-control" id="floating-repeat-password" placeholder="Repita a nova senha">
                      <label for="floating-repeat-password">Repita a nova senha</label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" id="btn-close" data-dismiss="modal" onclick="closeModal()">{{ __('Fechar') }}</button>
                  <button type="button" class="btn btn-primary">{{ __('Salvar') }}</button>
                </div>
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

  <main class="tourist-spot-page">
    @foreach($touristSpot as $point)
    <div class="container">
      <section class="tourist-spot-session d-flex justify-content-center mt-5">
        <div class="tourist-spot-container d-grid justify-content-center">
          <img src="{{ $point->imagem }}" alt="" />
          <div class="tourist-spot-info">
            <h2>{{ $point->nome_ponto_turistico }}</h2>
            <p class="address">
              {{ $point->logradouro }}, {{ $point->numero }} - {{ $point->nome_bairro }}, {{ $point->nome_cidade }} - {{ $point->nome_estado }}, {{ $point->cep }}{{ $point->complemento != '' ? '. '.$point->complemento : ''}}
            </p>
            <p class="description">{{ $point->informacoes }}</p>
          </div>
        </div>
      </section>
      <section class="mt-5">
        <div class="d-flex justify-content-between">
          <h1 class="title">{{ __('Veja quem já visitou') }}</h1>
          @Auth
          <button class="btn-new-post" type="button" data-bs-toggle="modal" data-bs-target="#new-post-modal">
            <i class="icon-plus"></i>
          </button>

          <div class="modal fade p-0" id="new-post-modal" tabindex="-1" aria-labelledby="new-post-modal" aria-hidden="true">
            <form action="{{ route('publication.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-dialog modal-dialog-tourist" role="document">
                <div class="modal-content">
                  <div class="modal-body modal-body-tourist">
                    <div class="position-relative img-publication-area d-flex justify-content-center align-items-center">
                      <img src="" alt="" id="img-preview" class="post-img position-absolute w-100" />
                      <label for="newPost" class="position-absolute w-100 h-100 top-0 p-3 text-center d-flex justify-content-center align-items-center select-img-fixed">
                        <i class="icon-image position-absolute"></i>
                        {{ __('Selecionar arquivo') }}
                      </label>
                      <label for="newPost" class="position-absolute w-100 h-100 top-0 p-3 text-center d-flex justify-content-center align-items-center select-img">
                        <i class="icon-image text-light position-absolute"></i>
                        {{ __('Selecionar arquivo') }}
                      </label>
                      <input type="file" name="newPost" id="newPost" class="d-none" />
                      <input type="hidden" name="fileAux" id="fileAux" class="" />
                    </div>
                    <!-- <img src="https://veja.abril.com.br/wp-content/uploads/2016/05/alx_sao-paulo-cultura-museu-masp-avenida-paulista-20140222-001_original2.jpeg" class="img-publication"> -->
                    <!-- Informações Usuário -->
                    <div>
                      <div class="modal-header modal-header-tourist p-3">
                        <div class="user">
                          <div class="user-image">
                            <img src="{{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}}" />
                          </div>
                          <div class="user-information">
                            <p class="user-name">
                              {{Auth::user()->nome}}
                            </p>
                            <p class="user-localization">
                              {{ $point->nome_ponto_turistico }}
                            </p>
                          </div>
                        </div>
                        <!-- Denuncia -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <!-- Descrição Publicação -->
                      <div class="description-publication d-grid">
                        <input type="hidden" name="touristSpotId" id="touristSpotId" value="{{ $point->id_ponto_turistico }}" />
                        <textarea name="postDescription" id="postDescription" class="m-4 p-2" placeholder="{{ __('Escreva sua experiência com o local') }}" cols="35" rows="5"></textarea>
                      </div>
                      <input type="submit" value="Publicar" class="mx-4 float-end btn-submit" />
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          @endAuth
        </div>
        <div class="my-5 posts d-grid justify-content-center" id="post-container">
          @include('touristSpotPublication')
        </div>
        <div class="ajax-load text-center">
          <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Carregando...</span>
          </div>
        </div>
      </section>
    </div>
    @endforeach
    <!-- <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Imagem do Evento:</label>
                <input type="file" id="image" name="image" class="from-control-file">
            </div>
            <input type="submit" class="btn btn-primary" value="Salvar">
        </form>  -->
  </main>

  <script src="/assets/js/jquery.slim.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>

  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>

  <script>
    $("#newPost").ijaboCropTool({
      preview: ".post-img",
      setRatio: 7 / 5,
      processUrl: '{{ route("publication.crop", app()->getLocale()) }}',
      withCSRF: ["_token", "{{ csrf_token() }}"],
      buttonsText: ["Salvar", "Cancelar"],
      onSuccess: function(message, element, status) {
        var image = document.getElementById("img-preview").src;
        var inputFile = document.getElementById("fileAux");
        inputFile.value = image;
        // console.log(inputFile);
        alert(message);
      },
      onError: function(message, element, status) {
        alert(message);
      },
    });

    function loadMoreData(page) {
      $.ajax({
          url: '?page=' + page,
          type: 'get',
          beforeSend: function() {
            $('.ajax-load').show();
          }
        })
        .done(function(touristSpotPublication) {
          if (touristSpotPublication.html == "") {
            $('.ajax-load').html('Nenhuma outra publicação encontrada');
            return;
          }
          $('.ajax-load').hide();
          $('#post-container').append(touristSpotPublication.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          alert("Servidor não está respondendo...");
        });
    }

    var page = 1;
    $(window).scroll(function() {
      if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
      }
    });
  </script>
</body>

</html>