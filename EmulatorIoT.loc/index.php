<?php
/* Глобальна конфиігурація cURL */
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$host = "http://restapi.loc/";
/* Ініціалізація глобальних змінних */
$errMsg = $id = $id_shop='';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
/* Перевірка заповнення полів форми */
if(empty($_POST['id_user'])){
    $errMsg = 'Заповніть поля!';

}else{



        /* Відправлення даних методом POST */
        curl_setopt($curl, CURLOPT_URL, $host.'buys?fields=id_buy');

        $result = json_decode(curl_exec($curl));
        curl_close($curl);


$countBuy=0;
        foreach ($result as $buy){
            $countBuy=$buy->id_buy;

        }
echo ++$countBuy;
$arrBay = [
    'id_user' =>$_POST['id_user'],
    'id_buy' =>$countBuy,
    'id_shop' => $_POST['id_shop'],
];
$str = base64_encode( serialize($arrBay) );
setcookie("user", $str);
$_SESSION['user'] = true;
header("Location: /buy.php");}}
?>

<?php
if($errMsg)
    echo $errMsg;
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


    id користувача <br />
    <input type="text" name="id_user" value="<?=$id_user?>" /><br />
    id магазину<br />
    <input type="text" name="id_shop" value="<?=$id_shop?>" /><br />




    <br />
    <input type="submit" value="Відправити дані" />
</form>
