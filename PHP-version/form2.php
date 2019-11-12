<?php
  session_start();
  if( empty($_SESSION['post']['email']) || empty($_SESSION['post']['pass']) ) {
    header('Location: ./index.php');
  }

  $nick_name = $house = $hobby = '';
  $nick_name_err = $house_err = $hobby_err = '';
  $houses = [0,1,2,3,4,5]; //houses available choise

  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $nick_name = $_POST['name'];
    $house = $_POST['house'];
    $hobby = $_POST['pref_hobby'];


    $nick_regexp = '/^[\w]+$/';
    $nick_name_err = preg_match($nick_regexp, $nick_name) ? '' : '* invalid nick-name, please use alphabet characters';

    $house_check = in_array($house, $houses);

    $hobby_regexp = '/^[\w ]+$/'; //add space symbol
    $hobby_err = preg_match($hobby_regexp, $hobby) ? '' : '* only alphabet characters alloved';

    if($nick_name_err === '' && $house_check && $hobby_err === '') {
      save_and_go('Location: ./form-success.php');
    }
  }
  //add data to session and go to the some page
  function save_and_go($page_to_go) {
    //write data to the session.  
    foreach ($_POST as $key => $value) {
      if($key == 'submit') continue; //skip
      $_SESSION['post'][$key] = htmlspecialchars($value);
    }
    header($page_to_go);
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

<body onload="registrationPart2()"> <!-- carousel downloading by this js function -->
  <main>
    <section class="left-section-form2">
    </section>
    <section class="right-section" id="formTwo">
      <div class="reg_wrapper">
        <h1>Game of Thrones</h1>
        <div class="header_tell_us">You've successfully joined the game.<br>Tell us more about yourself.</div>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
          <div class="regForm additionalForm">
            <label for="name">Who are you?</label>
            <div class="tips_text">Alpha-numeric username</div>
            <input type="text" id="name" placeholder="arya" name="name" value="<?php echo $nick_name; ?>"> <!--field 3-->
            <span class='error'><?php echo $nick_name_err?></span>
            <label for="house">Your Great House</label>
            <!-- <input type="text" placeholder="Select House" list="house" required> field 4 -->
            <select id="house" name='house'>
            </select>
            <label for="pref_hobby">Your preferences, hobbies, wishes, etc.</label>
            <input type="text" placeholder="I have long TOKILL list..." name="pref_hobby" value="<?php echo $hobby?>"> <!--field 5-->
            <span class='error'><?php echo $hobby_err?></span>
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