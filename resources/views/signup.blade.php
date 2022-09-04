<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Cadastro') }}</title>
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
          <img class="logo" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
        </a>

        <div class="sec-center">
          <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
          <label class="for-dropdown" for="dropdown">
            <i class="icon-menu"></i>
          </label>
          <div class="section-dropdown">
            <input class="dropdown-profile" type="checkbox" id="dropdown-profile" name="dropdown-profile" />
            <label class="for-dropdown-profile user" for="dropdown-profile">
              <a href="{{ route('signup', app()->getLocale()) }}">
                <i class="icon-user"></i>
                <span>{{ __('Criar conta')}}</span>
              </a>
            </label>

            <input class="dropdown-translate" type="checkbox" id="dropdown-translate" name="dropdown-translate" />
            <label class="for-dropdown-translate user-account" for="dropdown-translate" id="for-dropdown-translate">
              <div class="option-translate">
                <i class="icon-translate"></i>
                <span class="user-without-account">{{ __('Idioma') }}<i class="icon-arrow_drop_down"></i></span>
              </div>
              <ul class="translate" id="translate">
                <li class="portuguese">
                  <a href="{{ route(Route::currentRouteName(), 'pt') }}">
                    <i class="icon-brazil"></i>
                    PT-BR
                  </a>
                </li>
                <li class="english user">
                  <a href="{{ route(Route::currentRouteName(), 'en') }}">
                    <i class="icon-usa"></i>
                    EN-US
                  </a>
                </li>
              </ul>
            </label>
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
            <h2 class="title-login">{{ __('CADASTRE-SE') }}</h2>
            <form  id="form" method="POST" action="{{ route('user.store', app()->getLocale()) }}" class="form-signup d-flex flex-column h-100 justify-content-around">
              @csrf
              <div id="nameContent" class="inputContent">
                <input type="text" name="nameSignup" id="nameSignup" placeholder="{{ __('Nome') }}" autocomplete="off" class="input-signup" required />
              </div>
              <div id="usernameContent" class="inputContent">
                <input type="text" name="usernameSignup" id="usernameSignup" placeholder="{{ __('Nome de usuário') }}" autocomplete="off" class="input-signup" required />
              </div>
              <div id="emailContent" class="inputContent">
                <input type="email" name="emailSignup" id="emailSignup" placeholder="E-mail" autocomplete="off" class="input-signup" required />
              </div>
              <div id="passwordContent" class="inputContent">
                <input type="password" name="passwordSignup" id="passwordSignup" placeholder="{{ __('Senha') }}" autocomplete="off" class="input-signup" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#_])[0-9a-zA-Z$*&@#_]{6,12}$" required data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="A senha deve conter: <br/>Entre 6 e 12 caracteres;<br/>Ter pelo menos uma letra maiúscula e uma letra minúscula;</br>Um número;</br>Um símbolo (#, @, _, $, &, *)" />
              </div>
              <div id="passwordConfirmationContent" class="inputContent">
                <input type="password" name="passwordConfirmation" id="passwordConfirmation" placeholder="{{ __('Confirmação de senha') }}" autocomplete="off" class="input-confirmation" required/>
              </div>

              <button type="submit" class="btn-signup">{{ __('Cadastrar') }}</button>
            </form>
            <p>{{ __('Já tem cadastro?') }} <a href="{{ route('login', app()->getLocale()) }}" class="text-decoration-underline">{{ __('Entre em sua conta') }}</a></p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="liveToastBtn">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        @if(session('msgSendEmailConfirmationSuccess') || session('msgSignupCompleted'))
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          Sucesso
        </strong>
        @elseif(session('msgSendEmailConfirmationFail') || session('msgSignupNotCompleted') || session('msgInvalidLink'))
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          Falha
        </strong>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        @if(session('msgSendEmailConfirmationSuccess'))
        {{ session('msgSendEmailConfirmationSuccess') }}

        @elseif(session('msgSignupCompleted'))
        {{ session('msgSignupCompleted') }}

        @elseif(session('msgSendEmailConfirmationFail'))
        {{ session('msgSendEmailConfirmationFail') }}

        @elseif(session('msgSignupNotCompleted'))
        {{ session('msgSignupNotCompleted') }}

        @elseif(session('msgInvalidLink'))
        {{ session('msgInvalidLink') }}

        @endif
      </div>
    </div>
  </div>

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
  <script src="/assets/js/main.js"></script>
  <script>
    @if(session('msgSendEmailConfirmationSuccess') || session('msgSignupCompleted') || session('msgSendEmailConfirmationFail') || session('msgSignupNotCompleted') || session('msgInvalidLink'))
      $(document).ready(function () {
        $("#liveToastBtn").click();
      });
    @endif

    var toastTrigger = document.getElementById('liveToastBtn')
    var toastLiveExample = document.getElementById('liveToast')
    if (toastTrigger) {
      toastTrigger.addEventListener('click', function () {
        var toast = new bootstrap.Toast(toastLiveExample)

        toast.show()
      })
    }
  </script>
</body>

</html>