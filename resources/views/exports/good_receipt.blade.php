<table>
    <thead>
        <tr>
            <th>Tanggal Beli</th>
            <th>DT</th>
            <th>Sales</th>
            <th>Supplier</th>
            <th>Item</th>
            <th>Jenis</th>
            <th>Status</th>
            <th>Colly</th>
            <th>Quantity</th>
            <th>Sample</th>
        </tr>
    </thead>
    <tbody>    
    @foreach($goodReceipts as $gr)
        <tr>
            <td>{{ localFormatDate($gr->receipt_date) }}</td>
            <td></td>
            <td>{{ $gr->sample }}</td>
            <td>{{ $gr->partner->name ?? '' }}</td>
            @foreach($gr->goodReceiptItems as $item)
                @if (!$loop->first)
                    <tr>
                        <td colspan="4"></td>
                @endif
                    <td>{{ $item->product->name ?? '' }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $item->goodReceiptItemWeights->sum('quantity') }}</td>
                    <td>{{ $item->goodReceiptItemWeights->sum('weight') }}</td>
                    <td>{{ $item->goodReceiptItemWeights->where('is_sampling', 1)->sum('quantity') }} - {{ $item->goodReceiptItemWeights->where('is_sampling', 1)->sum('weight') }}</td>                
                @if (!$loop->last)
                    </tr>
                @endif                                           

                <!-- hasil sorting sample -->
                @php
                $groupResultWeight = $item->goodReceiptItemClassifications->groupBy('product_id')
                @endphp
                @foreach($groupResultWeight as $sample)                
                    <tr>
                        <td colspan="4"></td>                
                        <td>{{ $sample->first()->product->name ?? '' }}</td>
                        <td></td>
                        @if ($loop->first)
                        <td rowspan="{{ $groupResultWeight->count() }}">Rincian sortir {{ $item->product->name ?? '' }} <br>{{ $item->goodReceiptItemWeights->sum('quantity') }}<br>Sampling<br>{{ $item->goodReceiptItemWeights->where('is_sampling', 1)->sum('quantity') }} - {{ $item->goodReceiptItemWeights->where('is_sampling', 1)->sum('weight') }}</td>
                        @endif
                        <td>-</td>
                        <td>{{ $sample->sum('weight') }}</td>
                        <td>{{ $sample->whereNotNull('reference')->sum('weight') }}</td>
                    @if (!$loop->last)
                    </tr>
                    @endif
                @endforeach
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
