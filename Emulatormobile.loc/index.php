<?php
/* Глобальна конфиігурація cURL */
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$host = "http://restapi.loc/";
/* Ініціалізація глобальних змінних */
$errMsg = $login = $password='';


/* Виконання методів POST (на створення) и PUT (на зміну) */
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    /* Перевірка заповнення полів форми */
    if(empty($_POST['login']) or empty($_POST['password'])){
        $errMsg = 'Заповніть поля!';

    }else{
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $host = "http://restapi.loc/";
        curl_setopt($curl, CURLOPT_URL, $host."users");
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        $password = $_POST['password'];
        foreach ($result as $user) {
            if ($user->login == $_POST['login'] && $user->password == hash('md5',"$password")){
                $user = [
                    'id_user' =>$user->id
                ];
                $str = base64_encode( serialize($user) );
                setcookie("user", $str);
                $_SESSION['user'] = true;
                header("Location: /buy.php");
            }
        }
        echo "Невірний логінчи пароль";
        }

}
?>

<?php
if($errMsg)
    echo $errMsg;
?>
<div style=" background-color: darkblue;color: white ;  margin-right: 80%; padding-bottom: 100px">
    <h1>Smart Basket <a  style="color: white; font-size: 50%; text-align: right " href= "en/index.php">EN</a></h1>
<div style="background-color: blue; color: white; padding-bottom: 150px;text-align: center">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    Логін <br />
    <input type="text" name="login" value="<?=$login?>" /><br />
    Пароль <br />
    <input type="password" name="password" value="<?=$password?>" /><br />



    <br />
    <input type="submit" value="Авторизація" />
</form>
</div>
</div>
