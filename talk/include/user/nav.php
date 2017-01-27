              <div id="nav">
                <ul>
                  <li><a href="/about.php">About</a></li>
                  <li><a href="/">Today's Tips</a></li>
                  <li><a href="/talk">Talk</a></li>
                  <li><a href="/top.php">Top Tips</a></li>                  
                </ul>
              </div>
              <div id="thetalk">
                What people are talking about: 
                <ul>
<?php include("http://loungetips.com/talk/extern.php?show=5&fid=2,16,3,4,5,9,6,7,10,11,12,17"); ?>
                </ul>
              </div>
              <div id="usernav">
                <ul>
<?php if ($forum_user['is_guest']) : ?>
                  <li><a href="/login.php">Login</a></li>
                  <li><a href="/register.php">Register</a></li>
<?php else: ?>
                  <li>Logged in as: <a href="/talk/user/<?php print $forum_user['id']; ?>"><?php print $forum_user['username']; ?></a></li>
                  <!-- forum_navlinks -->                  
                  <li><a href="/talk/logout/<?php print $forum_user['id']; ?>/<?php print generate_form_token('logout'.$forum_user['id']); ?>">Logout</a></li>
<?php endif; ?>                  
                </ul>
              </div>
