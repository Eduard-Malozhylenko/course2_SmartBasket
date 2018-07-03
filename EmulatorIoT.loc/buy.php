<?php
/* Глобальна конфиігурація cURL */
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$host = "http://restapi.loc/";
/* Ініціалізація глобальних змінних */
$errMsg = $id = $id_shop='';

$user = unserialize( base64_decode($_COOKIE["user"]));
$id_user = $user['id_user'];
$id_buy = $user['id_buy'];
$id_shop = $user['id_shop'];


/* Виконання методів POST (на створення) и PUT (на зміну) */
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    /* Перевірка заповнення полів форми */
    if(empty($_POST['id_product'])){
        $errMsg = 'Заповніть поля!';

    }else{

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $host = "http://restapi.loc/";
        curl_setopt($curl, CURLOPT_URL, $host."products/{$_POST['id_product']}");
        $result_pr = json_decode(curl_exec($curl));
        curl_close($curl);


        /* Формування рядка для відправлення для обох методів*/
        // $str = "id={$_POST['id']}&id_buy={$_POST['id_buy']}&id_user={$_POST['id_user']}&id_product={$_POST['id_product']}&id_shop={$_POST['id_shop']}&price={$_POST['price']}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $host = "http://restapi.loc/";

        $str = "id_buy={$id_buy}&id_user={$id_user}&id_product={$_POST['id_product']}&id_shop={$id_shop}&price={$result_pr->price}";
        curl_setopt($curl, CURLOPT_POSTFIELDS, $str);

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
        curl_setopt($curl, CURLOPT_URL, $host."users/$id_user");

        $result_u = json_decode(curl_exec($curl));
        curl_close($curl);
        // echo 'До покупки № ' . $result->id_buy . ' користувача з id ' . $result->id_user . ' товар ' . $result_p->name;
        echo 'Користувач  ' . $result_u->login . ' до вашої покупки № ' . $id_buy .  ' додано товар '  . $result_p->name. ' за ціною '. $result_pr->price;

    }

}
?>

<?php
if($errMsg)
    echo $errMsg;
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">



    id продукту<br />
    <input type="text" name="id_product" value="<?=$id_product?>" /><br />

    <br />
    <input type="submit" value="Відправити дані" />
</form>
<a href="index.php">Закончить покупки</a>
