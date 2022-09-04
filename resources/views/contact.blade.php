<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Fale Conosco') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/contact.css" rel="stylesheet" />
  <link href="/assets/icon/style.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico" />
  <link href="https://fonts.googleapis.com/css2?family=Fresca&display=swap" rel="stylesheet" />
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
  <main class="d-flex meet">
    <div class="web-background w-100 vh-100">
      <div class="background-blur w-100 h-100">
        <div class="container p-4 d-flex w-100 h-100 align-items-center justify-content-between">
          <img src="/assets/img/formVisitaSampa.png" alt="" class="img-logo" />
          <div id="contact" class="contact text-center h-100">
            <h2 class="title-contact">{{ __('FORMULÁRIO') }}</h2>

            <form method="POST" id="form" action="{{ route('contact.email', app()->getLocale()) }}" class="form-signup d-flex flex-column h-100 justify-content-around align-items-center">
              @csrf
              <div id="nameContent" class="inputContent">
                <input type="text" name="name" id="name" placeholder="{{ __('Nome') }}" autocomplete="off" class="input-contact" required />
              </div>
              <div id="emailContent" class="inputContent">
                <input type="email" name="email" id="email" placeholder="E-mail" autocomplete="off" class="input-contact" required />
              </div>
              <div id="subjectContent" class="inputContent">
                <input type="text" name="subject" id="subject" placeholder="{{ __('Assunto') }}" autocomplete="off" class="input-contact" required />
              </div>
              <div id="commentsContent" class="inputContent">
                <textarea name="comments" id="comments" class="input-contact" placeholder="{{ __('Adicione seu comentário') }}"></textarea>
              </div>
              <button type="submit" class="btn-contact">{{ __('Enviar') }}</button>
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
        @if(session('msgEmailSendSuccess'))
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          Sucesso
        </strong>
        @elseif(session('msgEmailSendFail'))
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          Falha
        </strong>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        @if(session('msgEmailSendSuccess'))
          {{ session('msgEmailSendSuccess') }}
        @elseif(session('msgEmailSendFail'))
          {{ session('msgEmailSendFail') }}
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
            <a href="{{ route('home', app()->getLocale()) }}" class="text-decoration-none text-dark">Home</a>
          </h6>
          <p>
            <a href="{{ route('quiz', app()->getLocale()) }}" class="text-decoration-none text-dark">{{ __('Teste') }}</a>
          </p>
          <p>
            <a href="{{ route('signup', app()->getLocale()) }}" class="text-decoration-none text-dark">{{ __('Cadastrar') }}</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-3 text-dark">
            {{ __('Sobre') }}
          </h6>
          <p>
            <input class="dropdown-paper" type="checkbox" id="dropdown-paper" name="dropdown-paper" />
            <label class="for-dropdown-paper" for="dropdown-paper" onclick="openModal('#modalTerms')">
              <span id="terms" data-toggle="modal" data-target="#modalTerms">{{ __('Termo de Uso') }}</span>
            </label>
          </p>
          <p>
            <input class="dropdown-alert" type="checkbox" id="dropdown-alert" name="dropdown-alert" />
            <label class="for-dropdown-alert" for="dropdown-alert" onclick="openModal('#modalAbout')">
              <span id="about" data-toggle="modal" data-target="#modalAbout">{{ __('Sobre') }}</span>
            </label>
          </p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </footer>

  <!-- Modal -->
  <div class="modal fade" id="modalTerms" tabindex="-1" aria-labelledby="modalTerms" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTermsTitle">{{ __('Termo de Uso') }}</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
            <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <div class="modal-body text-center p-3">
          <h6><u>{{ __('Política de Privacidade e Proteção de Dados Pessoais') }}</u></h6>
          <p>
            <em>{{ __('Atualizado em') }} 17/08/2022</em>
          </p>
          <br />
          <div class="text-start">
            <p>
              {{ __('Ao utilizar o sistema, você está concordando com os Termos de Uso') }}.
            </p>
            <p>
              {{ __('Os dados utilizados pelo sistema não são públicos e não serão divulgados pela entidade responsável pela aplicação') }}.
            </p>
            <p>
              {{ __('Para manter a rede funcionando de maneira amigável, o usuário não deve postar fotos indevidas no website, além de publicar apenas fotos condizente com o local selecionado no roteiro') }}.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAbout" tabindex="-1" aria-labelledby="modalAbout" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAboutTitle">{{ __('Sobre') }} Visita Sampa</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
            <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <div class="modal-body text-center p-3">
          <img class="logo my-3" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
          <p>
            {{ __('Plataforma WEB com informações a respeito da cultura paulistana, indicações de locais da cidade e eventos que ocorrerão') }}
          </p>
          <p class="text-blue my-3 fw-bold">
            {{ __('Fale Conosco') }}
          </p>
          <div class="d-flex justify-content-evenly mb-3">
            <div class="email">
              <a href="mailto:sigma5.equipe@gmail.com" class="text-decoration-none text-dark fs-6">
                <i class="icon-mail fs-6"></i>
                <h6 class="fs-6" title="sigma5.equipe@gmail.com">E-mail</h6>
              </a>
            </div>
            <div class="form">
              <a href="{{ route('contact', app()->getLocale()) }}" class="text-decoration-none text-dark fs-6">
                <i class="icon-message-circle fs-6"></i>
                <h6 class="fs-6">{{ __('Formulário') }}</h6>
              </a>
            </div>
          </div>
          <p>
            {{ __('Para mais informações, entre em um dos links abaixo') }}:
          </p>
          <div class="d-flex justify-content-around mt-3">
            <a href="https://sigma-equipe.blogspot.com" class="text-decoration-none text-dark" target="_blank">
              <i class="icon-blogger fs-5"></i>
            </a>
            <a href="https://github.com/visita-sampa" class="text-decoration-none text-dark" target="_blank">
              <i class="icon-github fs-5"></i>
            </a>
            <a href="https://www.youtube.com/channel/UCQ9lG55gNSXKlr6X9af336w/featured" class="text-decoration-none text-dark" target="_blank">
              <i class="icon-youtube-play fs-5"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="/assets/js/jquery.slim.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="/assets/js/contact.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    @if(session('msgEmailSendSuccess') || session('msgEmailSendFail'))
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