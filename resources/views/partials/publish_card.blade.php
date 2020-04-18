<link rel="stylesheet" href="{{ asset('css/card.css') }}">

<div class="card">
    <div class="card-header">
        To > 
        <select class="custom-select w-auto">
            <option value="1" selected>General</option>
            <option value="2">LBAW</option>
            <option value="3">PPIN</option>
        </select>
    </div>

    <div class="card-body">
        <input type="text" class="form-control" aria-label="Sizing example input"
            aria-describedby="inputGroup-sizing-default" placeholder="What's on your mind?">
    </div>
    
    <div class="card-footer d-flex justify-content-between">
        <a href="#"><i class="icon-attach"></i></a>
        <button id="post_btn" type="button" class="btn btn-primary">Post</button>
    </div> 
</div>