<head>
  <link rel="stylesheet" href="style.css">
  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>
</head>
<body>
  <nav class="topnav" id="myTopnav">
    <a href='pap.php' style="padding:0; background: none!important;"><img src="logo.png" alt="logoisp" class="logo"></a>
    <a style="  font-family: 'Krona One', sans-serif;"href='pap.php'>PAP</a>
    <a style="  font-family: 'Krona One', sans-serif;"href='form.php'>Dados</a>
    <a style="  font-family: 'Krona One', sans-serif;"href='creds.php'>Créditos</a>


  </nav>
</body>
