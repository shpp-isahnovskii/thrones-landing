<?php
  session_start();
  if( empty($_SESSION['post']['email']) || empty($_SESSION['post']['pass']) ) {
    header('Location: ./index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Game of Thrones</title>
  <meta name="description" content="Game of Thrones registration form, part two">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="./styles/index.css">
  <link rel="stylesheet" href="./node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="./node_modules/owl.carousel/dist/assets/owl.theme.default.css">
</head>

<body onload="registrationPart2()">
  <main>
    <section class="left-section-form2">
    </section>
    <section class="right-section" id="formTwo">
      <div class="reg_wrapper">
        <h1>Game of Thrones</h1>
        <div class="header_tell_us">You've successfully joined the game.<br>Tell us more about yourself.</div>
        <form action="./form-success.php" method="post">
          <div class="regForm additionalForm">
            <label for="name">Who are you?</label>
            <div class="tips_text">Alpha-numeric username</div>
            <input type="text" id="name" placeholder="arya" name="name" required> <!--field 3-->
            <label for="house">Your Great House</label>
            <!-- <input type="text" placeholder="Select House" list="house" required> field 4 -->
            <select id="house" name='house'>
            </select>
            <label for="pref_hobby">Your preferences, hobbies, wishes, etc.</label>
            <input type="text" placeholder="I have long TOKILL list..." name="pref_hobby" required> <!--field 5-->
            <input class="submit" type="submit" name="submit" value="Save"> <!--submit 2-->
          </div>
        </form>
      </div>
    </section>
  </main>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<!-- add owl carousel script-->
<script src="./node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
<!-- User script -->
<script src="./script/script.js" type="text/javascript"></script>
</body>


</html>