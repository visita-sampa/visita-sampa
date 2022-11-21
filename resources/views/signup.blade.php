<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Cadastro') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    <div class="web-background w-100">
      <div class="background-blur w-100">
        <div class="container login p-4 d-flex flex-row w-100 align-items-center">
          <img src="/assets/img/logoVisitaSampa.png" alt="" class="img-logo" />

          <div id="signup" class="signup text-center">
            <h2 class="title-login">{{ __('CADASTRE-SE') }}</h2>
            <form id="form" method="POST" action="{{ route('user.store', app()->getLocale()) }}" class="form-signup d-flex flex-column">
              @csrf
              <div id="nameSignupContent" class="inputContent">
                <input type="text" name="nameSignup" id="nameSignup" placeholder="{{ __('Nome') }}" autocomplete="off" class="input-signup" required />
              </div>
              <div id="usernameContent" class="inputContent">
                <input type="text" name="usernameSignup" id="usernameSignup" placeholder="{{ __('Nome de usuário') }}" autocomplete="off" class="input-signup" required />
                <span id="loading" class="loading-username">{{ __('Verificando nome') }}</span>
              </div>
              <div id="emailContent" class="inputContent">
                <input type="email" name="emailSignup" id="emailSignup" placeholder="E-mail" autocomplete="off" class="input-signup" required />
                <span id="loading-email" class="loading-username">{{ __('Verificando email') }}</span>
              </div>
              <div id="passwordContent" class="inputContent">
                <input type="password" name="passwordSignup" id="passwordSignup" placeholder="{{ __('Senha') }}" autocomplete="off" class="input-signup" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#_])[0-9a-zA-Z$*&@#_]{6,12}$" required data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="A senha deve conter: <br/>Entre 6 e 12 caracteres;<br/>Ter pelo menos uma letra maiúscula e uma letra minúscula;</br>Um número;</br>Um símbolo (#, @, _, $, &, *)" />
              </div>
              <div id="passwordConfirmationContent" class="inputContent">
                <input type="password" name="passwordConfirmation" id="passwordConfirmation" placeholder="{{ __('Confirmação de senha') }}" autocomplete="off" class="input-confirmation" required />
              </div>

              <button type="submit" class="btn-signup">{{ __('Cadastrar') }}</button>
              <p class="py-3">{{ __('Já tem cadastro?') }} <a href="{{ route('login', app()->getLocale()) }}" class="text-decoration-underline">{{ __('Entre em sua conta') }}</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="liveToastBtn">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        @if(session('msgSendEmailConfirmationSuccess'))
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          {{ __("Sucesso") }}
        </strong>
        @elseif(session('msgSendEmailConfirmationFail') || session('msgSignupNotCompleted') || session('msgInvalidLink'))
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          {{ __("Falha") }}
        </strong>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        @if(session('msgSendEmailConfirmationSuccess'))
        {{ session('msgSendEmailConfirmationSuccess') }}

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
  @include('footer')

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
  <script src="/assets/js/signup.js"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    var tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    @if(session('msgSendEmailConfirmationSuccess') || session('msgSendEmailConfirmationFail') || session('msgSignupNotCompleted') || session('msgInvalidLink'))
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

    $(document).ready(function() {
      $('#usernameSignup').on('focusout', function() {
        var value = $(this).val();
        $('.btn-signup').addClass("disabled");

        let msg = document.getElementById("msgUsername");
        if (msg) usernameContent.removeChild(msg);
        if (value === "") {
          msgAlert(usernameContent, "{{ __('Campo obrigatório') }}", "msgUsername");
          usernameFlag = false;
          return;
        }
        $.ajax({
            url: "{{ route('username.availability', app()->getLocale()) }}",
            type: 'GET',
            data: {
              'floatingUsername': value
            },
            beforeSend: () => {
              let msg = document.getElementById("msgUsername");
              if (msg)
                usernameContent.removeChild(msg);;
              $("#loading").css('display', 'block');
              usernameFlag = false;
            },
            complete: () => {
              $("#loading").css('display', 'none');
            }
          })
          .done((response) => {
            if (response) {
              $('.btn-signup').removeClass("disabled");

              let msg = document.getElementById("msgUsername");
              usernameFlag = true;

              if (msg)
                usernameContent.removeChild(msg);
            } else {
              msgAlert(usernameContent, '{{ __("Nome já utilizado") }}', 'msgUsername');
              usernameFlag = false;
            }
          })
      });
    });

    $(document).ready(function() {
      $('#emailSignup').on('focusout', function() {
        var value = $(this).val();
        $('.btn-signup').addClass("disabled");

        let msg = document.getElementById("msgEmail");
        if (msg) emailContent.removeChild(msg);
        if (value === "") {
          msgAlert(emailContent, "{{ __('Campo obrigatório') }}", "msgEmail");
          emailFlag = false;
          return;
        }
        $.ajax({
            url: "{{ route('email.availability', app()->getLocale()) }}",
            type: 'GET',
            data: {
              'floatingEmail': value
            },
            beforeSend: () => {
              let msg = document.getElementById("msgEmail");
              if (msg)
                emailContent.removeChild(msg);;
              $("#loading-email").css('display', 'block');
              emailFlag = false;
            },
            complete: () => {
              $("#loading-email").css('display', 'none');
            }
          })
          .done((response) => {
            if (response) {
              $('.btn-signup').removeClass("disabled");

              let msg = document.getElementById("msgEmail");
              emailFlag = true;
              if (msg)
                emailContent.removeChild(msg);
            } else {
              msgAlert(emailContent, "{{ __('Email já utilizado') }}", 'msgEmail');
              emailFlag = false;
            }
          })
      });
    });
  </script>
</body>

</html>