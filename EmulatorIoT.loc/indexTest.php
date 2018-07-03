<?php
/* Глобальна конфиігурація cURL */
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$host = "http://restapi.loc/";
/* Ініціалізація глобальних змінних */
$errMsg = $id = $id_shop='';


/* Виконання методів POST (на створення) и PUT (на зміну) */
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    /* Перевірка заповнення полів форми */
    if(empty($_POST['id_buy'])){
        $errMsg = 'Заповніть поля!';

    }else{
        /* Формування рядка для відправлення для обох методів*/
     // $str = "id={$_POST['id']}&id_buy={$_POST['id_buy']}&id_user={$_POST['id_user']}&id_product={$_POST['id_product']}&id_shop={$_POST['id_shop']}&price={$_POST['price']}";

        $str = "id_buy={$_POST['id_buy']}&id_user={$_POST['id_user']}&id_product={$_POST['id_product']}&id_shop={$_POST['id_shop']}&price={$_POST['price']}";
        curl_setopt($curl, CURLOPT_POSTFIELDS, $str);

      /* Відправлення даних методом POST */
            curl_setopt($curl, CURLOPT_URL, $host.'buys');
            curl_setopt($curl, CURLOPT_POST, 1);
            $result = json_decode(curl_exec($curl));
            curl_close($curl);


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $host = "http://restapi.loc/";
        curl_setopt($curl, CURLOPT_URL, $host."products/$result->id_product");

        $result_p = json_decode(curl_exec($curl));
        curl_close($curl);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $host = "http://restapi.loc/";
        curl_setopt($curl, CURLOPT_URL, $host."users/$result->id_user");

        $result_u = json_decode(curl_exec($curl));
        curl_close($curl);
       // echo 'До покупки № ' . $result->id_buy . ' користувача з id ' . $result->id_user . ' товар ' . $result_p->name;
        echo 'Користувач  ' . $result_u->login . ' до вашої покупки № ' . $result->id_buy .  ' додано товар '  . $result_p->name;

        }

}
?>

<?php
if($errMsg)
    echo $errMsg;
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    id покупки <br />
    <input type="text" name="id_buy" value="<?=$id_buy?>" /><br />
    id користувача <br />
    <input type="text" name="id_user" value="<?=$id_user?>" /><br />
    id продукту<br />
    <input type="text" name="id_product" value="<?=$id_product?>" /><br />
    id магазину<br />
    <input type="text" name="id_shop" value="<?=$id_shop?>" /><br />
    ціна<br />
    <input type="text" name="price" value="<?=$price?>" /><br />



    <br />
    <input type="submit" value="Відправити дані" />
</form>
