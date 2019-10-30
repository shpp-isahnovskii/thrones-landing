<?php 
  session_start();

  if(!isset($_POST['name'])
  || !isset($_POST['house'])
  || !isset($_POST['pref_hobby']) 
  || !isset($_SESSION['post']['email'])
  || !isset($_SESSION['post']['pass']) ) 
  {
  header('Location: ./index.php');
  } else {
    foreach ($_POST as $key => $value) {
      if($key == 'submit') continue;
      $_SESSION['post'][$key] = htmlspecialchars($value);
    }

    $json = write_json();
    $users = load_users($json);
    unset($_SESSION['post']);
  }

  function write_json() {
    //get json
    $file_path = './data/json.json';
    $json_file = file_get_contents($file_path);
    $json_file = json_decode($json_file, true);
    
    //prepare data
    $user_data = $_SESSION['post'];
    array_push($json_file, $user_data); //push new information to user data

    $new_json_file = json_encode($json_file, true);
    file_put_contents($file_path, $new_json_file);

    return $json_file; //return not encoded but updated json
  }

  /**
   * get array of data and return it like a table
   */
  function load_users($file) {
    $table = "";
    $index = 1;
    foreach ($file as $key => $value) {
      $table .= '<tr><td>'.$index.'</td><td>'.$value['name'].'</td><td>'.$value['house'].'</td><td>'.$value['pref_hobby'].'</td><td>'.$value['email'].'</td></tr>';
      $index++;
    }
    return $table;
  }

?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
  </head>
  <body style="background-color: black">
    <section>
      <h1>The winter is coming!</h1>
      <div class ='users__wrapper'>

          <table class='users'>
            <tr>
              <th>id</th>
              <th>name</th>
              <th>house(bugged)</th>
              <th>hobby</th>
              <th>email</th>
            </tr>
            <?php 
            echo $users;
            ?>
          </table>

      </div>
    </section>
  </body>
  
</html>