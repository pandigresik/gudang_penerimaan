<!-- Good Receipt Item Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('good_receipt_item_id', __('models/goodReceiptItemClassifications.fields.good_receipt_item_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItemClassification->good_receipt_item_id }}</p>
    </div>
</div>

<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id', __('models/goodReceiptItemClassifications.fields.product_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItemClassification->product_id }}</p>
    </div>
</div>

<!-- Weight Field -->
<div class="form-group row mb-3">
    {!! Form::label('weight', __('models/goodReceiptItemClassifications.fields.weight').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItemClassification->weight }}</p>
    </div>
</div>

