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
    $l_nav_item_selected='Planner';
    $sub_application_selected='Food Tracker';
    require_once('D:/wamp/www/req/parts/mainui.php');
    ?>
    <div id="container">
      <div id="containerinr">
        <div class="displayheader">Food Dashboard</div>
        <div class="displayitem">
          <div class="displayitemheader">Planner</div>
          <table class="calendar">
            <thead>
              <tr>
                <?php
                $days=
                [
                  'Sunday',
                  'Monday',
                  'Tuesday',
                  'Wednesday',
                  'Thursday',
                  'Friday',
                  'Saturday',
                ];

                foreach($days as $day)
                {
                  echo "<th>$day</th>";
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              if(isset($_GET['month'])&&isset($_GET['year']))
              {
                $year=$_GET['start'];
                $month=$_GET['days'];
              }
              else
              {
                $calendar_start=(new DateTime('first day of this month'))->format('D');
                $calendar_steps=(new DateTime('last day of this month'))->format('d');
              }

              $date_num=1;

              for($z=0;$z<=5;$z++)
              {
                echo '<tr>';
                for($x=0;$x<count($days);$x++)
                {
                  if(strpos($days[$x],$calendar_start)!==false&&$z==0)
                  {
                    echo '<td>'.$date_num.'</td>';
                    $date_num++;
                  }
                  elseif($date_num==1)
                  {
                    echo '<td>...</td>';
                  }
                  else
                  {
                    if($date_num>$calendar_steps)
                    {
                      $date_num=1;
                    }
                    echo '<td>'.$date_num.'</td>';
                    $date_num++;
                  }
                }
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
