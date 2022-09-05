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
          <a href="{{ route('quiz', app()->getLocale()) }}" class="text-decoration-none text-dark">{{ __('Questionário') }}</a>
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
          <label class="for-dropdown-paper text-dark cursor-pointer" for="dropdown-paper" >
            <span id="terms" data-toggle="modal" data-target="#modalTerms">{{ __('Termo de Uso') }}</span>
          </label>
        </p>
        <p>
          <label class="for-dropdown-alert text-dark cursor-pointer" for="dropdown-alert" >
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
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTermsTitle">{{ __('Termo de Uso') }}</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body text-center p-3">
        <h6><u>{{ __('Política de Privacidade e Proteção de Dados Pessoais') }}</u></h6>
        <p class="terms">
          <em>{{ __('Atualizado em') }} 17/08/2022</em>
        </p>
        <br />
        <div class="text-start">
          <p class="terms">
            {{ __('Ao utilizar o sistema, você está concordando com os Termos de Uso') }}.
          </p>
          <p class="terms">
            {{ __('Os dados utilizados pelo sistema não são públicos e não serão divulgados pela entidade responsável pela aplicação') }}.
          </p>
          <p class="terms">
            {{ __('Para manter a rede funcionando de maneira amigável, o usuário não deve postar fotos indevidas no website, além de publicar apenas fotos condizente com o local selecionado no roteiro') }}.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAbout" tabindex="-1" aria-labelledby="modalAbout" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAboutTitle">{{ __('Sobre') }}</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body text-center p-3">
        <img class="logo my-3" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
        <p class="about">
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
        <p class="about">
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