<!-- Partner Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('partner_id', __('models/goodReceipts.fields.partner_id') . ':', [
        'class' => 'col-md-3 col-form-label',
    ]) !!}
    <div class="col-md-9">
        {!! Form::select('partner_id', $partnerItems, null, [
            'class' => 'form-control select2',
            'required' => 'required',
        ]) !!}
    </div>
</div>

<!-- Receipt Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('receipt_date', __('models/goodReceipts.fields.receipt_date') . ':', [
        'class' => 'col-md-3 col-form-label',
    ]) !!}
    <div class="col-md-9">
        {!! Form::text('receipt_date', null, [
            'class' => 'form-control datetime',
            'required' => 'required',
            'data-optiondate' => json_encode(['locale' => ['format' => config('local.date_format_javascript')]]),
            'id' => 'receipt_date',
        ]) !!}
    </div>
</div>

<!-- Sample Field -->
<div class="form-group row mb-3">
    {!! Form::label('sample', __('models/goodReceipts.fields.sample') . ':', [
        'class' => 'col-md-3 col-form-label',
    ]) !!}
    <div class="col-md-9">
        {!! Form::text('sample', null, [
            'class' => 'form-control',
            'required' => 'required',            
        ]) !!}
    </div>
</div>

<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id[]', __('models/goodReceiptItems.fields.product_id') . ':', [
        'class' => 'col-md-3 col-form-label',
    ]) !!}
    <div class="col-md-9">
        {!! Form::select('product_id[]', $productItems, null, [
            'class' => 'form-control select2',
            'required' => 'required',
            'multiple',
        ]) !!}
    </div>
</div>

@include('warehouse.good_receipts.weighing_item')
@include('warehouse.good_receipts.weighing_result')

@push('scripts')
<script>
    // pastikan semua inputan sudah valid
    const validateForm = function(elm){
        const _message = []
        let _result = false

        if(!$('#weighing_result div.card-product').length){
            _message.push('Belum ada penimbangan')
        }
        // periksa apakah sudah ada yang diset sebagai sampling atau belum
        $('#weighing_result div.card-product').each(function(){
            if(! $(this).find('td.sampling>:checkbox:checked').length){
                _message.push($(this).find('div.card-header').text()+' belum memilih sample')
            }
        })
        if(_message.length){
            main.alertDialog('Peringatan', _message.join(', \n'))            
        }else {
            _result = true
        }
        
        return _result
    }
    const updateTotalWeight = function(elm){
        const _tbody = $(elm).closest('tbody')
        const _tfoot = _tbody.next('tfoot')
        let _totalWeight = 0.0
        let _option = {}
        _tbody.find('td.weight>input').each(function(){
            _option = $(this).data('optionmask') || {}
            let _unmaskedvalue = $(this).inputmask('unmaskedvalue')
            if (_option.radixPoint === ',') {
                _unmaskedvalue = _unmaskedvalue.replace(',', '.')
            }
            _totalWeight += parseFloat(_unmaskedvalue)
        })
        var _formattedValue = Inputmask.format( _totalWeight, _option)
        _tfoot.find('th.weight').text(_formattedValue)
    }

    const updateTotalQuantity = function(elm){
        const _tbody = $(elm).closest('tbody')
        const _tfoot = _tbody.next('tfoot')
        let _totalQuantity = 0.0
        let _option = {}
        _tbody.find('td.quantity>input').each(function(){
            _option = $(this).data('optionmask') || {}
            let _unmaskedvalue = $(this).inputmask('unmaskedvalue')
            if (_option.radixPoint === ',') {
                _unmaskedvalue = _unmaskedvalue.replace(',', '.')
            }
            _totalQuantity += parseInt(_unmaskedvalue)
        })
        var _formattedValue = Inputmask.format( _totalQuantity, _option)        
        _tfoot.find('th.quantity').text(_formattedValue)
    }

    $(function(){
        $('select[name="product_id[]"]').change(function(){
            let _terpilih = {}
            $('#product_id_item').empty();
            $(this).find('option:selected').each(function(){
                $('#product_id_item').append(`<option value='${$(this).val()}'>${$(this).text()}</option>`)
                _terpilih[$(this).val()] = $(this).text()
            })
            $('#product_id_item').val('');
            $('#product_id_item').trigger('change');

            $('#weighing_result').find('div.card-product').each(function(){
                if(_terpilih[$(this).data('product-id')] === undefined){
                    $(this).remove()
                }
            })

            for(let i in _terpilih){
                if(! $('#weighing_result').find('div.card-product[data-product-id="'+i+'"]').length){
                    $('#weighing_result').append(`
                        <div class="card card-product mb-3 border-primary" data-product-id='${i}'>
                            <div class="card-header border-primary">${_terpilih[i]}</div>
                            <div class="card-body">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr><th width="15%">Timbangan ke</th><th>Colly</th><th>Kg</th><th>Sample</th></tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot><tr><th>Total</th><th class="quantity text-end">0</th><th class="weight text-end">0</th></tr></tfoot>
                                </table>
                            </div>
                        </div>
                    `)
                }
            }                         
        })

        $('div.block_weighing button').click(function(){
            let _parent = $(this).closest('div.block_weighing')
            let _product = _parent.find('#product_id_item').val()
            let _quantity = _parent.find('#quantity').val()
            let _weight = _parent.find('#weight').val()
            let _sample = _parent.find('#is_sampling:checked').length ? 1 : 0
            
            if (_product == '' || _product == null || _quantity == '' || _quantity == 0 || _weight == ''){
                main.alertDialog('Peringatan', 'Data harus diisi semua');
                return
            }            
            const _optionMask = '{!! json_encode(array_merge(['max' => 9], config('local.number.integer'))) !!}'
            const _optionMaskWeight = '{!! json_encode(config('local.number.decimal1')) !!}'
            let _container = $('#weighing_result').find('div.card-product[data-product-id="'+_product+'"]').find('tbody')
            let _totalBaris = _container.find('tr').length + 1
            _container.append(`
                    <tr>
                        <td>${_totalBaris}</td>
                        <td class="quantity text-end"><input onchange="updateTotalQuantity(this)" type="text" value="${_quantity}" data-unmask="1" data-optionmask='${_optionMask}' class="form-control inputmask" name="items[${_product}][${_totalBaris}][quantity]"></td>
                        <td class="weight text-end"><input  onchange="updateTotalWeight(this)" type="text" value="${_weight}"  data-unmask="1" data-optionmask='${_optionMaskWeight}' class="form-control inputmask" name="items[${_product}][${_totalBaris}][weight]"></td>
                        <td class="sampling"><input type="checkbox" value="1" ${_sample ? 'checked' : ''} name="items[${_product}][${_totalBaris}][is_sampling]"></td>
                    </tr>`)

            main.initInputmask(_container.find('tr:last'))
            _container.find('tr:last input.inputmask').trigger('change')
            _parent.find('select, input').val('')
            _parent.find(':checkbox').prop('checked', 0)
            _parent.find('select').trigger('change')            
            
        })
    })
</script>
@endpush
