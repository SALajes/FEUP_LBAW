<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" id="registerForm"">
            {{ csrf_field() }}
            <input id="name" type="text" name="name" class="form-control" placeholder="Name" required autofocus>
            @if ($errors->has('name'))
              <span class="error">
                {{ $errors->first('name') }}
              </span>
            @endif
            <input id="email" type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            @if ($errors->has('email'))
              <span class="error">
                {{ $errors->first('email') }}
              </span>
            @endif
            <input id="student_number" type="text" name="student_number" class="form-control" placeholder="Student number" required autofocus>
            @if ($errors->has('student_number'))
              <span class="error">
                {{ $errors->first('student_number') }}
              </span>
            @endif
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
              @if ($errors->has('password'))
              <span class="error">
                  {{ $errors->first('password') }}
                </span>
              @endif
            <input type="password" class="form-control" id="password_confirm" name="password_confirmation" placeholder="Password" required>
            <button class="btn btn-outline-light" type="submit">
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @section('scripts')
@parent

<script>
$(function () {
    $('#registerForm').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#registerForm input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: "{{ route('register') }}",
            data: formData,
            success: () => {}),
            error: (response) => {
                if(response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "Input").addClass("is-invalid");
                        $("#" + key + "Error").children("strong").text(errors[key][0]);
                    });
                } else {
                    window.location.reload();
                }
            }
        })
    });
})
</script>
@endsection