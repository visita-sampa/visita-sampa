<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Ponto Turístico') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/touristSpot.css" rel="stylesheet">
    <link href="/assets/icon/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
            <div class="container">
                <a href="home">
                    <img class="logo" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">{{ __('Trocar idioma') }}</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Request::is('pt/*'))
                                    <i class="icon-brazil me-2"></i>
                                    PT-BR
                                    @else
                                    <i class="icon-usa me-2"></i>
                                    EN-US
                                    @endif
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route(Route::currentRouteName(), 'pt') }}">
                                            <i class="icon-brazil me-2"></i>
                                            PT-BR
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route(Route::currentRouteName(), 'en') }}">
                                            <i class="icon-usa me-2"></i>
                                            EN-US
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
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
                    <img src="{{ $point->imagem }}" alt="">
                    <div class="tourist-spot-info">
                        <h2>{{ $point->nome_ponto_turistico }}</h2>
                        <p class="address">{{ $point->logradouro }}, {{ $point->numero }} - {{ $point->nome_bairro }}, {{ $point->nome_cidade }} - {{ $point->nome_estado }}, {{ $point->cep }}{{ $point->complemento != '' ?  '. '.$point->complemento : ''}}</p>
                        <p class="description">{{ $point->informacoes }}</p>
                    </div>
                </div>
            </section>
            <section class="mt-5">
                <div class="d-flex justify-content-between">
                    <h1 class="title">{{ __('Veja quem já visitou') }}</h1>
                    @auth
                    <button class="btn-new-post" type="button" data-bs-toggle="modal" data-bs-target="#new-post-modal">
                        <i class="icon-plus"></i>
                    </button>

                    <div class="modal fade p-0" id="new-post-modal" tabindex="-1" aria-labelledby="new-post-modal" aria-hidden="true">
                        <form action="{{ route('publication.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="position-relative img-publication-area d-flex justify-content-center align-items-center">
                                            <img src="" alt="" id="img-preview" class="post-img position-absolute w-100">
                                            <label for="newPost" class="position-absolute w-100 h-100 top-0 p-3 text-center d-flex justify-content-center align-items-center select-img-fixed">
                                                <i class="icon-image position-absolute"></i>
                                                {{ __('Selecionar arquivo') }}
                                            </label>
                                            <label for="newPost" class="position-absolute w-100 h-100 top-0 p-3 text-center d-flex justify-content-center align-items-center select-img">
                                                <i class="icon-image text-light position-absolute"></i>
                                                {{ __('Selecionar arquivo') }}
                                            </label>
                                            <input type="file" name="newPost" id="newPost" class="d-none">
                                            <input type="hidden" name="fileAux" id="fileAux" class="">
                                        </div>
                                        <!-- <img src="https://veja.abril.com.br/wp-content/uploads/2016/05/alx_sao-paulo-cultura-museu-masp-avenida-paulista-20140222-001_original2.jpeg" class="img-publication"> -->
                                        <!-- Informações Usuário -->
                                        <div>
                                            <div class="modal-header p-3">
                                                <div class="user">
                                                    <div class="user-image">
                                                        <img src="{{ auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : auth::user()->foto_perfil}}">
                                                    </div>
                                                    <div class="user-information">
                                                        <p class="user-name">
                                                            {{auth::user()->nome}}
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
                                                <input type="hidden" name="touristSpotId" id="touristSpotId" value="{{ $point->id_ponto_turistico }}">
                                                <textarea name="postDescription" id="postDescription" class="m-4 p-2" placeholder="{{ __('Escreva sua experiência com o local') }}" cols="35" rows="5"></textarea>
                                            </div>
                                            <input type="submit" value="Publicar" class="mx-4 float-end btn-submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endauth
                </div>
                <div class="my-5 posts d-grid justify-content-center">
                    @foreach($publications as $post)
                    <img src="{{$post->midia}}" alt="">
                    @endforeach
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('ijaboCropTool/ijaboCropTool.min.js') }}"></script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <script>
        // var inputFile = document.getElementById('img-preview');

        // inputFile.addEventListener('loadeddata', function() {
        //     alert('chegou');
        // });
    </script>

    <script>
        $('#newPost').ijaboCropTool({
            preview: '.post-img',
            setRatio: 7 / 5,
            processUrl: '{{ route("publication.crop", app()->getLocale()) }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            buttonsText: ['Salvar', 'Cancelar'],
            onSuccess: function(message, element, status) {
                var image = document.getElementById('img-preview').src;
                var inputFile = document.getElementById('fileAux');
                inputFile.value = image;
                console.log(inputFile);
                alert(message);
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });
    </script>

</body>

</html>