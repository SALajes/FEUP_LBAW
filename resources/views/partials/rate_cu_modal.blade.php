<div class="modal fade" id="rateCUModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rate curricular unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bio-form" class="form-horizontal" method="POST" action="{{ route('rateCU', $cu->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-4 control-label">Review</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="cu_review" name="cu_review" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" style="margin-top:0.5rem">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>