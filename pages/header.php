<?php
  $user = $_GET['user'];

  $navitem = array(
    // FOR NEW PAGES TO GET ADDED TO THE NAV BAR ADD THE FILE LIKE THIS
    // ALSO MAKE SURE THE FILE HAS 700 ACCCESS
    // chmod 700 [filename.php]
    "Home" => "homepage.php",
    "Groups" => "groups.php",
    "Template Page" => "newpage.php" // this should be taken out in the end product
  );
 ?>
<header>
  Truth or Dare! [Header]
</header>
<nav>
  <ul>
    <?php
      foreach ($navitem as $page => $location) {
        echo "<li><a href='$location?user=".$user."' ".($page==$currentpage?" class='active'":"").">".$page."</a></li>";
      }
     ?>
  </ul>
</nav>