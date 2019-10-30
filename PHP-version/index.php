<?php
  session_start();
  $email = '';
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = '*this email is already taked';
    set_action();
  }
  function set_action() {
    if( ( !empty($_POST['email']) && !empty($_POST['pass']) ) && !is_taked($_POST['email']) ) 
    { //if ok
      //write data to the session
      foreach ($_POST as $key => $value) { // https://www.formget.com/multi-page-form-php/
        if($key == 'submit') continue; //skip
        $_SESSION['post'][$key] = htmlspecialchars($value);
      }
      header('Location: ./form2.php');
    }
  }
  /**
   * Check email in database.
   * return true if found.
   */
  function is_taked($email) {
    //get json
    $file_path = './data/json.json';
    $json_file = file_get_contents($file_path);
    $json_file = json_decode($json_file, true);
    //collect all emails
    $data_emails = [];
    foreach ($json_file as $key => $value) {
      $data_emails[] = $value['email'];
    }
    //return needle from the haystack
    return in_array($email, $data_emails);
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Game of Thrones</title>
  <meta name="description" content="Game of Thrones registration form">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="./styles/index.css">
</head>

<body onload="registrationPart1()">
  <main>
    <section class="left-section">
    </section>
    <section class="right-section formOne"  id="formOne">
      <div class="reg_wrapper">
        <h1>Game of Thrones</h1>

        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="regForm loginForm" method="post" autocomplete="off">
          <label for="regEmail">Enter your email</label>
          <input type="email" placeholder="arya@westeros.com" name="email" id="regEmail" require><?='<span style = "color:tomato">'.$email.'</span>'; ?>
          <label for="regPass">Choose secure password</label>
          <div class="tips_text" id="alertPass">must be atleast 8 characters</div>
          <input type="password" placeholder="password" name="pass" id="regPass" require>
          <label class="container">
            <input type="checkbox" name="remember-me">
            <span class="checkmark"></span>
          </label>
          <div class="rememberMe">Remember me</div> 
          <input class="submit" type="submit" name="submit" value="Singn Up">
        </form>
      </div>
  </main>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./script/script.js" type="text/javascript"></script>
</body>

</html>