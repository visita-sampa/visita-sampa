@if (Auth::user() && Auth::user()->id_usuario > 1)

<nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
  <div class="container">
    <a href="{{ route('home', app()->getLocale()) }}">
      <img class="logo" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
    </a>
    <div class="sec-center">
      <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
      <label class="for-dropdown" for="dropdown">
        <i class="icon-arrow_drop_down"></i>
        <img src="{{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}}" alt="" class="profile-img-menu rounded-circle" alt="Foto Perfil Usuário" />
      </label>
      <div class="section-dropdown">
        <input class="dropdown-profile" type="checkbox" id="dropdown-profile" name="dropdown-profile" />
        <label class="for-dropdown-profile" for="dropdown-profile">
          <a href="{{ route('user', app()->getLocale()) }}">
            <i class="icon-user"></i>
            <span>{{ __('Meu Perfil') }}</span>
          </a>
        </label>

        <input class="dropdown-settings" type="checkbox" id="dropdown-settings" name="dropdown-settings" data-bs-toggle="dropdown"/>
        <label class="for-dropdown-settings" for="dropdown-settings" data-bs-toggle="dropdown">
          <i class="icon-settings"></i>
          <span id="config" data-toggle="modal" data-target="#modalConfiguration">{{ __('Configurações') }}</span>
        </label>

        <input class="dropdown-translate" type="checkbox" id="dropdown-translate" name="dropdown-translate" />
        <label class="for-dropdown-translate" for="dropdown-translate" id="for-dropdown-translate">
          <div class="option-translate">
            <i class="icon-translate"></i>
            <span>{{ __('Idioma') }}<i class="icon-arrow_drop_down"></i></span>
          </div>
          <ul class="translate" id="translate">
            <li class="portuguese">
              <a href="{{ route(Route::currentRouteName(), 'pt') }}" id="pt-br">
                <i class="icon-brazil"></i>
                PT-BR
              </a>
            </li>
            <li class="english">
              <a href="{{ route(Route::currentRouteName(), 'en') }}" id="en-us">
                <i class="icon-usa"></i>
                EN-US
              </a>
            </li>
          </ul>
        </label>

        <input class="dropdown-paper" type="checkbox" id="dropdown-paper" name="dropdown-paper" />
        <label class="for-dropdown-paper" for="dropdown-paper">
          <i class="icon-paper"></i>
          <span id="terms" data-toggle="modal" data-target="#modalTerms">{{ __('Termo de Uso') }}</span>
        </label>

        <input class="dropdown-alert" type="checkbox" id="dropdown-alert" name="dropdown-alert" />
        <label class="for-dropdown-alert" for="dropdown-alert">
          <i class="icon-alert-circle"></i>
          <span id="about" data-toggle="modal" data-target="#modalAbout">{{ __('Sobre') }}</span>
        </label>

        <input class="dropdown-log-out" type="checkbox" id="dropdown-log-out" name="dropdown-log-out" />
        <label class="for-dropdown-log-out" for="dropdown-log-out">
          <a href="{{ route('logout', app()->getLocale()) }}">
            <i class="icon-log-out"></i>
            <span>{{ __('Sair') }}</span>
          </a>
        </label>
      </div>

      <!-- Modais -->
      <div class="modal fade" id="modalConfiguration" tabindex="-1" role="dialog" aria-labelledby="modalConfiguration" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form method="POST" action="{{ route('update.profile', app()->getLocale()) }}">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="modalConfigurationTitle">{{ __('Configurações') }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body modal-body-user">
                <div style="background-image: url({{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}})" alt="" class="profile-img rounded-circle" id="image-preview"></div>
                <label for="profile-pic" class="change-picture">
                  {{ __('Alterar foto de perfil') }}
                </label>
                <input type="file" name="profile-pic" id="profile-pic" class="d-none image-upload image-upload-config" />
                <input type="hidden" name="base64image" id="base64image" />
                <div class="bio">
                  <span class="bio-title"><i class="icon-user"></i>{{ __('Editar Perfil') }}</span>
                  <div class="form-floating" id="nameContent">
                    <input type="text" class="form-control" id="floatingName" placeholder="{{ __('Nome') }}" value="{{Auth::user()->nome}}">
                    <label for="floating-name">{{ __('Nome') }}</label>
                  </div>
                  <div class="form-floating" id="usernameContentFloating">
                    <input type="text" class="form-control" id="floatingUsername" placeholder="{{ __('Nome de usuário') }}" value="{{Auth::user()->nome_usuario}}">
                    <label for="floating-user-name">{{ __('Nome de usuário') }}</label>
                    <span id="loading" class="loading-username">Verificando nome</span>
                  </div>
                  <div class="form-floating textarea">
                    <textarea class="form-control" id="floatingBio" maxlength="128" placeholder="Bio">{{Auth::user()->descricao}}</textarea>
                    <label for="floating-bio">Bio</label>
                  </div>
                </div>
                <div class="password">
                  <span class="password-title"><i class="icon-lock"></i>{{ __('Senha') }}</span>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="{{ __('Senha atual') }}">
                    <label for="floating-password">{{ __('Senha atual') }}</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingNewPassword" placeholder="{{ __('Nova senha') }}">
                    <label for="floating-new-password">{{ __('Nova senha') }}</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingRepeatPassword" placeholder="Repita a nova senha">
                    <label for="floating-repeat-password">{{ __('Repita a nova senha') }}</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">{{ __('Fechar') }}</button>
                <button type="submit" class="btn btn-primary save">{{ __('Salvar') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalTerms" tabindex="-1" aria-labelledby="modalTerms" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTermsTitle">{{ __('Termo de Uso') }}</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <!-- <span aria-hidden="true">&times;</span> -->
              </button>
            </div>
            <div class="modal-body text-center p-3 modal-content-terms">
              <h6><u>{{ __('Política de Privacidade e Proteção de Dados Pessoais') }}</u></h6>
              <p class="terms">
                <em>{{ __('Atualizado em') }} 17/08/2022</em>
              </p>
              <br />
              <div class="text-start">
                <p class="terms">
                  {{ __('Seja bem-vindo ao Visita Sampa!')}}
                </p>
                <p class="terms">
                  {{ __('Estes termos e condições descrevem as regras de uso do site da empresa Sigma, localizado no endereço https://visita-sampa.herokuapp.com/.') }}
                </p>
                <p class="terms">
                  {{ __('Ao acessar este site, consideramos que você está de acordo com os termos e condições abaixo. Não continue a usar o Visita Sampa caso você discorde dos termos e condições descritos neste contrato.') }}
                </p>
                <p class="terms">
                  <strong>{{ __('Cookies:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('O site usa cookies para ajudar na personalização da sua experiência na internet. Ao acessar o site Visita Sampa, você concorda com o uso dos cookies requeridos.') }}
                </p>
                <p class="terms">
                  {{ __('Cookies são arquivos de texto inseridos no seu disco rígido por um servidor de página web. Os cookies não têm permissão para executar programas ou transferir vírus para seu computador. Os cookies são associados exclusivamente a você e só podem ser lidos pelo servidor web do domínio que emitiu o cookie.')}}
                </p>
                <p class="terms">
                  {{ __('Nós podemos usar cookies para coletar, armazenar ou rastrear informações para finalidades estatísticas e mercadológicas do nosso site. Você tem a opção de aceitar ou rejeitar os cookies opcionais. Existem alguns cookies obrigatórios, que são necessários para o funcionamento de nosso site. Esses cookies obrigatórios são requerem seu consentimento. Por favor, tenha em mente que, ao aceitar os cookies obrigatórios, você também estará aceitando cookies de terceiros, que podem ser usados por terceiros caso você utilize serviços fornecidos por eles em nosso site – por exemplo, uma janela de reprodução de vídeo fornecida por empresas terceiras e integrada ao nosso site.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Licença:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('Exceto em casos em que for indicado o contrário, Sigma e seus licenciados têm direito à propriedade intelectual de todo o material postado no Visita Sampa. Todos os direitos à propriedade intelectual são reservados.')}}
                </p>
                <p class="terms">
                  {{ __('Você não tem permissão para:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('Copiar ou republicar materiais do Visita Sampa')}}</li>
                  <li>{{ __('Vender, alugar ou sublocar materiais do Visita Sampa')}}</li>
                  <li>{{ __('Reproduzir, duplicar ou copiar materiais do Visita Sampa')}}</li>
                  <li>{{ __('Redistribuir conteúdos do Visita Sampa')}}</li>
                  <li>{{ __('Este Acordo terá efeito a partir da data presente.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('Partes deste site oferecem ao usuário a oportunidade de postar e discutir opiniões e informações em determinadas áreas. Sigma não filtra, edita, publica ou revisa Comentários antes que eles sejam apresentados no site. Comentários refletem as opiniões da pessoa que os posta. Na extensão em que as leis aplicáveis permitem, Sigma não se responsabiliza legalmente pelos Comentários ou quaisquer danos, riscos ou despesas causadas ou sofridas como resultado do uso, e/ou postagem e/ou aparência dos Comentários deste site.')}}
                </p>
                <p class="terms">
                  {{ __('Sigma reserva para si o direito de remover quaisquer Comentários que possam ser considerados inapropriados, ofensivos ou quebrem os Termos e Condições deste contrato.')}}
                </p>
                <p class="terms">
                  {{ __('Você por meio deste concede a Sigma a licença não-exclusiva de usar, reproduzir, editar e autorizar outros a usar, reproduzir ou editar qualquer um de seus Comentários em qualquer e todas as formas, formatos e mídias.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Criação de links para nosso conteúdo:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('As seguintes organizações podem criar links para nosso Site sem a necessidade de aprovação prévia por escrito:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('Agências governamentais;')}}</li>
                  <li>{{ __('Mecanismos de busca;')}}</li>
                  <li>{{ __('Organizações de mídia;')}}</li>
                  <li>{{ __('Distribuidores de diretórios online podem inserir links para nosso Site na mesma maneira que inserem hiperlinks para Sites de outras empresas listadas; e')}}</li>
                  <li>{{ __('Empresas credenciadas, exceto organizações angariantes sem fins lucrativos e grupos de arrecadação de fundos para instituições de caridade, que não podem inserir links para nosso Site sem aprovação prévia. Essas organizações podem postar links para nossa página inicial, nossas publicações ou outras informações do Site, contanto que o link: (a) não seja, de forma alguma, enganoso; (b) não insinue falsamente a existência de uma relação de patrocínio, endosso, ou aprovação nossa a produtos e/ou serviços; e (c) seja apropriado ao contexto em que está sendo inserido.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('Nós podemos considerar e aprovar solicitações de link feitas pelos seguintes tipos de organizações:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('fontes de informação bem conhecidas sobre produtos e negócios;')}}</li>
                  <li>{{ __('sites comunitários ponto.com;')}}</li>
                  <li>{{ __('associações e outros grupos que representem instituições de caridade;')}}</li>
                  <li>{{ __('distribuidores de diretórios online;')}}</li>
                  <li>{{ __('portais de internet;')}}</li>
                  <li>{{ __('firmas de contabilidade, advocacia e consultoria; e')}}</li>
                  <li>{{ __('instituições educacionais e associações de classe.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('Nós vamos aprovar solicitações de link feitas pelos tipos de organização listados acima se julgarmos que: (a) o link não é desfavorável para nossa imagem e/ou para a imagem de empresas credenciadas; (b) a organização solicitante não possui histórico negativo conosco; (c) o benefício que ganhamos com a visibilidade do link compensa a ausência do Sigma; e (d) o link será inserido em um contexto geral informativo.')}}
                </p>
                <p class="terms">
                  {{ __('Essas organizações podem postar links para nossa página inicial contanto que o link: (a) não seja, de forma alguma, enganoso; (b) não insinue falsamente a existência de uma relação de patrocínio, endosso, ou aprovação de produtos e/ou serviços da nossa parte; e (c) seja apropriado ao contexto em que está sendo inserido.')}}
                </p>
                <p class="terms">
                  {{ __('Se você representa uma das organizações listadas no parágrafo 2 acima e está interessado em postar um link para nosso site, você deve nos informar de seu interesse enviando um e-mail para Sigma. Por favor, inclua seu some, o nome da sua organização e suas informações de contato, assim como a URL do seu site, uma lista das URLs do nosso site que você pretende usar como links, e uma lista dos sites nos quais você pretende publicar nossas URLs. Aguarde entre 2 e 3 semanas para receber uma resposta.')}}
                </p>
                <p class="terms">
                  {{ __('Organizações aprovadas poderão publicar links para nosso Site das seguintes formas:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('Usando nosso nome corporativo; ou')}}</li>
                  <li>{{ __('Usando a URL para onde o link redireciona; ou')}}</li>
                  <li>{{ __('Usando qualquer outra descrição do nosso Site que faça sentido dentro do contexto e do formato do conteúdo onde o link está sendo inserido.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('Não será permitido o uso ou a publicação de links para o logo e/ou outros elementos visuais da Sigma sem um acordo de licença para o uso da marca registrada.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Responsabilização pelo Conteúdo:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('Não seremos responsabilizados legalmente por qualquer conteúdo que apareça no seu Site. Você concorda em nos proteger e nos defender contra todas as acusações que forem levantadas no seu Site. Nenhum link deve aparecer em qualquer Site que possa ser interpretado como difamatório, obsceno, criminoso, ou que infrinja, viole ou defenda a violação dos direitos de terceiros.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Reserva de Direitos:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('Reservamos nosso direito de solicitar que você remova todos os links ou quaisquer links que redirecionem para nosso site. Você concorda em remover imediatamente todos os links para nosso site assim que a remoção for solicitada. Também reservamos nosso direito de corrigir e alterar estes termos e condições a qualquer momento. Ao publicar continuadamente links para nosso site, você concorda a seguir estes termos e condições sobre links.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Remoção de links postados em nosso site:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('Se você encontrar qualquer link em nosso Site que seja de qualquer forma ofensivo, você tem a liberdade de entrar em contato conosco e nos informar do problema a qualquer momento. Vamos considerar as solicitações de remoção de links, mas não somos obrigados a remover quaisquer links do nosso site nem a responder diretamente à sua solicitação.')}}
                </p>
                <p class="terms">
                  {{ __('Nós não garantimos que as informações continas neste site são corretas. Nós não garantimos integralidade ou exatidão do conteúdo. Não garantimos que o site se manterá disponível ou que o material do site se manterá atualizado.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Declaração de Isenção de Responsabilidade:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('No máximo possível permitido por lei, nós excluímos todas as representações, garantias e condições relativas ao nosso site e ao uso deste site. Nada nesta declaração de isenção de responsabilidade vai:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('limitar ou excluir nossa responsabilidade ou sua responsabilidade por mortes ou danos pessoais;')}}</li>
                  <li>{{ __('limitar ou excluir nossa responsabilidade ou sua responsabilidade por fraudes ou deturpações fraudulentas;')}}</li>
                  <li>{{ __('limitar nossa responsabilidade ou sua responsabilidade de quaisquer maneiras que não forem permitidas sob a lei; excluir quaisquer responsabilidades suas ou nossas que não podem ser excluídas de acordo com a lei aplicável.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('As limitações e proibições de responsabilização listadas nesta Seção e em outras partes desta declaração: (a) estão sujeitas ao parágrafo anterior; e (b) regem todas as responsabilizações que surgirem sob a declaração, incluindo responsabilizações surgidas em contrato, em delitos e em quebra de obrigações legais.')}}
                </p>
                <p class="terms">
                  {{ __('Enquanto o site e as informações e serviços do site forem oferecidos gratuitamente, nós não seremos responsáveis por perdas e danos de qualquer natureza.')}}
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
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
              <img class="logo my-3" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
              <p>
                {{ __('Plataforma WEB com informações a respeito da cultura paulistana, indicações de locais da cidade e eventos que ocorrerão') }}
              </p>
              <p class="text-blue my-3">
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
    </div>
  </div>
</nav>

<script>
  $('#modalConfiguration').appendTo("body");
  $('#modalTerms').appendTo("body");
  $('#modalAbout').appendTo("body");

  $(document).ready(function() {
      $('#floatingUsername').on('focusout', function() {
        var value = $(this).val();
        $('#btn-submit').addClass("disabled");

        let msg = document.getElementById("msgUsername");
        if (msg) usernameContentConfig.removeChild(msg);
        if (value === "") {
          msgAlert(usernameContentConfig, "Campo obrigatório", "msgUsername");
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
                usernameContentConfig.removeChild(msg);;
              $("#loading").css('display','block');
              usenameFlag = false;
            },
            complete: () => {
              $("#loading").css('display','none');
            }
          })
          .done((response) => {
            if (response) {
              $('#btn-submit').removeClass("disabled");

              let msg = document.getElementById("msgUsername");
              usernameFlag = true;
	            if (msg)
                usernameContentConfig.removeChild(msg);
            } else {
              msgAlert(usernameContentConfig,'Nome já utilizado','msgUsername');
              usernameFlag = false;
            }
          })
      });
    });
</script>

@elseif(Auth::user() && Auth::user()->id_usuario == 1)
<nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
  <div class="container">
    <a href="{{ route('home', app()->getLocale()) }}">
      <img class="logo" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
    </a>
    <div class="sec-center">
      <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
      <label class="for-dropdown" for="dropdown">
        <i class="icon-arrow_drop_down"></i>
        <img src="{{ Auth::user()->foto_perfil == '' ? '/img/users/profileDefault.png' : Auth::user()->foto_perfil}}" alt="" class="profile-img-menu rounded-circle" alt="Foto Perfil Usuário" />
      </label>
      <div class="section-dropdown">
        <input class="dropdown-report" type="checkbox" id="dropdown-report" name="dropdown-report" />
        <label class="for-dropdown-report" for="dropdown-report">
          <a href="{{ route('adminReport', app()->getLocale()) }}">
            <i class="icon-alert-triangle"></i>
            <span>{{ __('Denúncias') }}</span>
          </a>
        </label>

        <input class="dropdown-events" type="checkbox" id="dropdown-events" name="dropdown-events" />
        <label class="for-dropdown-events" for="dropdown-events">
          <a href="{{ route('adminEvents', app()->getLocale()) }}">
            <i class="icon-map-pin"></i>
            <span>{{ __('Eventos') }}</span>
          </a>
        </label>

        <input class="dropdown-translate" type="checkbox" id="dropdown-translate" name="dropdown-translate" />
        <label class="for-dropdown-translate" for="dropdown-translate" id="for-dropdown-translate">
          <div class="option-translate">
            <i class="icon-translate"></i>
            <span>{{ __('Idioma') }}<i class="icon-arrow_drop_down"></i></span>
          </div>
          <ul class="translate" id="translate">
            <li class="portuguese">
              <a href="{{ route(Route::currentRouteName(), 'pt') }}" id="pt-br">
                <i class="icon-brazil"></i>
                PT-BR
              </a>
            </li>
            <li class="english">
              <a href="{{ route(Route::currentRouteName(), 'en') }}" id="en-us">
                <i class="icon-usa"></i>
                EN-US
              </a>
            </li>
          </ul>
        </label>

        <input class="dropdown-paper" type="checkbox" id="dropdown-paper" name="dropdown-paper" />
        <label class="for-dropdown-paper" for="dropdown-paper">
          <i class="icon-paper"></i>
          <span id="terms" data-toggle="modal" data-target="#modalTerms">{{ __('Termo de Uso') }}</span>
        </label>

        <input class="dropdown-alert" type="checkbox" id="dropdown-alert" name="dropdown-alert" />
        <label class="for-dropdown-alert" for="dropdown-alert">
          <i class="icon-alert-circle"></i>
          <span id="about" data-toggle="modal" data-target="#modalAbout">{{ __('Sobre') }}</span>
        </label>

        <input class="dropdown-log-out" type="checkbox" id="dropdown-log-out" name="dropdown-log-out" />
        <label class="for-dropdown-log-out" for="dropdown-log-out">
          <a href="{{ route('logout', app()->getLocale()) }}">
            <i class="icon-log-out"></i>
            <span>{{ __('Sair') }}</span>
          </a>
        </label>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalTerms" tabindex="-1" aria-labelledby="modalTerms" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTermsTitle">{{ __('Termo de Uso') }}</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3 modal-content-terms">
              <h6><u>{{ __('Política de Privacidade e Proteção de Dados Pessoais') }}</u></h6>
              <p>
                <em>{{ __('Atualizado em') }} 05/09/2022</em>
              </p>
              <br />
              <div class="text-start">
                <p class="terms">
                  {{ __('Seja bem-vindo ao Visita Sampa!')}}
                </p>
                <p class="terms">
                  {{ __('Estes termos e condições descrevem as regras de uso do site da empresa Sigma, localizado no endereço https://visita-sampa.herokuapp.com/.') }}
                </p>
                <p class="terms">
                  {{ __('Ao acessar este site, consideramos que você está de acordo com os termos e condições abaixo. Não continue a usar o Visita Sampa caso você discorde dos termos e condições descritos neste contrato.') }}
                </p>
                <p class="terms">
                  <strong>{{ __('Cookies:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('O site usa cookies para ajudar na personalização da sua experiência na internet. Ao acessar o site Visita Sampa, você concorda com o uso dos cookies requeridos.') }}
                </p>
                <p class="terms">
                  {{ __('Cookies são arquivos de texto inseridos no seu disco rígido por um servidor de página web. Os cookies não têm permissão para executar programas ou transferir vírus para seu computador. Os cookies são associados exclusivamente a você e só podem ser lidos pelo servidor web do domínio que emitiu o cookie.')}}
                </p>
                <p class="terms">
                  {{ __('Nós podemos usar cookies para coletar, armazenar ou rastrear informações para finalidades estatísticas e mercadológicas do nosso site. Você tem a opção de aceitar ou rejeitar os cookies opcionais. Existem alguns cookies obrigatórios, que são necessários para o funcionamento de nosso site. Esses cookies obrigatórios são requerem seu consentimento. Por favor, tenha em mente que, ao aceitar os cookies obrigatórios, você também estará aceitando cookies de terceiros, que podem ser usados por terceiros caso você utilize serviços fornecidos por eles em nosso site – por exemplo, uma janela de reprodução de vídeo fornecida por empresas terceiras e integrada ao nosso site.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Licença:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('Exceto em casos em que for indicado o contrário, Sigma e seus licenciados têm direito à propriedade intelectual de todo o material postado no Visita Sampa. Todos os direitos à propriedade intelectual são reservados.')}}
                </p>
                <p class="terms">
                  {{ __('Você não tem permissão para:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('Copiar ou republicar materiais do Visita Sampa')}}</li>
                  <li>{{ __('Vender, alugar ou sublocar materiais do Visita Sampa')}}</li>
                  <li>{{ __('Reproduzir, duplicar ou copiar materiais do Visita Sampa')}}</li>
                  <li>{{ __('Redistribuir conteúdos do Visita Sampa')}}</li>
                  <li>{{ __('Este Acordo terá efeito a partir da data presente.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('Partes deste site oferecem ao usuário a oportunidade de postar e discutir opiniões e informações em determinadas áreas. Sigma não filtra, edita, publica ou revisa Comentários antes que eles sejam apresentados no site. Comentários refletem as opiniões da pessoa que os posta. Na extensão em que as leis aplicáveis permitem, Sigma não se responsabiliza legalmente pelos Comentários ou quaisquer danos, riscos ou despesas causadas ou sofridas como resultado do uso, e/ou postagem e/ou aparência dos Comentários deste site.')}}
                </p>
                <p class="terms">
                  {{ __('Sigma reserva para si o direito de remover quaisquer Comentários que possam ser considerados inapropriados, ofensivos ou quebrem os Termos e Condições deste contrato.')}}
                </p>
                <p class="terms">
                  {{ __('Você por meio deste concede a Sigma a licença não-exclusiva de usar, reproduzir, editar e autorizar outros a usar, reproduzir ou editar qualquer um de seus Comentários em qualquer e todas as formas, formatos e mídias.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Criação de links para nosso conteúdo:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('As seguintes organizações podem criar links para nosso Site sem a necessidade de aprovação prévia por escrito:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('Agências governamentais;')}}</li>
                  <li>{{ __('Mecanismos de busca;')}}</li>
                  <li>{{ __('Organizações de mídia;')}}</li>
                  <li>{{ __('Distribuidores de diretórios online podem inserir links para nosso Site na mesma maneira que inserem hiperlinks para Sites de outras empresas listadas; e')}}</li>
                  <li>{{ __('Empresas credenciadas, exceto organizações angariantes sem fins lucrativos e grupos de arrecadação de fundos para instituições de caridade, que não podem inserir links para nosso Site sem aprovação prévia. Essas organizações podem postar links para nossa página inicial, nossas publicações ou outras informações do Site, contanto que o link: (a) não seja, de forma alguma, enganoso; (b) não insinue falsamente a existência de uma relação de patrocínio, endosso, ou aprovação nossa a produtos e/ou serviços; e (c) seja apropriado ao contexto em que está sendo inserido.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('Nós podemos considerar e aprovar solicitações de link feitas pelos seguintes tipos de organizações:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('fontes de informação bem conhecidas sobre produtos e negócios;')}}</li>
                  <li>{{ __('sites comunitários ponto.com;')}}</li>
                  <li>{{ __('associações e outros grupos que representem instituições de caridade;')}}</li>
                  <li>{{ __('distribuidores de diretórios online;')}}</li>
                  <li>{{ __('portais de internet;')}}</li>
                  <li>{{ __('firmas de contabilidade, advocacia e consultoria; e')}}</li>
                  <li>{{ __('instituições educacionais e associações de classe.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('Nós vamos aprovar solicitações de link feitas pelos tipos de organização listados acima se julgarmos que: (a) o link não é desfavorável para nossa imagem e/ou para a imagem de empresas credenciadas; (b) a organização solicitante não possui histórico negativo conosco; (c) o benefício que ganhamos com a visibilidade do link compensa a ausência do Sigma; e (d) o link será inserido em um contexto geral informativo.')}}
                </p>
                <p class="terms">
                  {{ __('Essas organizações podem postar links para nossa página inicial contanto que o link: (a) não seja, de forma alguma, enganoso; (b) não insinue falsamente a existência de uma relação de patrocínio, endosso, ou aprovação de produtos e/ou serviços da nossa parte; e (c) seja apropriado ao contexto em que está sendo inserido.')}}
                </p>
                <p class="terms">
                  {{ __('Se você representa uma das organizações listadas no parágrafo 2 acima e está interessado em postar um link para nosso site, você deve nos informar de seu interesse enviando um e-mail para Sigma. Por favor, inclua seu some, o nome da sua organização e suas informações de contato, assim como a URL do seu site, uma lista das URLs do nosso site que você pretende usar como links, e uma lista dos sites nos quais você pretende publicar nossas URLs. Aguarde entre 2 e 3 semanas para receber uma resposta.')}}
                </p>
                <p class="terms">
                  {{ __('Organizações aprovadas poderão publicar links para nosso Site das seguintes formas:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('Usando nosso nome corporativo; ou')}}</li>
                  <li>{{ __('Usando a URL para onde o link redireciona; ou')}}</li>
                  <li>{{ __('Usando qualquer outra descrição do nosso Site que faça sentido dentro do contexto e do formato do conteúdo onde o link está sendo inserido.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('Não será permitido o uso ou a publicação de links para o logo e/ou outros elementos visuais da Sigma sem um acordo de licença para o uso da marca registrada.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Responsabilização pelo Conteúdo:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('Não seremos responsabilizados legalmente por qualquer conteúdo que apareça no seu Site. Você concorda em nos proteger e nos defender contra todas as acusações que forem levantadas no seu Site. Nenhum link deve aparecer em qualquer Site que possa ser interpretado como difamatório, obsceno, criminoso, ou que infrinja, viole ou defenda a violação dos direitos de terceiros.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Reserva de Direitos:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('Reservamos nosso direito de solicitar que você remova todos os links ou quaisquer links que redirecionem para nosso site. Você concorda em remover imediatamente todos os links para nosso site assim que a remoção for solicitada. Também reservamos nosso direito de corrigir e alterar estes termos e condições a qualquer momento. Ao publicar continuadamente links para nosso site, você concorda a seguir estes termos e condições sobre links.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Remoção de links postados em nosso site:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('Se você encontrar qualquer link em nosso Site que seja de qualquer forma ofensivo, você tem a liberdade de entrar em contato conosco e nos informar do problema a qualquer momento. Vamos considerar as solicitações de remoção de links, mas não somos obrigados a remover quaisquer links do nosso site nem a responder diretamente à sua solicitação.')}}
                </p>
                <p class="terms">
                  {{ __('Nós não garantimos que as informações continas neste site são corretas. Nós não garantimos integralidade ou exatidão do conteúdo. Não garantimos que o site se manterá disponível ou que o material do site se manterá atualizado.')}}
                </p>
                <p class="terms">
                  <strong>{{ __('Declaração de Isenção de Responsabilidade:')}}</strong>
                </p>
                <p class="terms">
                  {{ __('No máximo possível permitido por lei, nós excluímos todas as representações, garantias e condições relativas ao nosso site e ao uso deste site. Nada nesta declaração de isenção de responsabilidade vai:')}}
                </p>
                <ul class="term-list">
                  <li>{{ __('limitar ou excluir nossa responsabilidade ou sua responsabilidade por mortes ou danos pessoais;')}}</li>
                  <li>{{ __('limitar ou excluir nossa responsabilidade ou sua responsabilidade por fraudes ou deturpações fraudulentas;')}}</li>
                  <li>{{ __('limitar nossa responsabilidade ou sua responsabilidade de quaisquer maneiras que não forem permitidas sob a lei; excluir quaisquer responsabilidades suas ou nossas que não podem ser excluídas de acordo com a lei aplicável.')}}</li>
                </ul>
                <p class="terms">
                  {{ __('As limitações e proibições de responsabilização listadas nesta Seção e em outras partes desta declaração: (a) estão sujeitas ao parágrafo anterior; e (b) regem todas as responsabilizações que surgirem sob a declaração, incluindo responsabilizações surgidas em contrato, em delitos e em quebra de obrigações legais.')}}
                </p>
                <p class="terms">
                  {{ __('Enquanto o site e as informações e serviços do site forem oferecidos gratuitamente, nós não seremos responsáveis por perdas e danos de qualquer natureza.')}}
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
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
              <img class="logo my-3" src="/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
              <p>
                {{ __('Plataforma WEB com informações a respeito da cultura paulistana, indicações de locais da cidade e eventos que ocorrerão') }}
              </p>
              <p class="text-blue my-3">
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
    </div>
  </div>
</nav>

<script>
  $('#modalTerms').appendTo("body");
  $('#modalAbout').appendTo("body");
</script>

@else
<nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
  <div class="container">
    <a href="{{ route('home', app()->getLocale()) }}">
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
              <a href="{{ route(Route::currentRouteName(), 'pt') }}" id="pt-br">
                <i class="icon-brazil"></i>
                PT-BR
              </a>
            </li>
            <li class="english user">
              <a href="{{ route(Route::currentRouteName(), 'en') }}" id="en-us">
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
@endif