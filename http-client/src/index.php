<html>
<head>
 <title>Best forecasting ever</title>
</head>
<body>
 <h2>Forecasting</h2>
 <h3>First date, last date and color:</h3>
 <?php
    if (isset($_POST['first']) && isset($_POST['second']) && isset($_POST['third'])){
        $myCurl = curl_init();
        curl_setopt_array($myCurl, array(
              CURLOPT_URL => 'http://nginxserver/api/?a='.$_POST['first'].'&b='.$_POST['second'].'&c='.$_POST['third'],
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_HEADER => false,
        ));
        $response = curl_exec($myCurl);
        curl_close($myCurl);
        $response_array = json_decode($response, true);
        // var_dump($response_array);
        $base64_code = $response_array['byte_code'];
        $encoding = $response_array['encoding'];
        // echo $base64_code;
        $image_path = "./your_forecast.jpg";//путь к картинке относительный
        $image_path_full= "/var/www/html/your_forecast.jpg"; // абсолютный путь к картинке
        $fp = fopen($image_path_full, "w+");// открытие файла на запись[30]
        fwrite($fp, base64_decode($base64_code)); //запись в файл декодированных байтов[31]
        fclose($fp);// закрытие файла

        // echo "Ответ на Ваш запрос: ".$response;
    }
 ?>
 <form action="index.php" method="post">
 <label for="first_date">First date </label>
 <input type="text" name="first" id="first" required>
 <label for="last_date">Last date </label>
 <input type="text" name="second" id="second" required>
 <label for="color">Color </label>
 <input type="text" name="third" id="third" required>
 <input type="submit" value="GET GRAPHIC!">
 </form>
 <h3>Here appears your graphic or error</h3>
 <?php
    $lolkek = "Error";
    if (strpos($response, $lolkek) !== false) {
        echo $response;
    } else {
        echo '<img src="'.$image_path.'" width="700" height="500">';
    }
 ?>
</body>
</html>
