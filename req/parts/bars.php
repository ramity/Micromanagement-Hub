<div id="lsidebar">
  <div class="lsidebaritem"></div>
  <a href="">
    <div class="lsidebaritem">Dashboard</div>
  </a>
  <a href="">
    <div class="lsidebaritem">Social Hub</div>
  </a>
  <a href="">
    <div class="lsidebaritem">Food Tracker</div>
  </a>
  <a href="">
    <div class="lsidebaritem">Schedule Planner</div>
  </a>
  <a href="">
    <div class="lsidebaritem">Closet Inventory</div>
  </a>
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
