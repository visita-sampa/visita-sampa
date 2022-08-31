<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Denúncias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="/assets/css/style.css" rel="stylesheet" />
    <link href="/assets/css/adminReport.css" rel="stylesheet" />
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
        </div>
      </nav>
    </header>

    <div class="w-100 d-flex justify-content-center">
      <nav class="nav-bottom position-fixed">
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="icon-alert-triangle" data-bs-toggle="tooltip" data-bs-placement="top" title="Denúncias"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('explore', app()->getLocale()) }}">
              <i class="icon-globe" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Explorar') }}"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('event', app()->getLocale()) }}">
              <i class="icon-map-pin" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Eventos') }}"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('adminEvents', app()->getLocale()) }}">
              <i class="icon-edit-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Criar Evento"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>

    <main class="">
      <div class="container" id="post-container">
        <h1 class="title">Denúncias</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="report-tab" data-bs-toggle="tab" data-bs-target="#report" type="button" role="tab" aria-controls="report" aria-selected="true">Denúncias</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="report-accept-tab" data-bs-toggle="tab" data-bs-target="#report-accept" type="button" role="tab" aria-controls="report-accept" aria-selected="false">Denúncias Aceitas</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="report-refuse-tab" data-bs-toggle="tab" data-bs-target="#report-refuse" type="button" role="tab" aria-controls="report-refuse" aria-selected="false">Denúncias Recusadas</button>
          </li>
        </ul>
        <div class="tab-content denounce" id="myTabContent">
          <!-- Ativos -->
          <div class="tab-pane fade show active" id="report" role="tabpanel" aria-labelledby="report-tab">
            <div class="card" id="card">
              <div class="card-body d-flex">
                <div class="rounded-circle position-relative">
                  <img src="/img/users/profileDefault.png" alt="" class="profile-img rounded-circle" />
                </div>
                <div class="card-content">
                  <div class="card-infos">
                    <h5 class="card-title">Nome usuário</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Ponto Turístico</h6>
                    <span class="badge badge-pill badge-report" id="badge-report">1</span>
                  </div>
                  <div class="card-buttons">
                    <button type="button" class="btn btn-accept"><i class="icon-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Aceitar denúncia"></i></button>
                    <button type="button" class="btn btn-refuse"><i class="icon-x" data-bs-toggle="tooltip" data-bs-placement="top" title="Rejeitar denúncia"></i></button>
                  </div>
                </div>
              </div>
              <div class="card-description" id="card-description">
                <!-- Informações Ocultadas -->
                <div class="card-text">
                  Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker
                  <div class="report">
                    <div class="report-dialog">
                      <div class="report-content">
                        <div class="report-body">
                          <div class="report-image">
                            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/18/99/d8/ed/paulista.jpg?w=1200&h=-1&s=1" class="img-publication" alt="" />
                          </div>
                          <!-- Informações Usuário -->
                          <div class="report-header">
                            <div class="user">
                              <div class="user-image">
                                <img src="/img/users/profileDefault.png" alt="Foto de Perfil do Usuário" />
                              </div>
                              <div class="user-information">
                                <p class="user-name">
                                  Nome Usuário
                                </p>
                                <p class="user-localization">
                                  Avenida Paulista
                                </p>
                              </div>
                            </div>
                          </div>
                          <!-- Comentário Publicação -->
                          <div class="comment-publication">
                            <div class="comment">
                              <div class="user">
                                <div class="user-image">
                                  <img src="/img/users/profileDefault.png" alt="Foto de Perfil do Usuário" />
                                </div>
                              </div>
                              <p class="user-comment">
                                <span class="name-comment">Nome Usuário</span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur metus id eros tincidunt, eu pellentesque risus consequat. Donec convallis sem sit amet dolor ornare luctus. Aliquam dapibus leo eu faucibus porttitor.
                              </p>
                            </div>
                            <p class="post-date">
                              Há 11 dias
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-muted d-flex justify-content-end align-items-center">
                <button id="btn-see-more">Ver Mais <i class="icon-chevron-down p-1"></i></button>
              </div>
            </div>
          </div>
          <!-- Denúncias aceitas -->
          <div class="tab-pane fade" id="report-accept" role="tabpanel" aria-labelledby="report-accept-tab">
            <div class="card" id="card">
              <div class="card-body d-flex">
                <div class="rounded-circle position-relative">
                  <img src="/img/users/profileDefault.png" alt="" class="profile-img rounded-circle" />
                </div>
                <div class="card-content">
                  <div class="card-infos">
                    <h5 class="card-title">Nome usuário</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Ponto Turístico</h6>
                    <span class="badge badge-pill badge-report" id="badge-report">1</span>
                  </div>
                  <div class="card-buttons">
                    <button type="button" class="btn btn-accept"><i class="icon-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Aceitar denúncia"></i></button>
                    <button type="button" class="btn btn-refuse"><i class="icon-x" data-bs-toggle="tooltip" data-bs-placement="top" title="Rejeitar denúncia"></i></button>
                  </div>
                </div>
              </div>
              <div class="card-description" id="card-description">
                <!-- Informações Ocultadas -->
                <div class="card-text">
                  Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker
                  <div class="report">
                    <div class="report-dialog">
                      <div class="report-content">
                        <div class="report-body">
                          <div class="report-image">
                            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/18/99/d8/ed/paulista.jpg?w=1200&h=-1&s=1" class="img-publication" alt="" />
                          </div>
                          <!-- Informações Usuário -->
                          <div class="report-header">
                            <div class="user">
                              <div class="user-image">
                                <img src="/img/users/profileDefault.png" alt="Foto de Perfil do Usuário" />
                              </div>
                              <div class="user-information">
                                <p class="user-name">
                                  Nome Usuário
                                </p>
                                <p class="user-localization">
                                  Avenida Paulista
                                </p>
                              </div>
                            </div>
                          </div>
                          <!-- Comentário Publicação -->
                          <div class="comment-publication">
                            <div class="comment">
                              <div class="user">
                                <div class="user-image">
                                  <img src="/img/users/profileDefault.png" alt="Foto de Perfil do Usuário" />
                                </div>
                              </div>
                              <p class="user-comment">
                                <span class="name-comment">Nome Usuário</span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur metus id eros tincidunt, eu pellentesque risus consequat. Donec convallis sem sit amet dolor ornare luctus. Aliquam dapibus leo eu faucibus porttitor.
                              </p>
                            </div>
                            <p class="post-date">
                              Há 11 dias
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-muted d-flex justify-content-end align-items-center">
                <button id="btn-see-more">Ver Mais <i class="icon-chevron-down p-1"></i></button>
              </div>
            </div>
          </div>
          <!-- Denúncias recusadas -->
          <div class="tab-pane fade" id="report-refuse" role="tabpanel" aria-labelledby="report-refuse-tab">
            <div class="card" id="card">
              <div class="card-body d-flex">
                <div class="rounded-circle position-relative">
                  <img src="/img/users/profileDefault.png" alt="" class="profile-img rounded-circle" />
                </div>
                <div class="card-content">
                  <div class="card-infos">
                    <h5 class="card-title">Nome usuário</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Ponto Turístico</h6>
                    <span class="badge badge-pill badge-report" id="badge-report">11</span>
                  </div>
                  <div class="card-buttons">
                    <button type="button" class="btn btn-accept"><i class="icon-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Aceitar denúncia"></i></button>
                    <button type="button" class="btn btn-refuse"><i class="icon-x" data-bs-toggle="tooltip" data-bs-placement="top" title="Rejeitar denúncia"></i></button>
                  </div>
                </div>
              </div>
              <div class="card-description" id="card-description">
                <!-- Informações Ocultadas -->
                <div class="card-text">
                  Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker
                  <div class="report">
                    <div class="report-dialog">
                      <div class="report-content">
                        <div class="report-body">
                          <div class="report-image">
                            <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/18/99/d8/ed/paulista.jpg?w=1200&h=-1&s=1" class="img-publication" alt="" />
                          </div>
                          <!-- Informações Usuário -->
                          <div class="report-header">
                            <div class="user">
                              <div class="user-image">
                                <img src="/img/users/profileDefault.png" alt="Foto de Perfil do Usuário" />
                              </div>
                              <div class="user-information">
                                <p class="user-name">
                                  Nome Usuário
                                </p>
                                <p class="user-localization">
                                  Avenida Paulista
                                </p>
                              </div>
                            </div>
                          </div>
                          <!-- Comentário Publicação -->
                          <div class="comment-publication">
                            <div class="comment">
                              <div class="user">
                                <div class="user-image">
                                  <img src="/img/users/profileDefault.png" alt="Foto de Perfil do Usuário" />
                                </div>
                              </div>
                              <p class="user-comment">
                                <span class="name-comment">Nome Usuário</span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur metus id eros tincidunt, eu pellentesque risus consequat. Donec convallis sem sit amet dolor ornare luctus. Aliquam dapibus leo eu faucibus porttitor.
                              </p>
                            </div>
                            <p class="post-date">
                              Há 11 dias
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-muted d-flex justify-content-end align-items-center">
                <button id="btn-see-more">Ver Mais <i class="icon-chevron-down p-1"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="/assets/js/jquery.slim.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/assets/js/adminReport.js"></script>
    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    </script>
  </body>
</html>
