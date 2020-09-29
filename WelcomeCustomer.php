<!DOCTYPE html>
<html>
<head>
 <title>Catalog</title>
 <link rel="stylesheet" href="WelcomeStyle.css">
</head>




<body>


<audio id="windAudio">
  <source src="woodwind.mp3" type="audio/mp3">
Your browser does not support the audio element.
</audio>

<script type="text/javascript">
//Defining variable based on unique ID



//Example of an HTML Audio/Video Method
function playWindAudio() {

  var audio = document.getElementById("windAudio");

  audio.play();
}

function pauseWindAudio(){
    var audio = document.getElementById("windAudio");

  audio.pause();
}

</script>



<?php include("customerMenu.php"); ?>





<div class="main">

   <!--cards -->

  <div class="card">

    <div class="image">
      <img src="woodWind.jpg">
    </div>

    <div class="title">
      <h1> WoodWind </h1>
    </div>

    <div class="des">
      <p> Woodwind instruments: Common examples include flute, clarinet, oboe, saxophone...</p>
      <br/>
      <a href="CatalogPage.php?type=woodwind" onmouseenter = "playWindAudio()"  onmouseleave= "pauseWindAudio()"><button class = "catalogBtn"> See intruments</button></a>
    </div>

  </div>
  <!--cards -->


  <div class="card">

    <div class="image">
       <img src="string.jpg">
    </div>

    <div class="title">
      <h1> String</h1>
    </div>

    <div class="des">
      <p> String instruments: Common examples incule violin, viola, cello...</p>
      <br/>
      <a href="CatalogPage.php?type=string"  ><button class = "catalogBtn"> See intruments</button></a>
    </div>

  </div>
  <!--cards -->


  <div class="card">

    <div class="image">
        <img src="brass.jpg">
    </div>

    <div class="title">
        <h1>Brass</h1>
    </div>

    <div class="des">
      <p>Brass instruments: Common examples incule trumpet, tuba, trombone...</p>
      <br/>
      <a href="CatalogPage.php?type=brass"><button class = "catalogBtn"> See intruments</button></a>
    </div>

  </div>
  <!--cards -->


  <div class="card">

    <div class="image">
       <img src="percussion.jpg">
    </div>

    <div class="title">
      <h1>Percussion</h1>
    </div>

    <div class="des">
      <p>Percussion instruments: Common examples incule  drums, cymbals, chimes bells...</p>
      <br/>
      <a href="CatalogPage.php?type=percussion"><button class = "catalogBtn"> See intruments</button></a>
    </div>

  </div>

</div>

</body>
</html>

