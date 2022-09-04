<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Explorar') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/explore.css" rel="stylesheet" />
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
                      <input type="text" class="form-control" id="floatingName" placeholder="{{ __('Nome') }}" value="{{Auth::user()->nome}}">
                      <label for="floating-name">{{ __('Nome') }}</label>
                    </div>
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingUsername" placeholder="{{ __('Nome de usuário') }}" value="{{Auth::user()->nome_usuario}}">
                      <label for="floating-user-name">{{ __('Nome de usuário') }}</label>
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
                      <label for="floatingRepeatPassword">Repita a nova senha</label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary close" id="btn-close" data-dismiss="modal" onclick="closeModal()">{{ __('Fechar') }}</button>
                  <button type="button" class="btn btn-primary save">{{ __('Salvar') }}</button>
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

  <main class="">
    <div class="container">
      <div class="d-flex flex-wrap position-relative justify-content-center">
        <form class="search" method="GET" action="{{ route('explore', app()->getLocale()) }}" name="formSearch">
          <!-- @csrf -->
          <div class="search-icon">
            <div class="icon">
              <i class="icon-search"></i>
            </div>
            <!-- <div class="">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="typeSearch" id="touristSpotRadio" value="1" checked>
                <label class="form-check-label" for="touristSpotRadio">
                  Busca por ponto turístico
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="typeSearch" id="profileRadio" value="2">
                <label class="form-check-label" for="profileRadio">
                  Busca por perfil
                </label>
              </div>
            </div> -->
            <input type="hidden" name="typeSearch" id="typeSearch" value="1">
            <input class="form-control dropdown-toggle" type="text" id="search" name="search" placeholder="@if($search) {{ __('Buscando por') }} &#34;{{ $search }}&#34; {{ __('em') }} {{ $typeSearch }} @else {{ __('Pesquisar') }} @endif" aria-label="Search" autocomplete="off" data-bs-toggle="dropdown" aria-expanded="false" />
            <div class="card search p-3 h-auto position-absolute search-result-container dropdown-menu" id="search-result-container" aria-labelledby="search">
              <ul class="nav nav-tabs nav-fill">
                <li class="nav-item" onclick="event.stopPropagation();">
                  <button class="nav-link active" aria-current="page" id="tourist-spot-search-tab" data-bs-toggle="tab" data-bs-target="#tourist-spot-search" type="button" role="tab" aria-controls="tourist-spot-search" aria-selected="true">Pontos turísticos</button>
                </li>
                <li class="nav-item" onclick="event.stopPropagation();">
                  <button class="nav-link" aria-current="page" id="profile-search-tab" data-bs-toggle="tab" data-bs-target="#profile-search" type="button" role="tab" aria-controls="profile-search" aria-selected="false">Perfis</button>
                </li>
              </ul>

              <div class="tab-content" id="search-content">
                <div class="tab-pane fade show active" id="tourist-spot-search" role="tabpanel" aria-labelledby="tourist-spot-search-tab">
                  <ul class="list-group list-group-flush" id="tourist-spot-search-container">
                    @include('searchTouristSpot')
                  </ul>
                  <div class="ajax-load-tourist-spot-search text-center mt-3">
                    <div class="spinner-border text-danger" role="status">
                      <span class="visually-hidden">Carregando...</span>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade show" id="profile-search" role="tabpanel" aria-labelledby="profile-search-tab">
                  <ul class="list-group list-group-flush" id="profile-search-container">
                    @include('searchProfile')
                  </ul>
                  <div class="ajax-load-profile-search text-center mt-3">
                    <div class="spinner-border text-danger" role="status">
                      <span class="visually-hidden">Carregando...</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <h1 class="title">{{ __('Explorar') }}</h1>
      <div class="grid-container" id="post-container">
        @include('explorePublication')
      </div>
      <div class="ajax-load text-center">
        <div class="spinner-border text-danger" role="status">
          <span class="visually-hidden">Carregando...</span>
        </div>
      </div>
    </div>
  </main>

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/explore.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    function loadMoreTouristSpotSearchData(page, touristSpotSearchPage, profileSearchPage) {
      $.ajax({
          url: '?page=' + page + '&touristSpotSearchPage=' + touristSpotSearchPage + '&profileSearchPage=' + profileSearchPage,
          type: "get",
          beforeSend: function() {
            $(".ajax-load-tourist-spot-search").show();
          },
        })
        .done(function(searchTouristSpot) {
          if (searchTouristSpot.htmlSearchTouristSpot == "") {
            $(".ajax-load-tourist-spot-search").html(
              "Nenhum outro ponto turístico encontrado"
            );
            return;
          }
          $(".ajax-load-tourist-spot-search").hide();
          $("#tourist-spot-search-container").append(searchTouristSpot.htmlSearchTouristSpot);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          alert("Servidor não está respondendo à busca por ponto turístico...");
        });
    }

    function loadMoreProfileSearchData(page, touristSpotSearchPage, profileSearchPage) {
      $.ajax({
          url: '?page=' + page + '&touristSpotSearchPage=' + touristSpotSearchPage + '&profileSearchPage=' + profileSearchPage,
          type: 'get',
          beforeSend: function() {
            $('.ajax-load-profile-search').show();
          }
        })
        .done(function(searchProfile) {
          if (searchProfile.html == "") {
            $('.ajax-load-profile-search').html('Nenhum outro perfil encontrado');
            return;
          }
          $('.ajax-load-profile-search').hide();
          $('#profile-search-container').append(searchProfile.htmlSearchProfile);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          alert("Servidor não está respondendo à busca por perfil...");
        });
    }

    function loadMoreData(page, touristSpotSearchPage, profileSearchPage) {
      $.ajax({
          url: '?page=' + page + '&touristSpotSearchPage=' + touristSpotSearchPage + '&profileSearchPage=' + profileSearchPage,
          type: 'get',
          beforeSend: function() {
            $('.ajax-load').show();
          }
        })
        .done(function(explorePublication) {
          if (explorePublication.html == "") {
            $('.ajax-load').html('Nenhuma outra publicação encontrada');
            return;
          }
          $('.ajax-load').hide();
          $('#post-container').append(explorePublication.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          alert("Servidor não está respondendo...");
        });
    }

    var page = 1;
    var touristSpotSearchPage = 1;
    var profileSearchPage = 1;

    @if($search)
    $(document).ready(function() {
      $("#search").click();
    });
    @if($typeSearch == "pontos turísticos")
    $(document).ready(function() {
      $("#tourist-spot-search-tab").click();
    });
    $(".ajax-load-tourist-spot-search").hide();
    @elseif($typeSearch == "perfis")
    $(document).ready(function() {
      $("#profile-search-tab").click();
    });
    $(".ajax-load-profile-search").hide();
    @endif
    @else
    $('#search-result-container').scroll(function() {
      if ($('#search-result-container').scrollTop() + $('#search-result-container').height() >= $('#search-result-container').height()) {
        touristSpotSearchPage++;
        loadMoreTouristSpotSearchData(page, touristSpotSearchPage, profileSearchPage);
      }
    });

    $('#search-result-container').scroll(function() {
      if ($('#search-result-container').scrollTop() + $('#search-result-container').height() >= $('#search-result-container').height()) {
        profileSearchPage++;
        loadMoreProfileSearchData(page, touristSpotSearchPage, profileSearchPage);
      }
    });
    @endif

    $(window).scroll(function() {
      if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page, touristSpotSearchPage, profileSearchPage);
      }
    });
  </script>

</body>

</html>