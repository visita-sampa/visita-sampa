<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Feed</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/feed.css" rel="stylesheet" />
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
      @if(!empty($publications))
      @include('feedPublication')
      @else
      <div class="warning">
        <h3>{{ __('Não há publicações para esse perfil!') }}</h3>
        <i class="icon-alert-triangle two"></i>
      </div>
      @endif
    </div>
    <div class="ajax-load text-center">
      <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">{{ __('Carregando') }}...</span>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="toastBtnReportSuccess">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastReportSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          Sucesso
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ __('A publicação foi reportada') }}
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-primary d-none" id="toastBtnReportFail">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastReportFail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          {{ __('Falha') }}
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ __('Não foi possível reportar a publicação') }}
      </div>
    </div>
  </div>

  @include('cropProfilePic')

  <script src="/assets/js/bootstrap.min.js"></script>
  <!-- <script src="/assets/js/main.js"></script> -->
  <script src="/assets/js/feed.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    $(function() {
      $('form[name="formReport"]').submit(function() {
        event.preventDefault();

        $.ajax({
          url: "{{ route('publication.report', app()->getLocale()) }}",
          type: "post",
          data: $(this).serialize(),
          dataType: 'json',
          success: function(response) {
            if (response) {
              $('.close-all').click();

              $(document).ready(function() {
                $("#toastBtnReportSuccess").click();
              });
            } else {
              $('.close-all').click();

              $(document).ready(function() {
                $("#toastBtnReportFail").click();
              });
            }
            document.querySelectorAll('.motive-denounces').forEach(element => {
              element.value = ""
            })
          }
        });
      });
    });

    function loadMoreData(page) {
      $.ajax({
          url: '?page=' + page,
          type: 'get',
          beforeSend: function() {
            $('.ajax-load').show();
          }
        })
        .done(function(feedPublication) {
          if (feedPublication.html == "") {
            $('.ajax-load').html("{{ __(('Nenhuma outra publicação encontrada')) }}");
            return;
          }
          $('.ajax-load').hide();
          $('#post-container').append(feedPublication.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          alert("Servidor não está respondendo...");
        });
    }

    var page = 1;
    $(window).scroll(function() {
      if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++;
        loadMoreData(page);
      }
    });
  </script>

  <script src="/assets/js/main.js"></script>

</body>

</html>