<div class="modal fade" id="editProfModal" tabindex="-1" role="dialog" aria-labelledby="editProfModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginLabel">Edit profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="prof_name_form" class="form-horizontal" method="POST" action="{{ route('editProfName', $professor->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-4 control-label">New name</label>
                        <div class="col-md-6">
                            <input name="prof_name" type="text" id="prof_name" form="prof_name_form" placeholder="{{$professor->name}}"/>
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                <form id="prof_abbrev_form" class="form-horizontal" method="POST" action="{{ route('editProfAbbrev', $professor->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-4 control-label">New abbrev</label>
                        <div class="col-md-6">
                            <input name="prof_abbrev" type="text" id="prof_abbrev" form="prof_abbrev_form" placeholder="{{$professor->abbrev}}"/>
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                <form id="prof_email_form" class="form-horizontal" method="POST" action="{{ route('editProfEmail', $professor->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-4 control-label">New email</label>
                        <div class="col-md-6">
                            <input name="prof_email" type="text" id="prof_email" form="prof_email_form" placeholder="{{$professor->email}}"/>
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('editProfPicture', $professor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="profile_image" id="profile_image" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                    </div>
                    <div class="col-md-6 col-md-offset-4">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                <form id="delete-account-form" class="form-horizontal" method="POST" action="{{ route('deleteAccount') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
