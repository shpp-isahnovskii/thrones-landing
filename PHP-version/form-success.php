<?php 
  session_start();
  
  if(!isset($_SESSION['post']['name'])
  || !isset($_SESSION['post']['house'])
  || !isset($_SESSION['post']['pref_hobby']) 
  || !isset($_SESSION['post']['email'])
  || !isset($_SESSION['post']['pass']) ) 
  {
  //u konw nothing user unnamed
  header('Location: ./index.php');
  } else {
   /*
    * SESSION is full of date now. We can take name and create data json.
    * Then we can push all data inside.
    * */
    add_new_user();
    $users_array = jsons_to_array();
    $users_table = load_html_table($users_array);

    unset($_SESSION['post']);
  }


  function add_new_user() {
    $file_name =& $_SESSION['post']['email']; //email as file name
    $file_path = './data/'.$file_name.'.json';
    $file_data = get_session_data();
    file_put_contents($file_path, json_encode($file_data, true)); //add user like json file in some folder
  }

  //Make an array and returns it. Skip first element (email).
  function get_session_data() {
    $result = [];
    foreach ($_SESSION['post'] as $key => $value) {
      if($key == 'email') continue;
      $result[$key] = $value;
    }
    return $result;
  }


  /**
   * Function:
   * 1) scan dir
   * 2) get data from all files add them to data_arr
   * 3) add key => val for email to this array
   * 4) return array of data
   */
  function jsons_to_array() {
    $directory = './data/';
    $files = array_diff( scandir($directory), array('..', '.') ); //exxample: https://www.php.net/manual/ru/function.scandir.php - first comment
    $data_arr = [];

    foreach ($files as $file) {
      $file_name = basename($file, '.json');
      $json_file = file_get_contents($directory.$file);
      $json_file = json_decode($json_file, true);
      $json_file['email'] = $file_name;

      $data_arr[] = $json_file;
    }
    return $data_arr;
  }

  /**
   * get array of data and return it like a table
   */
  function load_html_table($file) {
    $table = "";
    $index = 1;
    foreach ($file as $key => $value) {
      $table .= 
      '<tr>
        <td>'.$index.'</td>
        <td>'.$value['name'].'</td>
        <td><img src="./source/images/after-reg/'.$value['house'].'.png" alt="house img"></td>
        <td>'.$value['pref_hobby'].'</td>
        <td>'.$value['email'].'</td>
      </tr>';
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
              <th>house</th>
              <th>hobby</th>
              <th>email</th>
            </tr>
            <?php 
            echo $users_table;
            ?>
          </table>

      </div>
    </section>
  </body>
  
</html>