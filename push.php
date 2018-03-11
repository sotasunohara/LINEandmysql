<?php
 session_start();
 $japanesehour=60*9-5;//日本時間
 define("LINE_CLIENT_ID", "**");//クライアントID
 define("LINE_CLIENT_SECRET", "**");//チャンネルsecret

 ini_set('display_errors',1);
 //date_default_timezone_set('Asia/Tokyo');

 $dsn ='mysql:host=+++;dbname=***;charset=utf8';
 $user ='uuu';
 $password ='pass';
 //チャンネルシークレット（bot)
 $channelsecretbot='----';
 //チャンネルアクセストークン
 $channelaccessbot='----------+';

 require_once ("vendor/autoload.php");

 $i=0;


 try{
   $db = new PDO($dsn,$user,$password);
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $stmt= $db->prepare("SELECT robohon FROM position WHERE (cond=:br OR cond=:acc) AND(posted < NOW()+ INTERVAL :japanesehour MINUTE)");//時間による条件を付けたす,

   $stmt->execute([
     ':br'=>"brake",
   ':acc'=>"accel",
   ':japanesehour'=> $japanesehour
   ]);//'
   $robohon=null;
   while ($row = $stmt->fetchObject()){
     //危険運転があった車のロボホンidを格納
     $robohon[$i++]=$row->robohon;
    }
    if($robohon==null){
      echo "nothing";
      exit;
    }
    $robohon = array_unique($robohon);//重複をなくして詰める
    $robohon = array_filter($robohon, "strlen");
  //添字を振り直す
    $robohon = array_values($robohon);
    $userId=null;
    $countr=count($robohon);

       for($j=0;$j<$countr;$j++){//robohonidを持つlineユーザのuserIDを配列に格納
         $stmt = $db->prepare("SELECT userID from users where robohon=:robohon");
         $stmt ->execute(['robohon'=>$robohon[$j]]);
       }

       $k=0;
       while($row = $stmt->fetchObject()){
         $userId[$k]=$row->userID;
         $k++;
       }
       if($userId==null){//
         echo "nothing";
         exit;
       }
       //echo $userId[0];
       $userId = array_unique($userId);
    //配列の中の空要素を削除する
      $userId = array_filter($userId, "strlen");
    //添字を振り直す
      $userId = array_values($userId);
      $countrow=count($userId);

      $k=0;

      $text=
      "＝＝＝＝＝＝＝＝＝＝＝＝\r\n
      メッセージ
      　　＝＝＝＝＝＝＝＝＝＝＝＝";
      for($l=0;$l<$countrow;$l++){
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($channelaccessbot);
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelsecretbot]);
          $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
          $response = $bot->pushMessage($userId[$l], $textMessageBuilder);
           echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
         }
       }

 catch(PDOException $e){
   echo $e->getMessage();
   exit;
 }
