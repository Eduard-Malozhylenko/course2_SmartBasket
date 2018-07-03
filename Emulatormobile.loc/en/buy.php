<?php
/* Глобальна конфиігурація cURL */

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$host = "http://restapi.loc/";
curl_setopt($curl, CURLOPT_URL, $host."buys");
$result = json_decode(curl_exec($curl));
curl_close($curl);

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$host = "http://restapi.loc/";
curl_setopt($curl, CURLOPT_URL, $host."products");
$result_p = json_decode(curl_exec($curl));
curl_close($curl);
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$host = "http://restapi.loc/";
curl_setopt($curl, CURLOPT_URL, $host."shops");
$result_s = json_decode(curl_exec($curl));
curl_close($curl);

$user = unserialize( base64_decode($_COOKIE["user"]));
$id_user = $user['id_user'];
$ids='';
$sum=0;
?>
<div style=" background-color: darkblue;color: white ;  margin-right: 80%; padding-bottom: 100px">
    <h1>Smart Basket <a  style="color: white; font-size: 50%;  " href= "index.php">     UA</a></h1>
    <div style="background-color: blue; color: white; padding-bottom: 150px;text-align: center">
<?php
foreach ($result as $buy){
    if ($buy->id_user = $id_user){
        foreach ($result_p as $product){
            if($product->id == $buy->id_product ){
                $product_name = $product->name;
            }
        }
        foreach ($result_s as $shop){
            if($shop->id == $buy->id_shop ){
                $address = $shop->address;
            }
        }
        $id = $buy->id_buy +1;
        if ($ids != $id&&$ids !=''){
            echo <<<BOOK
        <p>Address <strong>{$address}</strong></p>
        <p>Sum<strong>{$sum}</strong></p>
        <hr>
           
        <p> Buy № <strong>{$id}</strong></p>
          <p>Product</p>

BOOK;
            $sum=0;
        }

        $sum += $buy->price;
        $id_shop= $buy->id_shop;
        if ($ids==''){
            echo "<p> Buy № <strong>{$id}</strong></p>";

        }
        echo <<<BOOK
     
        
       
        <p>{$product_name} <strong>Price{$buy->price}</strong></p>
    
        
BOOK;
        $ids = $id;
    }
}
?>
    </div>
</div>
