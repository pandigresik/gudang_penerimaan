<!-- Good Receipt Item Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('good_receipt_item_id', __('models/goodReceiptItemWeights.fields.good_receipt_item_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItemWeight->good_receipt_item_id }}</p>
    </div>
</div>

<!-- Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('quantity', __('models/goodReceiptItemWeights.fields.quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItemWeight->quantity }}</p>
    </div>
</div>

<!-- Weight Field -->
<div class="form-group row mb-3">
    {!! Form::label('weight', __('models/goodReceiptItemWeights.fields.weight').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItemWeight->weight }}</p>
    </div>
</div>

<!-- Is Sampling Field -->
<div class="form-group row mb-3">
    {!! Form::label('is_sampling', __('models/goodReceiptItemWeights.fields.is_sampling').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItemWeight->is_sampling }}</p>
    </div>
</div>

<!-- State Field -->
<div class="form-group row mb-3">
    {!! Form::label('state', __('models/goodReceiptItemWeights.fields.state').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItemWeight->state }}</p>
    </div>
</div>

