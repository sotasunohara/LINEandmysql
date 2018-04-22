<?php
  session_start();
  date_default_timezone_set('Asia/Tokyo');
  ini_set('display_errors', "On");
  require_once ("Facebook/autoload.php");
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <title>speaCAR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!--link rel="icon" href="/speacar/img/favicon.icon" type="image/x-icon"-->
  <!--link rel="icon" href="/speacar/img/weblogo.png" type="image/x-icon"-->
  <!--link rel="shortcut icon" href="/speacar/img/favicon.ico" type="image/x-icon" /-->
  <link rel="shortcut icon" href="/speacar/img/weblogo.png" type="image/x-icon"/>
  <meta name="description" content="Your description">
  <meta name="keywords" content="Your keywords">
  <meta name="author" content="Your name">

  <link rel="stylesheet" href="/speacar/css/bootstrap.css" type="text/css" media="screen">
  <link rel="stylesheet" href="/speacar/css/responsive.css" type="text/css" media="screen">
  <link rel="stylesheet" href="/speacar/css/style.css" type="text/css" media="screen">
  <link rel="stylesheet" href="/speacar/css/start.css" type="text/css" media="screen">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
  <!--script type="text/javascript" src="/speacar/js/jquery.js"></script>
  <script type="text/javascript" src="/speacar/js/superfish.js"></script>
  <script type="text/javascript" src="/speacar/js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="/speacar/js/jquery.cookie.js"></script>
  <script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='/speacar/js/jquery.preloader.js'></"+"script>");}</script>
  <script>
  jQuery(window).load(function(){
    $x = $(window).width();
    if($x > 1024)
    {
      jQuery("#content .row").preloader();
    }
      jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});
    });
  </script-->
</head>
<body>

  <header>
  <div class="container clearfix fixed-top">
      <div class="row">
        <div class="span12">
          <div class="navbar navbar_">
            <!--div class="container"-->
              <h1 class="brand brand_"><img alt="" src="/speacar/img/logo.png"class="imageresponsive"></h1>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="bg-content">
    <div class="container">
      <div class="back">
      <div class="backImage">
        <div class="layerTransparent">
        <div class="frontContents">
          <div class="logom"><img alt="" src="/speacar/img/logo.png"></div>
          <h3>交通事故からあなたをまもります！</h3>
        </div>
      </div>
      </div>
    </div>
        <center><input type="image" name="image_button" src="/speacar/img/line.png" onclick=location.href="login/line_login.php">
          <?php
          $fb = new Facebook\Facebook([
             'app_id' => '1295720377195908', // Replace {app-id} with your app id
             'app_secret' => '5aa3d70e8f88af6310671a6ecb079431',
             'default_graph_version' => 'v2.2',
             ]);

           $helper = $fb->getRedirectLoginHelper();

           $permissions = ['email']; // Optional permissions
           $loginUrl = $helper->getLoginUrl('https://robotdrive.azurewebsites.net/fb-callback.php', $permissions);

           echo '<a class="FbBtn" href="' . htmlspecialchars($loginUrl) . '">
            <div class="FbBtnLabel">Log in with Facebook!</div>
           </a>';
           ?>
        </center>

      </div>
    </div>

</body>
</html>
