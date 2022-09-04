<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Visita Sampa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/home.css" rel="stylesheet" />
  <link href="/assets/icon/style.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico" />
  <link href="https://fonts.googleapis.com/css2?family=Fresca&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    @include('nav')
  </header>

  <main class="">
    <div class="meet">
      <h3>{{ __('Conheça o') }}</h3>
      <img class="img-meet" src="/assets/img/logoVisitaSampa.png" alt="{{ __('Conheça o Visita Sampa!') }}" />
    </div>
    <div class="infos">
      <div class="description-box">
        <h3>{{ __('Explore eventos, locais e experiências') }}</h3>
      </div>
      <img class="img-infos" src="/assets/img/pagVisitaSampa.png" alt="{{ __('Páginas do Visita Sampa') }}" />
    </div>
    <div class="profile">
      <img class="img-quiz" src="/assets/img/quizVisitaSampa.png" alt="{{ __('Faça o quiz Visita Sampa!') }}" />
      <div class="description-box">
        <h3>{{ __('Com direcionamento especializado para o seu perfil') }}</h3>
        <a class="d-flex align-items-center justify-content-center text-decoration-none text-center" href="{{ route('quiz', app()->getLocale()) }}">
          <p class="btn-road-map link-a-home">{{ __('Descubra seu roteiro') }}</p>
        </a>
      </div>
    </div>
    <div class="sing-up">
      <div class="description-box">
        <h3>{{ __('Conecte-se e descubra essa grande cidade') }}</h3>
        <a class="d-flex align-items-center justify-content-center text-decoration-none text-center" href="{{ route('signup', app()->getLocale()) }}">
          <p class="btn-sing-up link-a-home">{{ __('CADASTRE-SE') }}</p>
        </a>
      </div>
      <img class="img-sing-up" src="/assets/img/roadMapVisitaSampa.png" alt="{{ __('Pontos Turísticos') }}" />
    </div>
    <div class="contact pt-5">
      <h3>{{ __('Como você prefere falar com a gente') }}?</h3>
      <div class="contact-us">
        <div class="email">
          <i class="icon-mail"></i>
          <h4>E-mail</h4>
          <p class="text-sing-up">{{ __('Tem alguma dúvida') }}?</p>
          <h6><a class="go-form" href="mailto:sigma5.equipe@gmail.com">sigma5.equipe@gmail.com</a></h6>
        </div>
        <div class="form">
          <i class="icon-message-circle"></i>
          <h4>{{ __('Formulário') }}</h4>
          <p class="text-sing-up">{{ __('Quer mandar a sua dúvida aqui') }}?</p>
          <a class="go-form" href="{{ route('contact', app()->getLocale()) }}">{{ __('Clique aqui') }}!</a>
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
            <input type="checkbox" id="dropdown-paper" name="dropdown-paper" />
            <label class="for-dropdown-paper text-dark cursor-pointer" for="dropdown-paper" onclick="openModal('#modalTerms')">
              <span id="terms" data-toggle="modal" data-target="#modalTerms">{{ __('Termo de Uso') }}</span>
            </label>
          </p>
          <p>
            <input type="checkbox" id="dropdown-alert" name="dropdown-alert" />
            <label class="for-dropdown-alert text-dark cursor-pointer" for="dropdown-alert" onclick="openModal('#modalAbout')">
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
  <script src="/assets/js/main.js"></script>
</body>

</html>