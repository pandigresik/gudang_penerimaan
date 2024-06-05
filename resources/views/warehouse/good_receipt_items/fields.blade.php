<!-- Good Receipt Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('good_receipt_id', __('models/goodReceiptItems.fields.good_receipt_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('good_receipt_id', $goodReceiptItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id', __('models/goodReceiptItems.fields.product_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('product_id', $productItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>
