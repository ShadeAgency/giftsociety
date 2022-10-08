
    {{ Form::open(array('url' => 'clients')) }}
    <div class="modal-body">
         <div class="row">
            <div class="col-6 form-group">
                {{ Form::label('name', __('Name'),['class'=>'col-form-label']) }}
                {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
            </div>
            <div class="col-6 form-group">
                {{ Form::label('email', __('E-Mail Address'),['class'=>'col-form-label']) }}
                {{ Form::email('email', null, array('class' => 'form-control','required'=>'required')) }}
            </div>
            <div class="col-6 form-group">
                {{ Form::label('password', __('Password'),['class'=>'col-form-label']) }}
                {{ Form::text('password', null, array('class' => 'form-control','required'=>'required')) }}
            </div>

            @if(!$customFields->isEmpty())
                @include('custom_fields.formBuilder')
            @endif
        </div>      
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
        <button type="submit" class="btn  btn-primary">{{__('Create')}}</button>
    </div>
    
    {{ Form::close() }}

