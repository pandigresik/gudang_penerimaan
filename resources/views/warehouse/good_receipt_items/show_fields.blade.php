<!-- Good Receipt Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('good_receipt_id', __('models/goodReceiptItems.fields.good_receipt_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItem->good_receipt_id }}</p>
    </div>
</div>

<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id', __('models/goodReceiptItems.fields.product_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $goodReceiptItem->product_id }}</p>
    </div>
</div>

