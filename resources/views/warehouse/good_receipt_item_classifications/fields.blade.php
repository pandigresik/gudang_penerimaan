<!-- Good Receipt Item Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('good_receipt_item_id', __('models/goodReceiptItemClassifications.fields.good_receipt_item_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('good_receipt_item_id', $goodReceiptItemItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

@include('warehouse.good_receipt_item_classifications.weighing_item')
@include('warehouse.good_receipt_item_classifications.weighing_result')

@push('scripts')
<script>
    // pastikan semua inputan sudah valid
    const validateForm = function(elm){
        const _message = []
        let _result = false

        if(!$('#weighing_result div.card table>tbody>tr').length){
            _message.push('Belum ada penimbangan')
        }
        // pastikan totalnya sesuai dengan bahan yang dipilih
        const _totalTimbang = parseFloat($('#weighing_result div.card table>tfoot>tr>th.weight').text().replace('.', '').replace(',', '.'))
        const _targetTimbang = $('#weighing_result div.card').data('timbang')
        if(_totalTimbang > _targetTimbang){
            _message.push(`Total penimbangan (${_totalTimbang}) tidak boleh lebih besar dari sisa timbang  bahan (${_targetTimbang})`)
        }

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

    $(function(){
        $('select[name="good_receipt_item_id"]').change(function(){
            const _str = $(this).find('option:selected').text();
            const _match = _str.match(/Sisa (\d.*) Kg/);
            const _nilaiTimbang = parseFloat(_match[1]);
            
            $('#weighing_result').empty()
            $('#weighing_result').append(`
                        <div class="card card-product mb-3 border-primary" data-timbang="${_nilaiTimbang}">
                            <div class="card-header border-primary">Hasil Penimbangan </div>
                            <div class="card-body">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr><th width="15%">Timbangan ke</th><th>Produk</th><th width="15%">Kg</th></tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot><tr><th colspan="2" class="text-end">Total</th><th class="weight text-end">0</th></tr></tfoot>
                                </table>
                            </div>
                        </div>
                    `)                         
        })

        $('div.block_weighing button').click(function(){
            let _parent = $(this).closest('div.block_weighing')
            let _product = _parent.find('select[name=product_id_item]').val()
            let _productName = _parent.find('select[name=product_id_item] option:selected').text()
            let _weight = _parent.find('#weight').val()            
            
            if (_product == '' || _weight == ''){
                main.alertDialog('Peringatan', 'Data harus diisi semua');
                return
            }            
            const _optionMask = '{!! json_encode(array_merge(['max' => 9], config('local.number.integer'))) !!}'
            const _optionMaskWeight = '{!! json_encode(config('local.number.decimal1')) !!}'
            let _container = $('#weighing_result').find('tbody')
            let _totalBaris = _container.find('tr').length + 1
            _container.append(`
                    <tr>
                        <td>${_totalBaris}</td>                        
                        <td class=""><input type="hidden" value="${_product}"  class="form-control" name="items[${_totalBaris}][product_id]">${_productName}</td>
                        <td class="weight text-end"><input  onchange="updateTotalWeight(this)" type="text" value="${_weight}"  data-unmask="1" data-optionmask='${_optionMaskWeight}' class="form-control inputmask" name="items[${_totalBaris}][weight]"></td>
                    </tr>`)

            main.initInputmask(_container.find('tr:last'))
            _container.find('tr:last input.inputmask').trigger('change')
            _parent.find('select, input').val('')            
            _parent.find('select').trigger('change')            
            
        })
    })
</script>
@endpush
