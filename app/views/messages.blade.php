@if(Session::get('success'))
    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('success') }}
    </p>
@elseif(Session::get('error'))
    <p class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('error') }}
    </p>
@endif