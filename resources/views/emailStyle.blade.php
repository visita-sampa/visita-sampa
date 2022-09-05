<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300&display=swap');
  </style>
  <style>
    <head>
                        <style>
                            @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300&display=swap");
                        </style>
                        <style>
                            * {
                                font-family: "Roboto", sans-serif;
                                margin: 0;
                                padding: 0;
                                box-sizing: border-box;
                            }

                            body {
                                color: #212529 !important;
                            }

                            .email p {
                                color: #26547c !important;
                            }

                            .logo {
                                width: 7.7rem;
                            }

                            h3 {
                                font-size: 1.5rem;
                                margin-top: 0;
                                margin-bottom: 0.5rem;
                                font-weight: 500;
                                line-height: 1.2;
                            }

                            .bg-light {
                                background-color: rgba(248,249,250,1)!important;
                            }

                            .p-3 {
                                padding: 1rem!important;
                            }

                            .d-flex {
                                display: flex!important;
                                flex-direction: column!important;
                            }

                            .flex-column {
                                flex-direction: column!important;
                            }
                            
                            .m-0 {
                                margin: 0!important;
                            }
                            
                            .m-2 {
                                margin: 0.5rem!important;
                            }
                            
                            .mt-2 {
                                margin-top: 0.5rem!important;
                            }
                            
                            .mt-3 {
                                margin-top: 1rem!important;
                            }
                            
                            .m-auto {
                                margin: auto!important;
                            }

                            .h-100 {
                                height: 100%!important;
                            }

                            .w-75 {
                                width: 75%!important;
                            }

                            .card {
                                position: relative;
                                flex-direction: column;
                                min-width: 0;
                                word-wrap: break-word;
                                background-color: #fff;
                                background-clip: border-box;
                                border: 1px solid rgba(0,0,0,.125);
                                border-radius: 0.25rem;
                                text-align: center;
                            }
                            
                            .card-body {
                                flex: 1 1 auto;
                                padding: 1rem 1rem;
                                text-align: left;
                            }

                            p {
                                margin-top: 0;
                                margin-bottom: 1rem;
                                font-size: 1rem!important;
                            }

                            hr:not([size]) {
                                height: 1px;
                            }

                            hr {
                                margin: 1rem 0;
                                color: 26547c;
                                background-color: currentColor;
                            }

                            .fw-light {
                                font-weight: 300!important;
                            }

                            .fs-6 {
                                font-size: 1rem!important;
                            }

                            .btn {
                                display: inline-block;
                                font-weight: 400;
                                line-height: 1.5;
                                color: #212529 !important;
                                text-align: center;
                                text-decoration: none;
                                vertical-align: middle;
                                cursor: pointer;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                user-select: none;
                                background-color: transparent;
                                border: 1px solid transparent;
                                padding: 0.375rem 0.75rem;
                                font-size: 1rem;
                                border-radius: 0.25rem;
                                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                            }

                            .btn-danger {
                                color: #fff !important;
                                background-color: #dc3545;
                                border-color: #dc3545;
                            }

                            .btn-danger:hover {
                                color: #fff !important;
                                background-color: #bb2d3b;
                                border-color: #b02a37;
                            }
                        </style>
                    </head>
                    <div class="d-flex bg-light p-3 email ">
                        <div class="card w-75 h-100 m-2 p-3 m-auto">
                            <a href="https://visita-sampa.herokuapp.com/" class="m-auto" target="_blank">
                                <img class="logo card-img-top" src="https://visita-sampa.herokuapp.com/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
                            </a>
                            <div class="card-body">
                                <h3>Confirmação da e-mail</h3>
                                <div>
                                    <p>Olá, ' . $user->nome . '</p>
                                    <p>Recebemos sua solicitação de atualização de senha. Para continuar, clique no link a seguir e redefina uma nova senha para sua conta: </p>
                                    <div class="d-flex m-auto">
                                        <a href="http://localhost/pt/resetPassword/' . $user->recuperar_senha . '" class="btn btn-danger m-auto">Redefinir senha</a>
                                    </div>
                                    <p class="mt-3">Após confirmar uma nova senha, sua senha anterior não será mais válida.</p>
                                    <hr class="m-2">
                                    <div class="mt-2 fw-light fs-6">
                                        <p class="m-0">&copy; 2021 Copyright:</p>
                                        <p class="">Todos os direitos reservados</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

  <script src="/assets/js/jquery.slim.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>