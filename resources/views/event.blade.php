<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Eventos') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/event.css" rel="stylesheet" />
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
      <h1 class="title">{{ __('Eventos') }}</h1>
      <div class="grid-container" id="event-container">
        @include('eventDivulgation')
      </div>
      <div class="ajax-load text-center">
        <div class="spinner-border text-danger" role="status">
          <span class="visually-hidden">{{ __('Carregando') }}...</span>
        </div>
      </div>
    </div>
  </main>

  <!-- <script src="/assets/js/jquery.slim.min.js"></script> -->
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    function loadMoreData(page) {
      $.ajax({
          url: '?page=' + page,
          type: 'get',
          beforeSend: function() {
            $('.ajax-load').show();
          }
        })
        .done(function(eventDivulgation) {
          if (eventDivulgation.html == "") {
            $('.ajax-load').html('Nenhum outro evento encontrado');
            return;
          }
          $('.ajax-load').hide();
          $('#event-container').append(eventDivulgation.html);
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