<html>

<head>
    <meta charset="utf-8">
    <style>
        
    </style>
    <title>GET練習</title>
</head>

<body>
    <div class="menu">
        <h3>斎藤特製ラーメンLine公式アカウントでの配信</h3>
        <ul>
            <li>お店名を入力</li>
            <li>評価内容を入力</li>
            <li>送信ボタンでライン配信</li>
        </ul>
   

 
        <form action="" method="post">
        <p> お店名: <input type="text" name="shopname"></p>
            <p>評価コメント: <input type="text" name="hyoka"></p>
            <p>評価点数</p>
            <p>⭐️⭐️⭐️⭐️⭐️<input type="radio" name="star" value="⭐️⭐️⭐️⭐️⭐️"></P>
            <p>⭐️⭐️⭐️⭐️<input type="radio" name="star" value="⭐️⭐️⭐️⭐️"></P>
            <p>⭐️⭐️⭐️<input type="radio" name="star" value="⭐️⭐️⭐️"></P>
            <p>⭐️⭐️<input type="radio" name="star" value="⭐️⭐️"></P>
            <p>⭐️<input type="radio" name="star" value="⭐️"></P>
            <input type="submit" name="submit" value="送信">
        
        
        </form> 

    
   

     </div>
   

</body>

</html> 


<?php 
if(isset($_POST['submit'])){
    //フォームデータを取得する
    $shopname = $_POST['shopname'];
    $hyoka = $_POST['hyoka'];
    $value = $_POST['star'];
    // if ($value) {
    //     echo "評価は". $value;
    // }
   

    
    //LINEに送るメッセージの構築
    $message = "お店名: $shopname\n評価内容: $hyoka\n評価: $value";
    lineBroadcast($message);

}

 
function lineBroadcast($text){
    $channelToken = 'eGUuYf8FRL8qRNAiL2YO5C3JnPJ0dhGoc9IC93Mg1hAOj55/CXddIm59jgJpr+jlIi5b+9ZK1+p/6aqepz0Y1PBF/I566D1kW1K79R6YK0+gUR0CDJHoPR+W6yQQwPsuoDuym4/DX1u0HIs8uO9YmAdB04t89/1O/w1cDnyilFU=';
    $headers = [
        'Authorization: Bearer ' . $channelToken,
        'Content-Type: application/json; charset=utf-8',
    ];
 
    $post = [
        'messages' => [
            [
                'type' => 'text',
                'text' => $text,
            ],
        ],
    ];
   
    $url = 'https://api.line.me/v2/bot/message/broadcast';
    $post = json_encode($post);
     
    $ch = curl_init($url);
    $options = [
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_BINARYTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_POSTFIELDS => $post,
    ];
    curl_setopt_array($ch, $options);
 
    $result = curl_exec($ch);
    $errno = curl_errno($ch);
    if ($errno) {
        print_r($errno);
    }else{
        echo '送信完了';
    }
}
?>
</body>
</html>