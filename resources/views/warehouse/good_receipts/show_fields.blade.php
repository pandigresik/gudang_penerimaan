<!-- Partner Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('partner_id', __('models/goodReceipts.fields.partner_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceipt->partner_id }}</p>
    </div>
</div>

<!-- Receipt Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('receipt_date', __('models/goodReceipts.fields.receipt_date').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceipt->receipt_date }}</p>
    </div>
</div>

<!-- State Field -->
<div class="form-group row mb-3">
    {!! Form::label('state', __('models/goodReceipts.fields.state').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceipt->state }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/goodReceipts.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceipt->description }}</p>
    </div>
</div>

