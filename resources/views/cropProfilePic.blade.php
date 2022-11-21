<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
<link href="/assets/css/style.css" rel="stylesheet" />

<div class="modal fade bd-example-modal-lg imagecrop imagecropconfig" id="model" tabindex="-1" role="dialog" aria-labelledby="modalCropProfilePic" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Cortar') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <div class="row">
            <div class="col-md-11">
              <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" class="d-block mw-100 img-crop" referrerpolicy="no-referrer">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer modal-footer-crop">
        <button type="button" class="btn-crop-cancel" data-bs-dismiss="modal" id="cancelCrop">{{ __('Cancelar') }}</button>
        <button type="button" class="crop btn-crop-cut" id="crop">{{ __('Cortar') }}</button>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary d-none" id="btnToastEditProfile">Show live toast</button>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="liveToastEditProfile" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      @if(session('msgUpdateProfileSuccess'))
      <strong class="me-auto text-success">
        <i class="icon-check"></i>
        {{ __('Sucesso') }}
      </strong>
      @elseif(session('msgUpdateProfileFail'))
      <strong class="me-auto text-danger">
        <i class="icon-x"></i>
        {{ __('Falha') }}
      </strong>
      @endif
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      @if(session('msgUpdateProfileSuccess'))
      {{ session('msgUpdateProfileSuccess') }}

      @elseif(session('msgUpdateProfileFail'))
      {{ session('msgUpdateProfileFail') }}

      @endif
    </div>
  </div>
</div>

<script src="/assets/js/cropimage.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

<script>
  var btnToastEditProfile = document.getElementById("btnToastEditProfile");
  var liveToastEditProfile = document.getElementById("liveToastEditProfile");
  if (btnToastEditProfile) {
    btnToastEditProfile.addEventListener("click", function() {
      var toast = new bootstrap.Toast(liveToastEditProfile);

      toast.show();
    });
  }

  @if(session('msgUpdateProfileSuccess') || session('msgUpdateProfileFail'))
  $(document).ready(function() {
    $("#btnToastEditProfile").click();
  });
  @endif
</script>