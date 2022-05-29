<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Meu Perfil') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/quiz.css" rel="stylesheet">
    <link href="/assets/icon/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
            <div class="container">
                <img class="logo" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa">
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
                    <a class="nav-link" href="#">
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
        <div class="web-background w-100 h-100"></div>
        <div class="container p-5">
            <div class="row mx-3">
                <div class="question">
                    <h2>{{ __('Pergunta') }}</h2>
                </div>
            </div>
            <div class="d-flex justify-content-center alternative-index">
                <div class="col-9 alternative-container mx-3">
                    <div class="card my-3">
                        <div class="card-body">
                            {{ __('Alternativa') }} 1.
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-body">
                            {{ __('Alternativa') }} 2.
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-body">
                            {{ __('Alternativa') }} 3.
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-body">
                            {{ __('Alternativa') }} 4.
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-body">
                            {{ __('Alternativa') }} 5.
                        </div>
                    </div>
                </div>
                <div class="col-3 question-index-container mx-3">
                    <div class="card my-3 text-center">
                        <div class="card-header border-bottom-0 bg-transparent">
                            {{ __('Perguntas') }}
                        </div>
                        <div class="card-body question-index">
                            <div questao=1 class="quiz questao1">
                                <button type="button" class="quiz-button quiz-button-active">
                                    <p>1</p>
                                </button>
                            </div>
                            <div questao=2 class="quiz questao2">
                                <button type="button" class="quiz-button">
                                    <p>2</p>
                                </button>
                            </div>
                            <div questao=3 class="quiz questao3">
                                <button type="button" class="quiz-button">
                                    <p>3</p>
                                </button>
                            </div>
                            <div questao=4 class="quiz questao4">
                                <button type="button" class="quiz-button">
                                    <p>4</p>
                                </button>
                            </div>
                            <div questao=5 class="quiz questao5">
                                <button type="button" class="quiz-button">
                                    <p>5</p>
                                </button>
                            </div>
                            <div questao=6 class="quiz questao6">
                                <button type="button" class="quiz-button">
                                    <p>6</p>
                                </button>
                            </div>
                            <div questao=7 class="quiz questao7">
                                <button type="button" class="quiz-button">
                                    <p>7</p>
                                </button>
                            </div>
                            <div questao=8 class="quiz questao8">
                                <button type="button" class="quiz-button">
                                    <p>8</p>
                                </button>
                            </div>
                            <div questao=9 class="quiz questao9">
                                <button type="button" class="quiz-button">
                                    <p>9</p>
                                </button>
                            </div>
                            <div questao=10 class="quiz questao10">
                                <button type="button" class="quiz-button">
                                    <p>10</p>
                                </button>
                            </div>
                            <div questao=11 class="quiz questao11">
                                <button type="button" class="quiz-button">
                                    <p>11</p>
                                </button>
                            </div>
                            <div questao=12 class="quiz questao12">
                                <button type="button" class="quiz-button">
                                    <p>12</p>
                                </button>
                            </div>
                            <div questao=13 class="quiz questao13">
                                <button type="button" class="quiz-button">
                                    <p>13</p>
                                </button>
                            </div>
                            <div questao=14 class="quiz questao14">
                                <button type="button" class="quiz-button">
                                    <p>14</p>
                                </button>
                            </div>
                            <div questao=15 class="quiz questao15">
                                <button type="button" class="quiz-button">
                                    <p>15</p>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer border-top-0 bg-transparent text-start">
                            <div class='button'>
                                <input id='finalizar' type='submit' value="{{ __('Finalizar') }}" name='questionario' class='botao' disabled>
                                <input type="hidden" id='resposta' name='resposta'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="/assets/js/jquery.slim.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>