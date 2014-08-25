@foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert" data-dismiss="alert">
        {{{ $error }}}
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    </div>
@endforeach