<?php
  session_start();
  //Example of form-making: https://www.w3schools.com/php/php_form_complete.asp
  $email_err = $pass_err = '';
  $email = $pass = '';

  if($_SERVER["REQUEST_METHOD"] == "POST") { //request_method mean - submited once

    //this vars contain data to validate 
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    //this vars contain errors to show. Here is to function: email and pass_checker - they return some stings.
    $email_err = email_cheker($email);
    $pass_err = pass_checker($pass);

    if( $email_err === '' && $pass_err === '' ) { // '' = no errors
      save_and_go('Location: ./form2.php');
    }
  }

  /**
   * Function has 3 filters: empty, valid, exist. 
   * If all 3 passed return: ''.
   */
  function email_cheker($email) {
    if( empty($email)  ) { // empty ? 
      return '* email have empty value';
    }
    if( !valid_file_name($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) ) {// valid ?
      return '* your email is not valid';
    }
    if ( is_taken($email) ) {// exist ?
      return '* your email is already exist';
    }
      return '';
  };

  /**
   * return true if input value can be a file name
   */
  function valid_file_name($email) {
    $regexp = '/^[0-9a-zA-Z_\-.@]+$/';
    return preg_match($regexp, $email);
  }

  /** Check email in database, return true if found.
   * @param email string in the email format
   */
  function is_taken($email) {
    $file_path = './data/'.$email.'.json';
    return file_exists($file_path) ? true : false; 
  }

  /**
   * Pass checker. Ok.. they said it need be only 8 char thats all
   */
  function pass_checker($pass) {
    $regexp = '/([a-zA-Z!@#\$%\^&\*\d]){8,}/';   //(little, big, symbols, digits) >= 8
    return preg_match($regexp, $pass) ? '' : '* password must be 8 or more characters length';
  }

  /**
   * Write data to the session for the next form
   */
  function save_and_go($page_to_go) {
    //write data to the session.  
    foreach ($_POST as $key => $value) { // https://www.formget.com/multi-page-form-php/
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
  <meta name="description" content="Game of Thrones registration form">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="./styles/index.css">
</head>

<body>
  <main>
    <section class="left-section">
    </section>
    <section class="right-section formOne"  id="formOne">
      <div class="reg_wrapper">
        <h1>Game of Thrones</h1>

        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="regForm loginForm" method="post" autocomplete="off">
          <label for="regEmail">Enter your email</label>
          <input type="text" placeholder="arya@westeros.com" name="email" id="regEmail" value ="<?php echo $email ?>">
          <span class ="error"><?php echo $email_err; ?></span>
          <label for="regPass">Choose secure password</label>
          <div class="tips_text" id="alertPass">must be atleast 8 characters</div>
          <input type="password" placeholder="password" name="pass" id="regPass" value ="<?php echo $pass ?>">
          <span class ="error"><?php echo $pass_err; ?></span>
          <label class="container">
            <input type="checkbox" name="remember-me">
            <span class="checkmark"></span>
          </label>
          <div class="rememberMe">Remember me</div> 
          <input class="submit" type="submit" name="submit" value="Singn Up">
        </form>
      </div>
  </main>
</body>
</html>