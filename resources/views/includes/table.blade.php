<table class="table">
    <thead>
    <tr>
        <th class="text-center">#</th>
        <th>Name</th>
        <th>Barcode</th>
        <th>Price</th>
        <th>Quantity</th>
        <th class="text-right">Total Price</th>
        <th class="text-right">Undo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
    <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $order->product->name }}</td>
        <td>{{ $order->product->id }}</td>
        <td>{{  number_format($order->sold_price,0,'.','.') }} IQD </td>
        <td>{{ $order->quantity }}</td>
        <td class="text-right"> {{  number_format($order->total_price,0,'.','.')  }} IQD</td>
        <td class="td-actions text-right">
            <button type="button" rel="tooltip" class="btn btn-default btn-icon btn-sm"  data-original-title="undo" title="undo" onclick="undo({{$order->id}})">
                <i class="fas fa-undo"></i>
            </button>
        </td>
    </tr
    @endforeach

    </tbody>
</table>

