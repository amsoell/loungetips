            </div>
          </div>
        </div>
      </div>
<?php      
    print '<div class="online">';
    include("http://loungetips.com/talk/extern.php?action=online_full");
    print '</div>';
?> 
      
      <div id="footer">
<?php
  $sqlx = "SELECT COUNT(id) AS totaltips FROM tips";
  $rs = mysql_query($sqlx);
  $rec = mysql_fetch_array($rs);
  $totaltips = floor($rec['totaltips']);
?>
        <span style="float:left;">Copyright &copy; <?php print Date('Y'); ?> &mdash; Lounge Tips: <?php print $totaltips; ?> Tips Shared and Counting! &middot; LoungeTips.com is NOT affiliated with CD102.5.</span>
        <span style="float:right;"><a href="http://twitter.com/loungetips" target="_blank">Follow us on Twitter</a> &middot; <a href="javascript:(function()%20{%20window.open('http://loungetips.com/quickentry.php','sharer','toolbar=0,location=0,directories=0,status=0,resizable=0,width=525,height=100');%20})();">Bookmarklet</a> &middot; <a href="/feed.rss">RSS</a></span>
      </div>
    </div>
<script type="text/javascript"> 
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript"> 
try {
var pageTracker = _gat._getTracker("UA-8588127-1");
pageTracker._trackPageview();
} catch(err) {}</script>     
<script type="text/javascript">
/*
  var GoSquared = {};
  GoSquared.acct = "GSN-052266-E";
  (function(w){
    function gs(){
      w._gstc_lt = +new Date;
      var d = document, g = d.createElement("script");
      g.type = "text/javascript";
      g.src = "//d1l6p2sc9645hc.cloudfront.net/tracker.js";
      var s = d.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(g, s);
    }
    w.addEventListener ?
      w.addEventListener("load", gs, false) :
      w.attachEvent("onload", gs);
  })(window);
*/
</script>
