<div class="block_weighing">
    <hr>
    <!-- Product Id Field -->
    <div class="form-group row mb-3">
        {!! Form::label('product_id', __('models/goodReceiptItems.fields.product_id') . ':', [
            'class' => 'col-md-3 col-form-label',
        ]) !!}
        <div class="col-md-9">
            {!! Form::select(null, [], null, [
                'class' => 'form-control select2',
                'id' => 'product_id_item',
            ]) !!}
        </div>
    </div>

    <!-- Quantity Field -->
    <div class="form-group row mb-3">
        {!! Form::label('quantity', __('models/goodReceiptItemWeights.fields.quantity') . ':', [
            'class' => 'col-md-3 col-form-label',
        ]) !!}
        <div class="col-md-9">
            {!! Form::number('quantity', null, [
                'class' => 'form-control inputmask',
                'data-unmask' => 1,
                'data-optionmask' => json_encode(array_merge(['max' => 9], config('local.number.integer'))),
            ]) !!}
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

    <!-- Is Sampling Field -->
    <div class="form-group row mb-3">
        {!! Form::label('is_sampling', __('models/goodReceiptItemWeights.fields.is_sampling') . ':', [
            'class' => 'col-md-3 col-form-label',
        ]) !!}
        <div class="col-md-9">
            <label class="checkbox-inline">
                {!! Form::hidden('is_sampling', 0) !!}
                {!! Form::checkbox('is_sampling', '1', null) !!}
            </label>
        </div>
    </div>

    <div class="form-group row">
        <div class="offset-md-3 mb-3">
            {!! Form::button('Timbang', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>
