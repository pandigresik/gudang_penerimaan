<!-- Good Receipt Item Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('good_receipt_item_id', __('models/goodReceiptItemWeights.fields.good_receipt_item_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('good_receipt_item_id', $goodReceiptItemItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('quantity', __('models/goodReceiptItemWeights.fields.quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::number('quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>

<!-- Weight Field -->
<div class="form-group row mb-3">
    {!! Form::label('weight', __('models/goodReceiptItemWeights.fields.weight').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::number('weight', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>

<!-- Is Sampling Field -->
<div class="form-group row mb-3">
    {!! Form::label('is_sampling', __('models/goodReceiptItemWeights.fields.is_sampling').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    <label class="checkbox-inline">
        {!! Form::hidden('is_sampling', 0) !!}
        {!! Form::checkbox('is_sampling', '1', null) !!}
    </label>
</div>
</div>


<!-- State Field -->
<div class="form-group row mb-3">
    {!! Form::label('state', __('models/goodReceiptItemWeights.fields.state').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('state', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>
