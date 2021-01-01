<!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

            <title>Invoice</title>

            <link rel='stylesheet' type='text/css' href='{{asset('assets/css/receiptStyle.css')}}' />
            <script src="{{asset('assets/js/jquery.min.js')}}"></script>

            {{-- <link rel='stylesheet' type='text/css' href='css/print.css' media='print' /> --}}
            <!-- <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script> -->
            <!-- <script type='text/javascript' src='js/example.js'></script> -->

        </head>

        <body >

            <div id='page-wrap'>

                <textarea id='header'>INVOICE</textarea>

                <div id='identity'>

                    <span id='address' style="font-weight: bold">Zillion Realm and Logistics Company Limited
                        <br> Location: Alabar -  Tamale Station
                        <br>Phone: 020564444 / 0547576296 / 0549010177</span>
                </div>

                <div id='customer'>

                    <table id='meta'>
                        <tr>
                            <td class='meta-head'>Invoice #</td>
                            <td><textarea>{{$orders[0]->receipt_id}}</textarea></td>
                        </tr>
                        <tr>

                            <td class='meta-head'>DateTime</td>
                            <td><textarea id='date'>{{$orders[0]->created_at}}</textarea></td>
                        </tr>
                        <tr>
                            <td class='meta-head'>Customer Name</td>
                            <td><div class='due'>{{$orders[0]->customer_name}}</div></td>
                        </tr>
                        <tr>
                            <td class='meta-head'>Customer Phone</td>
                            <td><div class='due'>{{$orders[0]   ->customer_phone}}</div></td>
                        </tr>

                    </table>

                </div>

                <table id='items'>

                  <tr>
                      <th>Product</th>
                      <th>Unit Cost</th>
                      <th>Quantity</th>
                      <th>Price</th>
                  </tr>
                  @php
                      $total = 0;
                  @endphp

                  @foreach ($orders as $order)
                    <tr class='item-row'>
                        <td>{{$order->brand_name . ' ' . $order->model_name}}</td>
                        <td>{{$order->price}} GHS</td>
                        <td>{{$order->quantity}}    </td>
                        <td><span class='price'>{{$order->price * $order->quantity}} GHS</span></td>
                    </tr>

                    @php
                        $total += ($order->price * $order->quantity);
                    @endphp
                  @endforeach

                  <tr>
                      <td colspan='3' class='blank'> </td>
                      <td colspan='3' class='total'>Total : {{$total}} GHS </div></td>
                      <!-- <td colspan='3' class='total-value'><div id='total'>$875.00</div></td> -->
                  </tr>
                </table>
                <br>
                <br><br>
                ...............................<br>
                Signature / Stamp
            </div>

            <script>
                $(document).ready(function(){
                    window.print();
                    window.onafterprint = function () {
                        window.close();
                    }
                })
            </script>
        </body>

        </html>
