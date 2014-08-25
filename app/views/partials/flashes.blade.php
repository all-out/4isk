<?php $alertTypes = ['success', 'info', 'warning', 'danger']; ?>

@foreach ($alertTypes as $alertType)
    @if (Session::has($alertType))
        <div class="alert alert-{{ $alertType }}" role="alert" data-dismiss="alert">
            {{ Session::get($alertType) }}
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
    @endif
@endforeach