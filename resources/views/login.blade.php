<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('Cadastro') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="/assets/css/style.css" rel="stylesheet">
  <link href="/assets/css/login.css" rel="stylesheet">
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

  <main class="d-flex">
    <div class="web-background w-100 vh-100">
      <div class="background-blur w-100 h-100">
        <div class="container login p-4 d-flex flex-row w-100 align-items-center">
          <h2><img src="/assets/img/logoVisitaSampa.png" alt="" class="img-logo"></h2>

          <div id="signup" class="signup text-center h-100">
            <h2 class="title-login">{{ __('CADASTRE-SE') }}</h2>
            <form method="POST" action="{{ route('user.store', app()->getLocale()) }}" class="form-signup d-flex flex-column h-100 justify-content-around">
              @csrf
              <input type="text" name="nameSignup" id="nameSignup" placeholder="{{ __('Nome') }}" autocomplete="off" class="input-signup" required>
              <input type="text" name="usernameSignup" id="usernameSignup" placeholder="{{ __('Nome de usuário') }}" autocomplete="off" class="input-signup" required>
              <input type="email" name="emailSignup" id="emailSignup" placeholder="E-mail" autocomplete="off" class="input-signup" required>
              <input type="password" name="passwordSignup" id="passwordSignup" placeholder="{{ __('Senha') }}" autocomplete="off" class="input-signup" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#_])[0-9a-zA-Z$*&@#_]{6,12}$" title="A senha deve conter entre 6 e 12 caracteres, ter pelo menos uma letra maiúscula e uma letra minúscula, um número e um símbolo (#, @, _, $, &, *)" required>
              <input type="checkbox" name="showPass" id="showPass" class="d-none">
              <label for="showPass" id="eye" class="showPass icon-eye-off"><span class="msg-pass">{{ __('Mostrar senha') }}</span></label>
              <button type="submit" class="btn-signup">{{ __('Cadastrar') }}</button>
            </form>
            <p>{{ __('Já tem cadastro?') }} <a href="#" class="text-decoration-underline" onclick="login()">{{ __('Entre em sua conta') }}</a></p>
          </div>

          <div id="login" class="signup d-none">
            <h2 class="title-login">{{ __('ENTRAR') }}</h2>
            <form method="POST" action="{{ route('validate.login', app()->getLocale()) }}" class="form-signup d-flex flex-column align-items-center">
              @csrf
              <input type="text" name="login" id="login" placeholder="{{ __('E-mail ou Nome de usuário') }}" autocomplete="off" class="input-signup" required>
              <input type="password" name="passwordLogin" id="passwordLogin" placeholder="{{ __('Senha') }}" autocomplete="off" class="input-signup" required>
              <input type="checkbox" name="showPass" id="showPassLogin" class="d-none">
              <label for="showPassLogin" id="eyeLogin" class="showPass login icon-eye-off"><span class="msg-pass">{{ __('Mostrar senha') }}</span></label>
              <button type="submit" class="btn-signup">{{ __('Entrar') }}</button>
            </form>
            <p class="link-signup">{{ __('Não tem cadastro?') }}&nbsp;<a href="#" class="text-decoration-underline" onclick="login(1)">{{ __('Cadastre-se') }}</a></p>
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
          <h6 class="text-uppercase fw-bold">
            <img src="/assets/img/logoVisitaSampa.png" class="logo me-3"></img>
          </h6>
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