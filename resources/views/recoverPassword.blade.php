<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('Recuperar senha') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link href="/assets/css/style.css" rel="stylesheet" />
    <link href="/assets/css/login.css" rel="stylesheet" />
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
            <img src="/assets/img/logoVisitaSampa.png" class="logo" alt="{{ __('Logo Visita Sampa') }}" />
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
                    PT-BR @else
                    <i class="icon-usa me-2"></i>
                    EN-US @endif
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

    <main class="d-flex">
      <div class="web-background w-100 vh-100">
        <div class="background-blur w-100 h-100">
          <div class="container login p-4 d-flex flex-row w-100 align-items-center">
            <img src="/assets/img/logoVisitaSampa.png" alt="" class="img-logo" />

            <div id="signup" class="signup text-center h-100">
              <h2 class="title-login">{{ __('Recuperar senha') }}</h2>
              <form method="POST" action="{{ route('password.request', app()->getLocale()) }}" class="form-signup d-flex flex-column h-100 justify-content-around">
                @csrf
                @if(session('msgError'))
                {{ session('msgError') }}
                @endif
                <p>Informe seu e-mail cadastrado</p>
                <input type="email" name="email" id="email" placeholder="E-mail" autocomplete="off" class="input-signup" required />
                <button type="submit" class="btn-signup">{{ __('Recuperar') }}</button>
              </form>
            </div>            
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted pt-4">
      <!-- Section: Links  -->
      <div class="container text-center text-md-start">
        <!-- Grid row -->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <img src="/assets/img/logoVisitaSampa.png" class="logo me-3" alt="{{ __('Logo Visita Sampa') }}" />
            <p class="m-0 text-dark">
              &copy; 2021 Copyright:
            </p>
            <p class="text-dark">
              {{ __('Todos os direitos reservados') }}
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-3 text-dark">
              Home
            </h6>
            <p>
              <a href="#!" class="text-decoration-none text-dark">{{ __('Perfil') }}</a>
            </p>
            <p>
              <a href="#!" class="text-decoration-none text-dark">{{ __('Teste') }}</a>
            </p>
            <p>
              <a href="#!" class="text-decoration-none text-dark">{{ __('Roteiro') }}</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-3 text-dark">
              Social
            </h6>
            <p>
              <a href="#!" class="text-decoration-none text-dark">Facebook</a>
            </p>
            <p>
              <a href="#!" class="text-decoration-none text-dark">Instagram</a>
            </p>
            <p>
              <a href="#!" class="text-decoration-none text-dark">Twitter</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-3 text-dark">
              {{ __('Sobre') }}
            </h6>
            <p>
              <a href="#!" class="text-decoration-none text-dark">{{ __('Política de Privacidade') }}</a>
            </p>
            <p>
              <a href="#!" class="text-decoration-none text-dark">{{ __('Nossa Equipe') }}</a>
            </p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </footer>

    <script src="/assets/js/jquery.slim.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/assets/js/login.js"></script>
  </body>
</html>
