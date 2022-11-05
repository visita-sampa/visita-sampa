<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Security-Policy" content="default-src 'self' data: gap: ws: ;
  style-src 'self' 'unsafe-inline' https://fonts.googleapis.com
     https://cdn.jsdelivr.net/npm/ https://cdnjs.cloudflare.com/ajax/ ;
  script-src 'self' 'unsafe-eval' https://ajax.googleapis.com/ajax/
     https://cdnjs.cloudflare.com/ajax/ https://activity-project-unit.herokuapp.com ;
  font-src https://fonts.gstatic.com data: ;">
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

  <main class="pt-5">
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
  @include('footer')

  <script src="/assets/js/jquery.slim.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="/assets/js/main.js"></script>
  <script>
    $('#modalConfiguration').appendTo("body");
    $('#modalTerms').appendTo("body");
    $('#modalAbout').appendTo("body");
  </script>
</body>

</html>