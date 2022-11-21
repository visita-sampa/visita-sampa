<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('Confirmação de e-mail') }}</title>
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
      <div class="container py-5">
        @if(isset($msgError))
        <div class="card w-75 m-auto">
          <div class="card-header bg-light">
          {{ __('Erro') }
          </div>
          <div class="card-body">
            <h5 class="card-title text-danger">{{ $msgError }}</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
        @endif
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
              &copy; 2022 Copyright:
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
    <script src="/assets/js/main.js"></script>
  </body>
</html>
