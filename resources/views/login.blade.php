<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Entrar') }}</title>
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
    @include('nav')
  </header>

  <main class="d-flex">
    <div class="web-background w-100 vh-100">
      <div class="background-blur w-100 h-100">
        <div class="container login p-4 d-flex flex-row w-100 align-items-center">
          <img src="/assets/img/logoVisitaSampa.png" alt="" class="img-logo" />

          <div id="logon" class="signup">
            <h2 class="title-login">{{ __('ENTRAR') }}</h2>
            <form method="POST" action="{{ route('validate.login', app()->getLocale()) }}" class="form-signup d-flex flex-column align-items-center">
              @csrf
              <input type="text" name="login" id="login" placeholder="{{ __('E-mail ou Nome de usuário') }}" autocomplete="off" class="input-signup" required />
              <input type="password" name="passwordLogin" id="passwordLogin" placeholder="{{ __('Senha') }}" autocomplete="off" class="input-signup" required />
              <input type="checkbox" name="showPass" id="showPassLogin" class="d-none" />
              <label for="showPassLogin" id="eyeLogin" class="showPass login icon-eye-off"><span class="msg-pass">{{ __('Mostrar senha') }}</span></label>
              <p class="link-forgot-password"><a href="{{ route('recover.password', app()->getLocale()) }}" class="text-decoration-underline text-danger">{{ __('Esqueci minha senha') }}</a></p>
              <button type="submit" class="btn-signup">{{ __('Entrar') }}</button>
            </form>
            <p class="link-signup">{{ __('Não tem cadastro?') }}&nbsp;<a href="{{ route('signup', app()->getLocale()) }}" class="text-decoration-underline">{{ __('Cadastre-se') }}</a></p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="liveToastBtn">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        @if(session('msgUpdatePasswordSuccess') || session('msgSignupCompleted'))
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          Sucesso
        </strong>
        @elseif(session('msgEmailNotConfirmed') || session('msgUserNotFound') || session('msgInvalidPassword'))
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          {{ __('Falha') }}
        </strong>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        @if(session('msgUpdatePasswordSuccess'))
        {{ __(session('msgUpdatePasswordSuccess')) }}

        @elseif(session('msgSignupCompleted'))
        {{ __(session('msgSignupCompleted')) }}

        @elseif(session('msgEmailNotConfirmed'))
        {{ __(session('msgEmailNotConfirmed')) }}

        @elseif(session('msgUserNotFound'))
        {{ __(session('msgUserNotFound')) }}

        @elseif(session('msgInvalidPassword'))
        {{ __(session('msgInvalidPassword')) }}

        @endif
      </div>
    </div>
  </div>

  <!-- Footer -->
  @include('footer')


  <script src="/assets/js/jquery.slim.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="/assets/js/login.js"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    var tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    @if(session('msgUpdatePasswordSuccess') || session('msgEmailNotConfirmed') || session('msgSignupCompleted') || session('msgUserNotFound') || session('msgInvalidPassword'))
    $(document).ready(function() {
      $("#liveToastBtn").click();
    });
    @endif
    var toastTrigger = document.getElementById('liveToastBtn')
    var toastLiveExample = document.getElementById('liveToast')
    if (toastTrigger) {
      toastTrigger.addEventListener('click', function() {
        var toast = new bootstrap.Toast(toastLiveExample)

        toast.show()
      })
    }
  </script>
</body>

</html>