<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Teste de Personalidade') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/quiz.css" rel="stylesheet" />
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

  <main class="d-flex">
    <div class="web-background w-100 h-100">
      <div class="background-blur w-100 h-100">
        <div class="container p-5 d-flex flex-row">
          <div class="d-flex justify-content-center w-100">
            <form method="POST" action="{{ route('quiz.store', app()->getLocale()) }}" class="d-flex w-100 alternative-index quiz-form">
              <div class="col-9">
                @csrf @foreach ($questions as $question)
                <div id="question-{{$question->id_questao}}" class="question-container col-12 px-3">
                  <div class="row mx-3">
                    <div class="question">
                      <h2>{{$question->id_questao}}. {{ __($question->conteudo) }}</h2>
                    </div>
                  </div>
                  <div class="alternative-container">
                    @foreach ($alternatives as $alternative) @if($alternative->fk_questao_id_questao == $question->id_questao)
                    <div class="card my-3">
                      <div class="card-body p-0">
                        <input class="input-alternative d-none" value="{{$alternative->id_alternativa}}" type="radio" name="question-{{$question->id_questao}}" id="alternative-{{$alternative->id_alternativa}}" />
                        <label id="alternative-label-{{$alternative->id_alternativa}}" class="alternative-label w-100 p-3" for="alternative-{{$alternative->id_alternativa}}">
                          {{ __($alternative->enunciado) }}.
                        </label>
                      </div>
                    </div>
                    @endif @endforeach
                  </div>
                </div>
                @endforeach
                <div class="buttons-content">
                  <button class="next-prev" onclick="prevQuestion()" type="button" id="prev">
                    <i class="icon-chevron-left"></i>
                    {{ __('Anterior') }}
                  </button>
                  <button class="next-prev" onclick="nextQuestion()" type="button" id="next">
                    {{ __('Próximo') }}
                    <i class="icon-chevron-right"></i>
                  </button>
                </div>
              </div>

              <div class="col-3 question-index-container justify-content-center">
                <div class="card my-3 text-center">
                  <div class="card-header border-bottom-0 bg-transparent">
                    {{ __('Perguntas') }}
                  </div>
                  <div class="card-body question-index pt-0">
                    <div class="quiz question-1" onclick="switchQuestion(1)">
                      <button type="button" class="quiz-button p quiz-button-active" id="btn-question-1">1</button>
                    </div>
                    <div class="quiz question-2" onclick="switchQuestion(2)">
                      <button type="button" class="quiz-button p" id="btn-question-2">2</button>
                    </div>
                    <div class="quiz question-3" onclick="switchQuestion(3)">
                      <button type="button" class="quiz-button p" id="btn-question-3">3</button>
                    </div>
                    <div class="quiz question-4" onclick="switchQuestion(4)">
                      <button type="button" class="quiz-button p" id="btn-question-4">4</button>
                    </div>
                    <div class="quiz question-5" onclick="switchQuestion(5)">
                      <button type="button" class="quiz-button p" id="btn-question-5">5</button>
                    </div>
                    <div class="quiz question-6" onclick="switchQuestion(6)">
                      <button type="button" class="quiz-button p" id="btn-question-6">6</button>
                    </div>
                    <div class="quiz question-7" onclick="switchQuestion(7)">
                      <button type="button" class="quiz-button p" id="btn-question-7">7</button>
                    </div>
                    <div class="quiz question-8" onclick="switchQuestion(8)">
                      <button type="button" class="quiz-button p" id="btn-question-8">8</button>
                    </div>
                    <div class="quiz question-9" onclick="switchQuestion(9)">
                      <button type="button" class="quiz-button p" id="btn-question-9">9</button>
                    </div>
                    <div class="quiz question-10" onclick="switchQuestion(10)">
                      <button type="button" class="quiz-button p" id="btn-question-10">10</button>
                    </div>
                    <div class="quiz question-11" onclick="switchQuestion(11)">
                      <button type="button" class="quiz-button p" id="btn-question-11">11</button>
                    </div>
                    <div class="quiz question-12" onclick="switchQuestion(12)">
                      <button type="button" class="quiz-button p" id="btn-question-12">12</button>
                    </div>
                    <div class="quiz question-13" onclick="switchQuestion(13)">
                      <button type="button" class="quiz-button p" id="btn-question-13">13</button>
                    </div>
                    <div class="quiz question-14" onclick="switchQuestion(14)">
                      <button type="button" class="quiz-button p" id="btn-question-14">14</button>
                    </div>
                    <div class="quiz question-15" onclick="switchQuestion(15)">
                      <button type="button" class="quiz-button p" id="btn-question-15">15</button>
                    </div>
                  </div>
                  <div class="card-footer border-top-0 bg-transparent text-start">
                    <div class="button">
                      <input id="finish" type="submit" value="{{ __('Finalizar') }}" name="questionario" />
                      <input type="hidden" id="resposta" name="resposta" />
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    @csrf @if(!$answer->isEmpty())
    <div class="modal fade modal-quiz" id="quiz-or-roadmap" tabindex="-1" aria-labelledby="quiz-or-roadmap-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-quiz">
        <div class="modal-content modal-quiz">
          <div class="modal-body modal-quiz">
            <p>{{ __('Você deseja visualizar seu roteiro ou responder o questionário novamente') }}?</p>
          </div>
          <div class="modal-footer justify-content-between modal-quiz">
            <a href="{{ route('roadMap', app()->getLocale()) }}" class="btn cancel">
              {{ __('Roteiro') }}
            </a>
            <button type="button" class="btn" data-bs-dismiss="modal">
              {{ __('Responder novamente') }}
            </button>
          </div>
        </div>
      </div>
    </div>
    @endif
  </main>

  @include('cropProfilePic')

  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/quiz.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    $(window).load(function() {
      $("#quiz-or-roadmap").modal("show");
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // $(window).load(function () {
    //   $("#cookie-consent-modal").modal("show");
    // });
  </script>
</body>

</html>