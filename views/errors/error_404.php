<html>

<head>
   <title>Le Repaire de la Moto - Error 404</title>
   <link href="/assets/error404.css" rel="stylesheet" type="text/css" />
   <link href="https://fonts.googleapis.com/css?family=Quicksand:500|Roboto|Mukta" rel="stylesheet">
   <link rel="shortcut icon" type="image/png" href="favicon.png" />
   <meta property="og:site_name" content="wave.ac" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<script>
   var textToShow = [
      "we've hit the limiter, boys!",
      "kimmywimmywu lead you down the wrong path!",
      "yikes, you've fallen way too deep!",
      "whoa there, watch your step!",
      "good game... good game.",
      "haha... we know, dude.",
      "that's the least of my worries."
   ];
   $(document).ready(function() {
      $("#rand-quote").html(
         textToShow[Math.floor(Math.random() * textToShow.length)]
      );
   });
</script>

<div id="bubbles"></div>
   
<body>
   <div id="app-mount">
      <div id="text-section">
         <p id="info">PAGE NOT FOUND</p>
         <p id="error">404</p>
      </div>

      <div id="links">
         <p id="rand-quote"></p>
      </div>

       <a id="back-to-safety" href="/views/accueil.php"><img src="https://cdn.discordapp.com/attachments/217459438452211722/367088105452339202/if_home_216242.png" draggable="false" id="home-ico" />Back to safety</a>
   </div>
</body>

</html>