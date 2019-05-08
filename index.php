<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link href="~bulma-calendar/dist/css/bulma-calendar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                    <link rel="stylesheet" href="/resources/demos/style.css">
                    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="~bulma-calendar/dist/js/bulma-calendar.min.js"></script>

    <link rel="stylesheet" href="styleForHome.css">
  </head>
  <body>




  <!-- NAVBAR -->
  <div class="navbar">
      <div class="container">
          <div class="logo is-left">
              <!-- navbar start da bude logo na lijevoj strani -->
              <a class="navbar-item navbar-end is.left" href="index.html">
                  <img src="./slike/apartment-03.png" alt="">
              </a>
          </div>

          <a class="navbar-item" onclick="myFunction()"> Izaberi Lokaciju
          </a>
          <div id="div">
              <div class="flex-container">                    
                  <ul class="title-in-box box-left"> Izaberi Lokaciju:
                      <li class="subtitle-in-box"> <a href="">Sarajevo </a></li>
                      <li class="subtitle-in-box"> <a href="">Zenica </a></li>
                      <li class="subtitle-in-box"> <a href="">Bihac </a></li>
                  </ul>
                
                  <ul class="title-in-box box-right">
                     Uskoro nas mozete pronaci i u 
                      <li class="subtitle-in-box"> <a href="">Tuzla</a></li>
                      <li class="subtitle-in-box"> <a href="">Mostar</a></li>
                      <li class="subtitle-in-box"> <a href="">Banja Luka</a></li>
                  </ul>
              </div>
          </div>

          <a href="" class="navbar-item"> Offers
          </a>
          <a href="" class="navbar-item"> Contact Us
          </a>
          <div class="is-right">
              <?php  if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="home.html?logout='1'" style="color: red;">logout</a> </p>
               <?php endif ?>
          </div>
      </div>
  </div>


  <!-- MAIN PAGE IMAGE/VIDEO-->
  <section class="hero main-image">
      <div class="overlay"></div>
      <div id="title" class="container text has-text-centered">
          <h1 class="title">
              Lorem ipsum dolor sit amet, cons ectetuer adipiscing </h1>
          <p class="sub-title main">
              Lorem ipsum dolor sit amet, cons ectetuer adipiscing
              elit, sed diam nonummy nibh euismod tincidunt ut
          </p>

          <div class="bubble-container has-text-centered">
              <div class="columns has-text-centered">
                  <div class="column is-one-fourth  ">
                      <input class="form-control1" type="text" placeholder="Unesi Adresu">
                      <span class="form-label">Lokacija</span></div>
                  <div class="column">
                      <div class="form-group">
                          <select class="form-control">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                          </select>
                          <span class="select-arrow"></span>
                          <span class="form-label">Broj Soba</span>
                      </div>
                  </div>
                  <div class="column">
                      <div class="form-group">
                          <select class="form-control">
                              <option>0</option>
                              <option>1</option>
                              <option>2</option>
                          </select>
                          <span class="select-arrow"></span>
                          <span class="form-label">Broj Kupatila</span>
                      </div>
                  </div>
                  <div class="column">
                    
                    <script>
                    $( function() {
                      $( "#slider-range" ).slider({
                        range: true,
                        min: 0,
                        max: 100000,
                        values: [ 0, 10000 ],
                        slide: function( event, ui ) {
                          $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                        }
                      });
                      $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                        " - $" + $( "#slider-range" ).slider( "values", 1 ) );
                    } );
                    </script>
                  </head>
                  <body>
                   
                  <p>
                    <label for="amount">Price range:</label>
                    <input type="text" id="amount" readonly style="border:0; color:#184c8f; font-weight:bold;">
                  </p>
                   
                  <div id="slider-range"></div>
                   
                        <span class="select-arrow"></span>
                        <span class="form-label">Cijena min-max</span>
                    </div>
                </div>
                <div class="column">
                    <div class="form-btn">
                        <button class="submit-btn">Check availability</button>
                    </div>
                </div>
              </div>
            
                 

              </div>
          </div>

  </section>




</body>


<script>
  function myFunction() {
      var x = document.getElementById("div");
      var y = document.getElementById("div1");
      if (x.style.display === "block") {
          x.style.display = "none";
      } else {
          x.style.display = "block";
          y.style.display = "none";
      }
  }

  function myFunction2() {
      var x = document.getElementById("div");
      var y = document.getElementById("div1");

      if (x.style.display === "block") {
          x.style.display = "none";
          y.style.display = "block";
      } else if (y.style.display === "none") {
          y.style.display = "block";
      } else if (y.style.display === "block") {
          y.style.display = "none";
      }
  }
</script>

<script>
$(document).ready(function(){
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll > 100) {
          $(".navbar").css("background" , "white");
        }
  
        else{
            $(".navbar").css("background" , "transparent");  	
        }
    })
  })

</script>
</html>