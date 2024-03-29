<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Criar Eventos') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
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
    @include('nav')
  </header>

  <div class="w-100 d-flex justify-content-center">
    @include('navbar')
  </div>

  <main class="margin-fixed">
    <div class="container" id="post-container">
      <div class="added-events">
        <div class="new-event">
          <h1 class="title">{{ __('Eventos') }}</h1>
          <div class="add-event">
            <a class="more-event" data-toggle="modal" data-target="#modalCreateEvent" href="">
              <i class="icon-plus"></i>
              <h5>{{ __('Novo Evento') }}</h5>
            </a>
          </div>
        </div>
        <div class="grid-container" id="event-container">
          @include('adminEventDivulgation')
        </div>
        <div class="ajax-load text-center">
          <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">{{ __("Carregando") }}...</span>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalCreateEvent" tabindex="-1" role="dialog" aria-labelledby="modalCreateEventTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCreateEventTitle">{{ __("Novo Evento") }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <!-- <span aria-hidden="true">&times;</span> -->
                </button>
              </div>
              <div class="modal-body">
                <div class="infos">
                  <form method="POST" action="{{ route('adminEvents.store', app()->getLocale()) }}">
                    @csrf
                    <label class="input-event picture" for="picture__input" tabIndex="0" id="img-preview">
                      <span class="picture__image"></span>
                    </label>
                    <input type="file" name="picture__input" id="picture__input" class="image-upload-event">
                    <input type="hidden" name="base64data" id="base64data">
                    <input class="input-event event-name" type="text" name="event_name" id="event_name" placeholder="{{ __('Nome do Evento') }}" autocomplete="off" required>
                    <input class="input-event cep" type="text" id="event_cep" name="event_cep" data-js="cep" placeholder="CEP" required>
                    <input class="input-event road" type="text" id="event_road" name="event_road" placeholder="{{ __('Logradouro') }}" readonly>
                    <input class="input-event district" type="text" id="event_district" name="event_district" placeholder="{{ __('Bairro') }}" readonly>
                    <input class="input-event number" name="event_number" id="event_number" type="text" placeholder="{{ __('Número') }}">
                    <input class="input-event complement" name="event_complement" id="event_complement" type="text" placeholder="{{ __('Complemento') }}">
                    <input class="input-event date" name="event_date" id="event_date" type="date" placeholder="{{ __('Data') }}" required>
                    <input class="input-event link" name="event_link" id="event_link" type="text" placeholder="{{ __('Link Evento') }}">
                    <button type="submit" class="btn btn-secondary mt-2 me-1 float-end">{{ __('Cadastrar') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade bd-example-modal-lg imagecrop" id="model" tabindex="-1" role="dialog" aria-labelledby="modalCropProfilePic" aria-hidden="true">
          <div class="modal-dialog modal-lg d-flex justify-content-center">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __("Cortar") }}</h5>
                <button type="button" class="btn-close cancel-crop" data-bs-dismiss="modal" aria-label="Close">
                  <!-- <span aria-hidden="true">&times;</span> -->
                </button>
              </div>
              <div class="modal-body">
                <div class="img-container">
                  <div class="row justify-content-center w-100 mx-0">
                    <div class="col-md-11 p-0">
                      <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" class="d-block mw-100">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel-crop" data-bs-dismiss="modal" id="cancelCrop">{{ __("Cancelar") }}</button>
                <button type="button" class="btn btn-primary crop" id="crop">{{ __("Cortar") }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="toastBtnDeleteEventSuccess">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastDeleteEventSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          {{ __("Sucesso") }}
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ __("O evento foi excluído permanentemente") }}
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-primary d-none" id="toastBtnDeleteEventFail">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastDeleteEventFail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          {{ __("Falha") }}
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ __("Não foi possível excluir o evento") }}
      </div>
    </div>
  </div>

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/adminEvents.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    function deleteEvent(id) {
      $.ajax({
          url: "{{ route('delete.event', app()->getLocale()) }}",
          type: 'GET',
          data: {
            'id': id
          },
        })
        .done((response) => {
          if (response) {
            $('.close-confirmation').click();

            $(document).ready(function() {
              $("#toastBtnDeleteEventSuccess").click();
            });

            $(`#event-${id}`).remove();
          } else {
            $('.close-confirmation').click();

            $(document).ready(function() {
              $("#toastBtnDeleteEventFail").click();
            });
          }
        });
    }

    function loadMoreData(page) {
      $.ajax({
          url: '?page=' + page,
          type: 'get',
          beforeSend: function() {
            $('.ajax-load').show();
          }
        })
        .done(function(eventDivulgation) {
          if (eventDivulgation.html == "") {
            $('.ajax-load').html('{{ __("Nenhum outro evento encontrado") }}');
            return;
          }
          $('.ajax-load').hide();
          $('#event-container').append(eventDivulgation.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          alert("{{ __('Servidor não está respondendo') }}...");
        });
    }

    var page = 1;
    $(window).scroll(function() {
      if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
      }
    });
    const pictureImage = document.querySelector(".picture__image");
    const pictureImageTxt = '{ __("Escolha uma imagem") }}';
    pictureImage.innerHTML = pictureImageTxt;
  </script>
  <script>
    const langOptions = document.getElementById('for-dropdown-translate');
    const ulLangOptions = document.getElementById('translate');
    let open = false;

    langOptions.addEventListener('click', () => {
      if (open) {
        ulLangOptions.classList.remove('open');
        langOptions.classList.remove('active');
        open = false;
      } else {
        ulLangOptions.classList.add('open');
        langOptions.classList.add('active');
        open = true;
      }
    })
  </script>

</body>

</html>