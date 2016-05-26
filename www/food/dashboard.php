<?php require_once('D:/wamp/www/req/modules/auth.php');?>
<!DOCTYPE html>
  <head>
    <title>Ramity Hub</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/food.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <?php
    $sub_application_selected='Food Tracker';
    require_once('D:/wamp/www/req/parts/mainui.php');
    ?>
    <div id="container">
      <div id="containerinr">
        <div class="displayheader">Food Dashboard</div>
        <div class="displayitem">
          <div class="displayitemheader">Food Log</div>
          <table class="foodlog">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Calories</th>
                <th>Meal Number</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $rand=rand(5,15);
              for($z=0;$z<$rand;$z++)
              {
                echo '<tr>';
                  echo '<td>';
                    echo '<a href="">';
                      echo 'Generic Food Name Here';
                    echo '</a>';
                  echo '</td>';
                  echo '<td>';
                    echo '<a href="">';
                      echo rand(300,900);
                    echo '</a>';
                  echo '</td>';
                  echo '<td>';
                    echo '<a href="">';
                      echo rand(0,5);
                    echo '</a>';
                  echo '</td>';
                echo '</tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="displayitem">
          <div class="displayitemheader"></div>
        </div>
      </div>
    </div>
  </body>
</html>
