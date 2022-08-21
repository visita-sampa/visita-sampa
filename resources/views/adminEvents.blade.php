<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Criar Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="/assets/css/style.css" rel="stylesheet" />
    <link href="/assets/css/adminEvent.css" rel="stylesheet" />
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
            <a class="nav-link" href="#">
              <i class="icon-edit-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Criar Evento"></i>
            </a>
          </li>
        </ul>
      </nav>
    </div>

    <main class="">
      <div class="container" id="post-container">
        <div class="added-events">
          <div class="teste">
            <h1 class="title">Eventos</h1>
            <div class="add-event">
              <a class="more-event" data-toggle="modal" data-target="#exampleModalCenter" href="">
                <i class="icon-plus"></i>
                <h5>Novo Evento</h5>
              </a>
            </div>
          </div>
          <div class="grid-container">
            <div class="grid-item">
              <div class="local-image">
                <img src="https://imagens.imirante.com.br/imagens/noticias/2022/05/16/breY56wytWpi4PJRJvGBeYLdAiiZGJV9GSIIKWqf.jpg?w=896&h=448&crop=984%2C+492%2C+0%2C+33.575916230367&fit=crop&fm=webp&s=0fabb79aef132a7edd2c3267d361fc6c" class="card-img-top" alt="Nome Evento" />
              </div>
              <div class="card-body">
                <h5 class="card-title">Nome evento</h5>
                <div class="card-text">
                  <p class="localization"><i class="icon-map-pin two"></i>Local Evento</p>
                  <p class="time"><i class="icon-clock"></i>Data Evento</p>
                </div>
              </div>
              <div class="btn-delete-event">
                <input type="button" class="btn-delete" value="Excluir"></input>
              </div>
            </div>

            <div class="grid-item">
              <div class="local-image">
                <img src="https://imagens.imirante.com.br/imagens/noticias/2022/05/16/breY56wytWpi4PJRJvGBeYLdAiiZGJV9GSIIKWqf.jpg?w=896&h=448&crop=984%2C+492%2C+0%2C+33.575916230367&fit=crop&fm=webp&s=0fabb79aef132a7edd2c3267d361fc6c" class="card-img-top" alt="Nome Evento" />
              </div>
              <div class="card-body">
                <h5 class="card-title">Nome evento</h5>
                <div class="card-text">
                  <p class="localization"><i class="icon-map-pin two"></i>Local Evento</p>
                  <p class="time"><i class="icon-clock"></i>Data Evento</p>
                </div>
              </div>
              <div class="btn-delete-event">
                <input type="button" class="btn-delete" value="Excluir"></input>
              </div>
            </div>

            <div class="grid-item">
              <div class="local-image">
                <img src="https://imagens.imirante.com.br/imagens/noticias/2022/05/16/breY56wytWpi4PJRJvGBeYLdAiiZGJV9GSIIKWqf.jpg?w=896&h=448&crop=984%2C+492%2C+0%2C+33.575916230367&fit=crop&fm=webp&s=0fabb79aef132a7edd2c3267d361fc6c" class="card-img-top" alt="Nome Evento" />
              </div>
              <div class="card-body">
                <h5 class="card-title">Nome evento</h5>
                <div class="card-text">
                  <p class="localization"><i class="icon-map-pin two"></i>Local Evento</p>
                  <p class="time"><i class="icon-clock"></i>Data Evento</p>
                </div>
              </div>
              <div class="btn-delete-event">
                <input type="button" class="btn-delete" value="Excluir"></input>
              </div>
            </div>

            <div class="grid-item">
              <div class="local-image">
                <img src="https://imagens.imirante.com.br/imagens/noticias/2022/05/16/breY56wytWpi4PJRJvGBeYLdAiiZGJV9GSIIKWqf.jpg?w=896&h=448&crop=984%2C+492%2C+0%2C+33.575916230367&fit=crop&fm=webp&s=0fabb79aef132a7edd2c3267d361fc6c" class="card-img-top" alt="Nome Evento" />
              </div>
              <div class="card-body">
                <h5 class="card-title">Nome evento</h5>
                <div class="card-text">
                  <p class="localization"><i class="icon-map-pin two"></i>Local Evento</p>
                  <p class="time"><i class="icon-clock"></i>Data Evento</p>
                </div>
              </div>
              <div class="btn-delete-event">
                <button type="button" class="btn-delete" data-toggle="modal" data-target="#deleteEvent">Excluir</button>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Novo Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="infos">
                      <form action="">
                        <label class="picture" for="picture__input" tabIndex="0">
                          <span class="picture__image"></span>
                        </label>
                        <input type="file" name="picture__input" id="picture__input">
                        <input class="event-name" type="text" placeholder="Nome do Evento" autocomplete="off">
                        <input class="cep" type="text" placeholder="CEP">
                        <input class="road" type="text" placeholder="Logradouro">
                        <input class="district" type="text" placeholder="Bairro">
                        <input class="number" type="text" placeholder="Número">
                        <input class="complement" type="text" placeholder="Complemento">
                        <input class="date" type="date" placeholder="Data">
                        <input class="link" type="text" placeholder="Link Evento">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary">Salvar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog" aria-labelledby="deleteEventTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content delete">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventLongTitle">Excluir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body delete">
                    Tem certeza que deseja excluir esse evento?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary delete">Excluir</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="/assets/js/jquery.slim.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/assets/js/adminEvents.js"></script>
    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    </script>
  </body>
</html>
