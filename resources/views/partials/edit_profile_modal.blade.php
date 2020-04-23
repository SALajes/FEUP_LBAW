<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginLabel">Edit profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="editProfileForm"">
          {{ csrf_field() }}
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
          <button class="btn btn-primary" type="submit">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>