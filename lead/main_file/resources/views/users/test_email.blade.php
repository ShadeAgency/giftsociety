
<form class="pl-3 pr-3" method="post" action="{{ route('test.email.send') }}">
    @csrf
<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <label for="email" class="col-form-labell">{{ __('E-Mail Address') }}</label>
            <input type="email" class="form-control" id="email" name="email" required/>
        </div>
    </div>
</div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
        <button type="submit" class="btn  btn-primary">{{__('Send Test Mail')}}</button>
    </div>
</form>

