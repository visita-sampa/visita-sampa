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
    @include('nav')
  </header>

  <div class="w-100 d-flex justify-content-center">
    @include('navbar')
  </div>

  <main class="margin-fixed">
    <div class="container">
      <div class="d-flex flex-wrap position-relative justify-content-center">
        <form class="search" method="GET" action="{{ route('explore', app()->getLocale()) }}" name="formSearch">
          <!-- @csrf -->
          <div class="search-icon">
            <div class="icon">
              <i class="icon-search"></i>
            </div>
            <input type="hidden" name="typeSearch" id="typeSearch" value="1">
            <input class="form-control dropdown-toggle" type="text" id="search" name="search" placeholder="@if($search) {{ __('Buscando por') }} &#34;{{ $search }}&#34; {{ __('em') }} {{ $typeSearch }} @else {{ __('Pesquisar') }} @endif" aria-label="Search" autocomplete="off" data-bs-toggle="dropdown" aria-expanded="false" />
            <div class="card search p-3 h-auto position-absolute search-result-container dropdown-menu" id="search-result-container" aria-labelledby="search">
              <ul class="nav nav-tabs nav-fill">
                <li class="nav-item" onclick="event.stopPropagation();">
                  <button class="nav-link active" aria-current="page" id="tourist-spot-search-tab" data-bs-toggle="tab" data-bs-target="#tourist-spot-search" type="button" role="tab" aria-controls="tourist-spot-search" aria-selected="true">{{ __('Pontos turísticos') }}</button>
                </li>
                <li class="nav-item" onclick="event.stopPropagation();">
                  <button class="nav-link" aria-current="page" id="profile-search-tab" data-bs-toggle="tab" data-bs-target="#profile-search" type="button" role="tab" aria-controls="profile-search" aria-selected="false">{{ __('Perfis') }}</button>
                </li>
              </ul>

              <div class="tab-content" id="search-content">
                <div class="tab-pane fade show active" id="tourist-spot-search" role="tabpanel" aria-labelledby="tourist-spot-search-tab">
                  <ul class="list-group list-group-flush" id="tourist-spot-search-container">
                    @include('searchTouristSpot')
                  </ul>
                  <div class="ajax-load-tourist-spot-search text-center mt-3">
                    <div class="spinner-border text-danger" role="status">
                      <span class="visually-hidden">{{ __('Carregando') }}...</span>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade show" id="profile-search" role="tabpanel" aria-labelledby="profile-search-tab">
                  <ul class="list-group list-group-flush" id="profile-search-container">
                    @include('searchProfile')
                  </ul>
                  <div class="ajax-load-profile-search text-center mt-3">
                    <div class="spinner-border text-danger" role="status">
                      <span class="visually-hidden">{{ __('Carregando') }}...</span>
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
          <span class="visually-hidden">{{ __('Carregando') }}...</span>
        </div>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="toastBtnReportSuccess">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastReportSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          {{ __('Sucesso') }}
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ __('A publicação foi reportada') }}
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-primary d-none" id="toastBtnReportFail">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastReportFail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          {{ __('Falha') }}
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ __('Não foi possível reportar a publicação') }}
      </div>
    </div>
  </div>

  @include('cropProfilePic')

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/explore.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    $(function() {
      $('form[name="formReport"]').submit(function() {
        event.preventDefault();

        $.ajax({
          url: "{{ route('publication.report', app()->getLocale()) }}",
          type: "post",
          data: $(this).serialize(),
          dataType: 'json',
          success: function(response) {
            if (response) {
              $('.close-all').click();

              $(document).ready(function() {
                $("#toastBtnReportSuccess").click();
              });
            } else {
              $('.close-all').click();

              $(document).ready(function() {
                $("#toastBtnReportFail").click();
              });
            }
          }
        });
      });
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
            $('.ajax-load').html("{{ __(('Nenhuma outra publicação encontrada')) }}");
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

  <script src="/assets/js/main.js"></script>


</body>

</html>