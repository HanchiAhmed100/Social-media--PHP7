<?php 
  include_once'classe/login.class.php';
  include_once'classe/amis.class.php';
  include_once'classe/notification.class.php';
  $get = new login();
  $notification = new notification();
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="style\bootstrap.min.css">
    <link rel="stylesheet" href="style\font-awesome.min.css">
    <link rel="stylesheet" href="style\style1.css">
    <link rel="stylesheet" href="style\iziToast.min.css">
    <link rel="stylesheet" href="style\iziModal.min.css">
    <link rel="stylesheet" href="style\alertify.min.css">
  </head>
  <body>
    <section id="profile">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li id="nProfile"><?php $t = $_SESSION['id']; echo("<a href=\"profile.php?u=$t\">")?>    <?php echo($_SESSION['nom'])." ".($_SESSION['prenom']);?>       <img src=<?php echo $_SESSION['pPic']; ?> class='img img-circle' width='25px'></a></li>
              <li id="nAcceuil"><a href="acceuil.php">Acceuil</a></li>
              <li id="nMessages"><a href="messages.php"><i class="fa fa-envelope"></i></a></li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users"><?php echo($get -> getFriendRequests($_SESSION['id']));?></i></a>
                <ul class="dropdown-menu" id="invitations">
                  
                </ul>
              </li>
             <li id="nGames"><a href="games.php"><i class="fa fa-gamepad"></i></a></li>
              <li><a href="recherche.php"><i class="fa fa-search"></i></a></li>
              <li><a href="#"><i id="nNotifications" class="fa fa-bell" onclick="$.post('assets/setNotificationsSeen.php',{},function(a,b,c){})"></i></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="assets/logout.php"><i class="fa fa-sign-out"></i>   Deconexion</a></li>
                  <li><?php $t = $_SESSION['id']; echo("<a href=\"editcompt.php?u=$t\">")?><i class="fa fa-cog"></i> Parametre</a></li>
                  <li><a href="#"><i class="fa fa-exclamation-circle"></i>   Signaler un probleme</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>


