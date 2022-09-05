<script>
  $(document).ready(function() {
      $('#floatingUsername').on('focusout', function() {
        var value = $(this).val();
        $('#btn-save').addClass("disabled");

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
              $("#loading").css('display', 'block');
              usernameFlag = false;
            },
            complete: () => {
              $("#loading").css('display', 'none');
            }
          })
          .done((response) => {
            if (response) {
              $('#btn-save').removeClass("disabled");

              let msg = document.getElementById("msgUsername");
              usernameFlag = true;
              if (msg)
                usernameContent.removeChild(msg);
            } else {
              msgAlert(usernameContent, 'Nome já utilizado', 'msgUsername');
              usernameFlag = false;
            }
          })
      });
    });
</script>