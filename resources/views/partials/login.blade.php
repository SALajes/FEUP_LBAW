<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <input id="email" type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            @if ($errors->has('email'))
                <span class="error">
                    {{ $errors->first('email') }}
                </span>
            @endif
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="error">
                    {{ $errors->first('password') }}
                </span>
            @endif
          
            <button class="btn btn-outline-light" type="submit">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>