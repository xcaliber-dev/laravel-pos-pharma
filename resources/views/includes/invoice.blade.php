<div class="bg-white rounded">
    <div class="row">
        <div class="col-md-6">
            <h2 class="text-uppercase text-center">Invoice</h2>
            <div class="billed"><span class="font-weight-bold text-uppercase">Billed:</span><span class="ml-1">Jasper Kendrick</span></div>
            <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1">May 13, 2020</span></div>
            <div class="billed"><span class="font-weight-bold text-uppercase">Order ID:</span><span class="ml-1">#1345345</span></div>
        </div>
        <div class="col-md-6 text-right mt-3">
            <h4 class="text-danger mb-0">Rae jones</h4><span>bbbootstrap.com</span>
        </div>
    </div>
    <div class="mt-3">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $order)

                @endforeach

                @php
                $sum = 0;
                    foreach ($orders as $order) {
                        $sum+=$order->total_price;
                      echo  "<tr>
                        <td>".$order->product->name ."</td>
                        <td>". $order->quantity ."</td>
                        <td>". number_format($order->sold_price,0,'.','.')  ."</td>
                        <td>".  number_format($order->total_price,0,'.','.') ."</td>
                    </tr>";
               }
                @endphp
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td>{{$sum}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-right mb-3"><button class="btn btn-danger btn-sm mr-5" type="button">Pay Now</button></div>
</div>