<div class="block_weighing">
    <hr>
    <!-- Product Id Field -->
    <div class="form-group row mb-3">
        {!! Form::label('product_id', __('models/goodReceiptItems.fields.product_id') . ':', [
            'class' => 'col-md-3 col-form-label',
        ]) !!}
        <div class="col-md-9">            
            {!! Form::select('product_id_item', $productItems, null, ['class' => 'form-control select2']) !!}
        </div>
    </div>    

    <!-- Weight Field -->
    <div class="form-group row mb-3">
        {!! Form::label('weight', __('models/goodReceiptItemWeights.fields.weight') . ':', [
            'class' => 'col-md-3 col-form-label',
        ]) !!}
        <div class="col-md-9">
            {!! Form::number('weight', null, [
                'class' => 'form-control inputmask',
                'data-unmask' => 1,
                'data-optionmask' => json_encode(config('local.number.decimal1')),
            ]) !!}
        </div>
    </div>    

    <div class="form-group row">
        <div class="offset-md-3 mb-3">
            {!! Form::button('Timbang', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>
