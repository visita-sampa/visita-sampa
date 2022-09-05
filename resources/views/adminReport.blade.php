<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Denúncias') }}</title>
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
    @include('nav')
  </header>

  <div class="w-100 d-flex justify-content-center">
    @include('navbar')
  </div>

  <main class="">
    <div class="container" id="post-container">
      <h1 class="title">{{ __('Denúncias') }}</h1>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="report-tab" data-bs-toggle="tab" data-bs-target="#report" type="button" role="tab" aria-controls="report" aria-selected="true">{{ __('Denúncias') }}</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="report-accept-tab" data-bs-toggle="tab" data-bs-target="#report-accept" type="button" role="tab" aria-controls="report-accept" aria-selected="false">{{ __('Denúncias Aceitas') }}</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="report-refuse-tab" data-bs-toggle="tab" data-bs-target="#report-refuse" type="button" role="tab" aria-controls="report-refuse" aria-selected="false">{{ __('Denúncias Recusadas') }}</button>
        </li>
      </ul>
      <div class="tab-content denounce" id="myTabContent">
        <!-- Ativos -->
        <div class="tab-pane fade show active" id="report" role="tabpanel" aria-labelledby="report-tab">
          @if(empty($postReported))
          <div class="warning d-flex flex-column align-items-center mt-3 text-center">
            <i class="icon-alert-triangle two my-2"></i>
            <h3>{{ __('No momento não há denúncia para serem avaliadas') }}</h3>
          </div>
          @else
          @foreach($postReported as $post)
          <div class="card" id="card-report-noreply-{{ $post->id_publicacao }}">
            <div class="card-body d-flex">
              <div class="rounded-circle position-relative">
                <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="" class="profile-img rounded-circle" />
              </div>
              <div class="card-content">
                <div class="card-infos">
                  <div class="d-flex py-2 align-items-center reported-close-info">
                    <h5 class="card-title m-0">{{ $post->nome }}</h5>
                    <span class="text-muted mx-2">&#64;{{ $post->nome_usuario }}</span>
                  </div>
                  <h6 class="card-subtitle mb-2 text-muted">{{ $post->nome_ponto_turistico }}</h6>
                  @php
                  $cont = 0;
                  @endphp

                  @foreach($complaints as $report)
                  @if($report->fk_publicacao_id_publicacao == $post->id_publicacao)
                  @php
                  $cont++
                  @endphp
                  @endif
                  @endforeach
                  <span class="badge badge-pill badge-report" id="badge-report">{{ $cont }}</span>
                </div>
                <div class="card-buttons">
                  <button type="button" class="btn btn-accept" id="btn-accept-report-noreply-{{ $post->id_publicacao }}" onclick="acceptComplaint({{ $post->id_publicacao }}, 'noreply')"><i class="icon-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Aceitar denúncia"></i></button>
                  <button type="button" class="btn btn-refuse" id="btn-refuse-report-noreply-{{ $post->id_publicacao }}" onclick="refuseComplaint({{ $post->id_publicacao }}, 'noreply')"><i class="icon-x" data-bs-toggle="tooltip" data-bs-placement="top" title="Rejeitar denúncia"></i></button>
                </div>
              </div>
            </div>
            <div class="card-description" id="card-description">
              <!-- Informações Ocultadas -->
              <div class="card-text">
                <div class="card w-100">
                  <ul class="list-group list-group-flush">
                    @foreach($complaints as $report)
                    @if($report->fk_publicacao_id_publicacao == $post->id_publicacao)
                    <li class="list-group-item reason">{{ $report->motivo }}</li>
                    @endif
                    @endforeach
                  </ul>
                </div>
                <div class="report">
                  <div class="report-dialog">
                    <div class="report-content">
                      <div class="report-body">
                        <div class="report-image">
                          <img src="{{ $post->midia }}" class="img-publication" alt="" />
                        </div>
                        <!-- Informações Usuário -->
                        <div class="report-header">
                          <div class="user">
                            <div class="user-image">
                              <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="Foto de Perfil do Usuário" />
                            </div>
                            <div class="user-information">
                              <p class="user-name">
                                {{ $post->nome }}
                              </p>
                              <p class="user-localization">
                                {{ $post->nome_ponto_turistico }}
                              </p>
                            </div>
                          </div>
                        </div>
                        <!-- Comentário Publicação -->
                        <div class="comment-publication">
                          <div class="comment">
                            <div class="user">
                              <div class="user-image">
                                <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="Foto de Perfil do Usuário" />
                              </div>
                            </div>
                            <p class="user-comment">
                              <span class="name-comment">{{ $post->nome }}</span>
                              {{ $post->legenda }}
                            </p>
                          </div>
                          <p class="post-date">
                            @if($post->data == 0)
                            {{ __('Há menos de um dia') }}
                            @else
                            {{ __('Há') }} {{ $post->data }} {{ __('dias') }}
                            @endif
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-end align-items-center">
              <button id="btn-see-more">{{ __('Ver Mais') }}<i class="icon-chevron-down p-1"></i></button>
            </div>
          </div>
          @endforeach
          @endif
        </div>
        <!-- Denúncias aceitas -->
        <div class="tab-pane fade" id="report-accept" role="tabpanel" aria-labelledby="report-accept-tab">
          @if(empty($postComplaintAccepted))
          <div class="warning d-flex flex-column align-items-center mt-3 text-center">
            <i class="icon-alert-triangle two my-2"></i>
            <h3>{{ __('No momento não há denúncia aceitas') }}</h3>
          </div>
          @else
          @foreach($postComplaintAccepted as $post)
          <div class="card" id="card-report-accept-{{ $post->id_publicacao }}">
            <div class="card-body d-flex">
              <div class="rounded-circle position-relative">
                <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="" class="profile-img rounded-circle" />
              </div>
              <div class="card-content">
                <div class="card-infos">
                  <h5 class="card-title">{{ $post->nome }}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">{{ $post->nome_ponto_turistico }}</h6>
                  @php
                  $cont = 0;
                  @endphp

                  @foreach($complaintAccepted as $report)
                  @if($report->fk_publicacao_id_publicacao == $post->id_publicacao)
                  @php
                  $cont++
                  @endphp
                  @endif
                  @endforeach
                  <span class="badge badge-pill badge-report" id="badge-report">{{ $cont }}</span>
                </div>
                <div class="card-buttons">
                  <button type="button" class="btn btn-accept disabled" id="btn-accept-report-accept-{{ $post->id_publicacao }}" onclick="acceptComplaint({{ $post->id_publicacao }}, 'accept')"><i class="icon-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Aceitar denúncia"></i></button>
                  <button type="button" class="btn btn-refuse" id="btn-refuse-report-accept-{{ $post->id_publicacao }}" onclick="refuseComplaint({{ $post->id_publicacao }}, 'accept')"><i class="icon-x" data-bs-toggle="tooltip" data-bs-placement="top" title="Rejeitar denúncia"></i></button>
                </div>
              </div>
            </div>
            <div class="card-description" id="card-description">
              <!-- Informações Ocultadas -->
              <div class="card-text">
                <div class="card w-100">
                  <ul class="list-group list-group-flush">
                    @foreach($complaintAccepted as $report)
                    @if($report->fk_publicacao_id_publicacao == $post->id_publicacao)
                    <li class="list-group-item reason">{{ $report->motivo }}</li>
                    @endif
                    @endforeach
                  </ul>
                </div>
                <div class="report">
                  <div class="report-dialog">
                    <div class="report-content">
                      <div class="report-body">
                        <div class="report-image">
                          <img src="{{ $post->midia }}" class="img-publication" alt="" />
                        </div>
                        <!-- Informações Usuário -->
                        <div class="report-header">
                          <div class="user">
                            <div class="user-image">
                              <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="Foto de Perfil do Usuário" />
                            </div>
                            <div class="user-information">
                              <p class="user-name">
                                {{ $post->nome }}
                              </p>
                              <p class="user-localization">
                                {{ $post->nome_ponto_turistico }}
                              </p>
                            </div>
                          </div>
                        </div>
                        <!-- Comentário Publicação -->
                        <div class="comment-publication">
                          <div class="comment">
                            <div class="user">
                              <div class="user-image">
                                <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="Foto de Perfil do Usuário" />
                              </div>
                            </div>
                            <p class="user-comment">
                              <span class="name-comment">{{ $post->nome }}</span>
                              {{ $post->legenda }}
                            </p>
                          </div>
                          <p class="post-date">
                            @if($post->data == 0)
                            {{ __('Há menos de um dia') }}
                            @else
                            {{ __('Há') }} {{ $post->data }} {{ __('dias') }}
                            @endif
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-end align-items-center">
              <button id="btn-see-more">{{ __('Ver Mais') }}<i class="icon-chevron-down p-1"></i></button>
            </div>
          </div>
          @endforeach
          @endif
        </div>
        <!-- Denúncias recusadas -->
        <div class="tab-pane fade" id="report-refuse" role="tabpanel" aria-labelledby="report-refuse-tab">
          @if(empty($postComplaintDenied))
          <div class="warning d-flex flex-column align-items-center mt-3 text-center">
            <i class="icon-alert-triangle two my-2"></i>
            <h3>{{ __('No momento não há denúncia recusadas') }}</h3>
          </div>
          @else
          @foreach($postComplaintDenied as $post)
          <div class="card" id="card-report-refuse-{{ $post->id_publicacao }}">
            <div class="card-body d-flex">
              <div class="rounded-circle position-relative">
                <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="" class="profile-img rounded-circle" />
              </div>
              <div class="card-content">
                <div class="card-infos">
                  <h5 class="card-title">{{ $post->nome }}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">{{ $post->nome_ponto_turistico }}</h6>
                  @php
                  $cont = 0;
                  @endphp

                  @foreach($deniedComplaint as $report)
                  @if($report->fk_publicacao_id_publicacao == $post->id_publicacao)
                  @php
                  $cont++
                  @endphp
                  @endif
                  @endforeach
                  <span class="badge badge-pill badge-report" id="badge-report">{{ $cont }}</span>
                </div>
                <div class="card-buttons">
                  <button type="button" class="btn btn-accept" id="btn-accept-report-refuse-{{ $post->id_publicacao }}" onclick="acceptComplaint({{ $post->id_publicacao }}, 'refuse')"><i class="icon-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Aceitar denúncia"></i></button>
                  <button type="button" class="btn btn-refuse disabled" id="btn-refuse-report-refuse-{{ $post->id_publicacao }}" onclick="refuseComplaint({{ $post->id_publicacao }}, 'refuse')"><i class="icon-x" data-bs-toggle="tooltip" data-bs-placement="top" title="Rejeitar denúncia"></i></button>
                </div>
              </div>
            </div>
            <div class="card-description" id="card-description">
              <!-- Informações Ocultadas -->
              <div class="card-text">
                <div class="card w-100">
                  <ul class="list-group list-group-flush">
                    @foreach($deniedComplaint as $report)
                    @if($report->fk_publicacao_id_publicacao == $post->id_publicacao)
                    <li class="list-group-item reason">{{ $report->motivo }}</li>
                    @endif
                    @endforeach
                  </ul>
                </div>
                <div class="report">
                  <div class="report-dialog">
                    <div class="report-content">
                      <div class="report-body">
                        <div class="report-image">
                          <img src="{{ $post->midia }}" class="img-publication" alt="" />
                        </div>
                        <!-- Informações Usuário -->
                        <div class="report-header">
                          <div class="user">
                            <div class="user-image">
                              <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="Foto de Perfil do Usuário" />
                            </div>
                            <div class="user-information">
                              <p class="user-name">
                                {{ $post->nome }}
                              </p>
                              <p class="user-localization">
                                {{ $post->nome_ponto_turistico }}
                              </p>
                            </div>
                          </div>
                        </div>
                        <!-- Comentário Publicação -->
                        <div class="comment-publication">
                          <div class="comment">
                            <div class="user">
                              <div class="user-image">
                                <img src="{{ $post->foto_perfil == '' ? '/img/users/profileDefault.png' : $post->foto_perfil }}" alt="Foto de Perfil do Usuário" />
                              </div>
                            </div>
                            <p class="user-comment">
                              <span class="name-comment">{{ $post->nome }}</span>
                              {{ $post->legenda }}
                            </p>
                          </div>
                          <p class="post-date">
                            @if($post->data == 0)
                            {{ __('Há menos de um dia') }}
                            @else
                            {{ __('Há') }} {{ $post->data }} {{ __('dias') }}
                            @endif
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-end align-items-center">
              <button id="btn-see-more">{{ __('Ver Mais') }}<i class="icon-chevron-down p-1"></i></button>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </main>

  <button type="button" class="btn btn-primary d-none" id="liveToastBtn">Show live toast</button>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto text-info">
          <i class="icon-refresh-cw"></i>
          {{ __('Processando') }}
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ __('A denúncia está sendo validada') }}
      </div>
    </div>
  </div>

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/adminReport.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    var toastTrigger = document.getElementById('liveToastBtn')
    var toastLiveExample = document.getElementById('liveToast')
    if (toastTrigger) {
      toastTrigger.addEventListener('click', function() {
        var toast = new bootstrap.Toast(toastLiveExample)

        toast.show()
      })
    }

    function acceptComplaint(value, from) {
      $.ajax({
          url: "{{ route('accept.complaint', app()->getLocale()) }}",
          type: 'GET',
          data: {
            'response': 'accept',
            'publication': value
          },
          beforeSend: () => {
            $(document).ready(function() {
              $("#liveToastBtn").click();
            })
          }
        })
        .done((response) => {
          $(`#card-report-${from}-${value}`).prependTo("#report-accept");
          $(`#btn-accept-report-${from}-${value}`).addClass('disabled');
          $(`#btn-refuse-report-${from}-${value}`).removeClass('disabled');
        });
    }

    function refuseComplaint(value, from) {
      $.ajax({
          url: "{{ route('refuse.complaint', app()->getLocale()) }}",
          type: 'GET',
          data: {
            'response': 'refuse',
            'publication': value
          },
          beforeSend: () => {
            $(document).ready(function() {
              $("#liveToastBtn").click();
            })
          }
        })
        .done((response) => {
          $(`#card-report-${from}-${value}`).prependTo("#report-refuse");
          $(`#btn-refuse-report-${from}-${value}`).addClass('disabled');
          $(`#btn-accept-report-${from}-${value}`).removeClass('disabled');
        });
    }
  </script>
</body>