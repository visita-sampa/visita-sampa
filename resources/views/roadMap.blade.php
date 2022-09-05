<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Roteiro Turístico') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/roadMap.css" rel="stylesheet" />
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

  <main class="">
    <div class="roadmap-description">
      <div class="mx-5 py-3 px-5">
        @foreach($roadMapTitle as $titles)
        <h1 class="title">{{ __($titles->nome_roteiro) }}</h1>
        @endforeach
        @foreach($roadMapType as $type)
        <p>{{ __($type->descricao) }}</p>
        @endforeach
      </div>
    </div>
    <div class="container">
      <h3>{{ __('Lugares para você') }}</h3>
      {{csrf_field()}}
      <div class="grid-container">
        @foreach ($pontos as $ponto)
        <div class="grid-item">
          <div class="local-image">
            <img src="{{$ponto->imagem}}" class="card-img-top" alt="{{$ponto->nome_ponto_turistico}}" />
          </div>
          <div class="card-body">
            <h5 class="card-title">{{$ponto->nome_ponto_turistico}}</h5>
            <p class="card-text">
              {{ __($ponto->informacoes) }}
            </p>
          </div>
          <div class="btn-information">
            <a href="{{ route('touristSpot.show', ['language'=>app()->getLocale(), 'id'=>$ponto->id_ponto_turistico]) }}" class="btn-see-more">{{ __('Ver Mais') }}</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </main>

  @include('cropProfilePic')
  @include('usernameAvailabilityScript')

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>
  <script>
    const langOptions = document.getElementById('for-dropdown-translate');
    const ulLangOptions = document.getElementById('translate');
    let open = false;

    langOptions.addEventListener('click', () => {
      if (open) {
        ulLangOptions.classList.remove('open');
        langOptions.classList.remove('active');
        open = false;
      } else {
        ulLangOptions.classList.add('open');
        langOptions.classList.add('active');
        open = true;
      }
    })
  </script>
</body>

</html>