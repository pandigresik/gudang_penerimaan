<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/partners.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->code }}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/partners.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->name }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/partners.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->description }}</p>
    </div>
</div>

<!-- Active Field -->
<div class="form-group row mb-3">
    {!! Form::label('active', __('models/partners.fields.active').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->active }}</p>
    </div>
</div>

<!-- Address Field -->
<div class="form-group row mb-3">
    {!! Form::label('address', __('models/partners.fields.address').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->address }}</p>
    </div>
</div>

<!-- City Field -->
<div class="form-group row mb-3">
    {!! Form::label('city', __('models/partners.fields.city').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->city }}</p>
    </div>
</div>

<!-- Email Field -->
<div class="form-group row mb-3">
    {!! Form::label('email', __('models/partners.fields.email').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->email }}</p>
    </div>
</div>

<!-- Phone Field -->
<div class="form-group row mb-3">
    {!! Form::label('phone', __('models/partners.fields.phone').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->phone }}</p>
    </div>
</div>

<!-- Mobile Field -->
<div class="form-group row mb-3">
    {!! Form::label('mobile', __('models/partners.fields.mobile').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->mobile }}</p>
    </div>
</div>

<!-- Additional Info Field -->
<div class="form-group row mb-3">
    {!! Form::label('additional_info', __('models/partners.fields.additional_info').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $partner->additional_info }}</p>
    </div>
</div>

