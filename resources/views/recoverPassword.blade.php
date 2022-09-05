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
    @include('nav')
  </header>

  <main class="d-flex">
    <div class="web-background w-100 vh-100">
      <div class="background-blur w-100 h-100">
        <div class="container login p-4 d-flex flex-row w-100 align-items-center">
          <img src="/assets/img/logoVisitaSampa.png" alt="" class="img-logo" />

          <div id="signup" class="signup text-center h-100">
            <h2 class="title-login">{{ __('Recuperar senha') }}</h2>
            <form method="POST" action="{{ route('password.request', app()->getLocale()) }}" class="form-signup d-flex flex-column h-50 justify-content-around">
              @csrf
              <!-- @if(session('msgEmailSuccess'))
              <div class="callout warning-box bd-callout bd-callout-success">
                {{ session('msgEmailSuccess') }}
              </div>
              @elseif(session('msgEmailFail'))
              <div class="callout warning-box bd-callout bd-callout-danger">
                {{ session('msgEmailFail') }}
              </div>
              @endif -->
              <p>{{ __('Informe seu e-mail cadastrado') }}</p>
              <input type="email" name="email" id="email" placeholder="E-mail" autocomplete="off" class="input-signup" required />
              <button type="submit" class="btn-signup mt-3">{{ __('Recuperar') }}</button>
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
        @if(session('msgSendUpdatePasswordEmailSuccess'))
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          {{ __('Sucesso') }}
        </strong>
        @elseif(session('msgSendUpdatePasswordEmailFail') || session('msgUpdatePasswordRequestFail') || session('msgFindUserFail') || session('msgInvalidLink'))
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          {{ __('Falha') }}
        </strong>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        @if(session('msgSendUpdatePasswordEmailSuccess'))
        {{ session('msgSendUpdatePasswordEmailSuccess') }}

        @elseif(session('msgSendUpdatePasswordEmailFail'))
        {{ session('msgSendUpdatePasswordEmailFail') }}

        @elseif(session('msgUpdatePasswordRequestFail'))
        {{ session('msgUpdatePasswordRequestFail') }}

        @elseif(session('msgFindUserFail'))
        {{ session('msgFindUserFail') }}

        @elseif(session('msgInvalidLink'))
        {{ session('msgInvalidLink') }}

        @endif
      </div>
    </div>
  </div>

  <!-- Footer -->
  @include('footer')

  <script src="/assets/js/jquery.slim.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    @if(session('msgSendUpdatePasswordEmailSuccess') || session('msgSendUpdatePasswordEmailFail') || session('msgUpdatePasswordRequestFail') || session('msgFindUserFail') || session('msgInvalidLink'))
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
