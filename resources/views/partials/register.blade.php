<script src={{ asset('js/register.js') }} defer></script>
<script src={{ asset('js/encodeHTML.js') }} defer></script>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="registerLabel">Register</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}
					<input id="name" type="text" name="name" class="form-control" placeholder="Name" required>
					<div id="name_error"></div>
					@if ($errors->has('name'))
					<span class="error">
						{{ $errors->first('name') }}
					</span>
					@endif
					<input id="email-register" type="email" name="email" class="form-control" placeholder="Email" required>
					<div id="email_error"></div>
					@if ($errors->has('email'))
					<span class="error">
						{{ $errors->first('email') }}
					</span>
					@endif
					<input id="student_number" type="text" name="student_number" class="form-control" placeholder="Student number" required>
					<div id="sn_error"></div>
					@if ($errors->has('student_number'))
					<span class="error">
						{{ $errors->first('student_number') }}
					</span>
					@endif
					<input type="password" class="form-control" name="password" id="password-register" placeholder="Password" required>
					<div id="pw_error"></div>
					@if ($errors->has('password'))
					<span class="error">
						{{ $errors->first('password') }}
					</span>
					@endif
					<input type="password" class="form-control" id="password_confirm" name="password_confirmation" placeholder="Password" required>
					<div id="pc_error"></div>
					<button id="pass_submit" class="btn btn-outline-light" type="submit">
						Submit
					</button>
				</form>
			</div>

		</div>
	</div>
</div>
</div>