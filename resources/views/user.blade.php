<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Meu Perfil') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/user.css" rel="stylesheet" />
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
    <nav class="nav-bottom position-fixed">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('feed', app()->getLocale()) }}">
            <i class="icon-image" data-bs-toggle="tooltip" data-bs-placement="top" title="Feed"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user', app()->getLocale()) }}">
            <i class="icon-user" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Perfil') }}"></i>
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
          <a class="nav-link" href="{{ route('quiz', app()->getLocale()) }}">
            <i class="icon-edit-3" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Teste de Personalidade') }}"></i>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <main class="profile-page">
    <section class="profile d-flex justify-content-center m-5">
      @Auth
      <div class="profile-container d-flex">
        <div class="rounded-circle position-relative">
          <img src="{{ $user->foto_perfil == '' ? '/img/users/profileDefault.png' : $user->foto_perfil}}" alt="" class="profile-img rounded-circle" />
        </div>
        <div class="bio">
          <h3>{{$user->nome}}</h3>
          <h4>&#64;{{$user->nome_usuario}}</h4>
          <p>{{$user->descricao}}</p>
          <div class="bio-footer d-grid">
            <span>{{ __('Tipo de perfil') }}</span>
            @csrf @if(!$profile->isEmpty()) @foreach ($profile as $prof)
            <strong><span>{{$prof->nome_classificacao}}</span></strong>
            @endforeach @else
            <strong><span>-</span></strong>
            @endif
            <span>
              @if($user->nome_usuario == Auth::user()->nome_usuario)
              {{ __('Minhas publicações') }}
              @else
              {{ __('Publicações')  }}
              @endif
            </span>
            @if($publications)
            <strong><span>{{$publications->count()}}</span></strong>
            @else
            <strong><span>-</span></strong>
            @endif
          </div>
        </div>
      </div>
      @endAuth
    </section>
    <section class="posts d-grid justify-content-center" id="post-container">
      @include('userPublication')
    </section>
    <div class="ajax-load text-center">
      <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Carregando...</span>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="liveToastBtn">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        @if(session('msgUpdateProfileSuccess') || session('msgUpdatePostSuccess') || session('msgDeletePostSuccess'))
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          Sucesso
        </strong>
        @elseif(session('msgPasswordComparisonFailed') || session('msgUnfilledPasswordFields') || session('msgInvalidCurrentPassword') || session('msgUpdateProfileFail') || session('msgUpdatePostFail') || session('msgDeletePostFail'))
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          Falha
        </strong>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        @if(session('msgUpdateProfileSuccess'))
        {{ session('msgUpdateProfileSuccess') }}

        @elseif(session('msgUpdatePostSuccess'))
        {{ session('msgUpdatePostSuccess') }}

        @elseif(session('msgDeletePostSuccess'))
        {{ session('msgDeletePostSuccess') }}

        @elseif(session('msgPasswordComparisonFailed'))
        {{ session('msgPasswordComparisonFailed') }}

        @elseif(session('msgUnfilledPasswordFields'))
        {{ session('msgUnfilledPasswordFields') }}

        @elseif(session('msgInvalidCurrentPassword'))
        {{ session('msgInvalidCurrentPassword') }}

        @elseif(session('msgUpdateProfileFail'))
        {{ session('msgUpdateProfileFail') }}

        @elseif(session('msgUpdatePostFail'))
        {{ session('msgUpdatePostFail') }}

        @elseif(session('msgDeletePostFail'))
        {{ session('msgDeletePostFail') }}

        @endif
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-primary d-none" id="toastBtnDeletePostSuccess">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastDeletePostSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-success">
          <i class="icon-check"></i>
          Sucesso
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
      Sua publicação foi excluída permanentemente
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-primary d-none" id="toastBtnDeletePostFail">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastDeletePostFail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-danger">
          <i class="icon-x"></i>
          Falha
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
      Não foi possível excluir a publicação. Tente novamente
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg imagecrop" id="model" tabindex="-1" role="dialog" aria-labelledby="modalCropProfilePic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cortar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-md-11">
                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" class="d-block mw-100">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelCrop">Cancelar</button>
          <button type="button" class="btn btn-primary crop" id="crop">Cortar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
     function deletePublication(id) {
      $.ajax({
        url: "{{ route('delete.publication', app()->getLocale()) }}",
        type: 'GET',
        data: {
          'id': id
        },
      })
      .done((response) => {
        if(response) {
          $('.close').click();

          $(document).ready(function() {
            $("#toastBtnDeletePostSuccess").click();
          });

          $(`#post-${id}`).remove();
        }
        else {
          $('.close').click();

          $(document).ready(function() {
            $("#toastBtnDeletePostFail").click();
          });
        }
      });
    }
  </script>

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/user.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

  <script>
    var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );

  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

    @if(session('msgUpdateProfileSuccess') || session('msgUpdatePostSuccess') || session('msgDeletePostSuccess') || session('msgPasswordComparisonFailed') || session('msgUnfilledPasswordFields') || session('msgInvalidCurrentPassword') || session('msgUpdateProfileFail') || session('msgUpdatePostFail') || session('msgDeletePostFail'))
    $(document).ready(function() {
      $("#liveToastBtn").click();
    });
    @endif

    $(document).ready(function() {
      $('#floatingUsername').on('focusout', function() {
        var value = $(this).val();
        $('#btn-submit').addClass("disabled");

        let msg = document.getElementById("msgUsername");
        if (msg) usernameContent.removeChild(msg);
        if (value === "") {
          msgAlert(usernameContent, "Campo obrigatório", "msgUsername");
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
                usernameContent.removeChild(msg);;
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
                usernameContent.removeChild(msg);
            } else {
              msgAlert(usernameContent,'Nome já utilizado','msgUsername');
              usernameFlag = false;
            }
          })
      });
    });
  </script>
</body>

</html>