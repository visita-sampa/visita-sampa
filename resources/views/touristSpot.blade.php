<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Ponto Turístico') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/roadMap.css" rel="stylesheet" />
  <link href="/assets/css/touristSpot.css" rel="stylesheet" />
  <link href="/assets/icon/style.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}" /> -->
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
            <p>
              <strong>Valor:</strong>
              {{ $point->valor }}
            </p>
            <p>
              <strong>Horário de Funcionamento:</strong>
              {{ $point->horario_funcionamento }}.
            </p>
            <div class="btn-information">
              <a href="{{ $point->link }}" target="_blank" class="btn-see-more">{{ __('Ver Mais') }}</a>
            </div>
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
                      <div src="" alt="" id="img-preview" class="post-img position-absolute w-100 h-100"></div>
                      <label for="newPost" class="position-absolute w-100 h-100 top-0 p-3 text-center d-flex justify-content-center align-items-center select-img-fixed">
                        <i class="icon-image position-absolute"></i>
                        {{ __('Selecionar arquivo') }}
                      </label>
                      <label for="newPost" class="position-absolute w-100 h-100 top-0 p-3 text-center d-flex justify-content-center align-items-center select-img">
                        <i class="icon-image text-light position-absolute"></i>
                        {{ __('Selecionar arquivo') }}
                      </label>
                      <input type="file" name="newPost" id="newPost" class="d-none image-upload" />
                      <input type="hidden" name="base64image" id="base64image" class="" />
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
  <script src="/assets/js/touristSpot.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
  <!-- <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script> -->

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