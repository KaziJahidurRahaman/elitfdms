<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mastersheet</title>
</head>
<body>
    <h5>Master Sheet</h5>
    <p>Daraz failed Delivery management System</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Seller Name</th>
                <th>Seller Phone Number</th>
                <th>Order Number</th>
                <th>Tracking ID</th>
                <th>SKU</th>
                <th>Located At</th>
                <th>Damage Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order){
                <tr>
                    <td>{{$order[0]->id}}</td>
                    <td>{{$order[0]->seller_name}}</td>
                    <td>{{$order[0]->seller_phone_no}}</td>
                    <td>{{$order[0]->order_number}}</td>
                    <td>{{$order[0]->tracking_id}}</td>
                    <td>{{$order[0]->sku}}</td>
                    <td>{{$order[0]->l4_origin_address}}</td>
                    <td>{{$order[0]->damage_status}}</td>
                </tr>          
            }
            @endforeach
        </tbody>
        
      
    </table>

    
</body>
</html>