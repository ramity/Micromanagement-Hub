<div id="lsidebar">
  <div class="lsidebaritem"></div>
  <?php
  $sub_application_array=
  [
    [
      'name'=>'Dashboard',
      'url'=>'http://localhost/dashboard'
    ],
    [
      'name'=>'Social Hub',
      'url'=>'http://localhost/social/dashboard'
    ],
    [
      'name'=>'Food Tracker',
      'url'=>'http://localhost/food/dashboard'
    ],
    [
      'name'=>'Schedule Planner',
      'url'=>'http://localhost/schedule/dashboard'
    ],
    [
      'name'=>'Closet Inventory',
      'url'=>'http://localhost/closet/dashboard'
    ]
  ];

  foreach($sub_application_array as $sub_application)
  {
    if(isset($sub_application_selected)&&!empty($sub_application_selected)&&$sub_application_selected==$sub_application['name'])
    {
      echo '<a href="'.$sub_application['url'].'">';
        echo '<div class="lsidebaritemactive">';
          echo $sub_application['name'];
        echo '</div>';
      echo '</a>';

      if(isset($l_nav_array)&&!empty($l_nav_array))
      {
        foreach($l_nav_array as $l_nav_item)
        {
          echo '<a href="">';
            echo '<div class="lsidebarsubitem">asdfasdf</div>';
          echo '</a>';
        }
      }
    }
    else
    {
      echo '<a href="'.$sub_application['url'].'">';
        echo '<div class="lsidebaritem">';
          echo $sub_application['name'];
        echo '</div>';
      echo '</a>';
    }
  }
  ?>
</div>
<div id="rsidebar">
  <a href="">
    <div class="rsidebaritem"></div>
  </a>
  <a href="">
    <div class="rsidebaritem"></div>
  </a>
  <a href="">
    <div class="rsidebaritem"></div>
  </a>
  <a href="">
    <div class="rsidebaritem"></div>
  </a>
</div>
<div id="top">
  <a href="http://localhost/">
    <div id="toplogo">Ramity</div>
  </a>
  <?php
  if(isset($secure['login'])&&isset($secure['username'])&&$secure['login'])
  {
    echo '<div id="toplogin">';
    echo '<a href="http://localhost/logout">';
      echo '<div class="toploginbutton">logout</div>';
    echo '</a>';
      echo '<a href="http://localhost/">';
        echo '<div class="toploginbutton">'.$secure['username'].'</div>';
      echo '</a>';
    echo '</div>';
  }
  else
  {
    echo '<div id="toplogin">';
      echo '<a href="http://localhost/register">';
        echo '<div class="toploginbutton">Register</div>';
      echo '</a>';
      echo '<a href="http://localhost/login">';
        echo '<div class="toploginbutton">Login</div>';
      echo '</a>';
    echo '</div>';
  }
  ?>
</div>
