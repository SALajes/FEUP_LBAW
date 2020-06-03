<script src={{ asset('js/editProfile.js') }} defer></script>
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex flex-column ">
                <form class="form-horizontal" method="POST" action="{{ route('editPassword', Auth::user()->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="control-label">Current password</label>

                        <div>
                            <input id="current-password" type="password" class="form-control" name="current-password">
                            <div id="cpw_error"></div>
                            @if ($errors->has('current-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="control-label">New password</label>

                        <div>
                            <input id="new-password" type="password" class="form-control" name="new-password">
                            <div id="npw_error"></div>
                            @if ($errors->has('new-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new-password-confirm" class="control-label">Confirm new password</label>

                        <div>
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation">
                            <div id="npc_error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-bottom:1.5rem;">
                            Update password
                        </button>
                    </div>
                </form>

                <form action="{{ route('editProfilePicture', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="profile_image" id="profile_image" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" style="margin-bottom:1.5rem;">Update profile picture</button>
                    </div>
                </form>

                <form id="bio-form" class="form-horizontal" method="POST" action="{{ route('editBio', Auth::user()->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label">New bio</label>
                        <div>
                            <input class="form-control" name="bio" type="text" id="bio" form="bio-form" placeholder="{{Auth::user()->bio}}" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" style="margin-top:1rem; margin-bottom:1.5rem;">Update bio</button>
                        </div>
                    </div>
                </form>

                <form id="delete-account-form" class="form-horizontal" method="POST" action="{{ route('deleteAccount') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-danger">Delete account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>