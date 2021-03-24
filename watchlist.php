<?php
    include_once'header.php'
?>

<main>
<link rel='stylesheet' href='css/watchlist.scss' /> 
<link rel='stylesheet' href='css/style.css' />

<head>
<!-- 
<script src=
;(function($) { 
        $.fn.fixMe = function() {
        return this.each(function() {
            var $this = $(this),
                $t_fixed;
            function init() {
                $this.wrap('<div class="container" />');
                $t_fixed = $this.clone();
                $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
                resizeFixed();
            }
            function resizeFixed() {
                $t_fixed.find("th").each(function(index) {
                    $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
                });
            }
            function scrollFixed() {
                var offset = $(this).scrollTop(),
                tableOffsetTop = $this.offset().top,
                tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
                if(offset < tableOffsetTop || offset > tableOffsetBottom)
                    $t_fixed.hide();
                else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
                    $t_fixed.show();
            }
            $(window).resize(resizeFixed);
            $(window).scroll(scrollFixed);
            init();
        });
        };
    })(jQuery);
    
    $(document).ready(function(){
        $("table").fixMe();
        $(".up").click(function() {
        $('html, body').animate({
        scrollTop: 0
        }, 2000);
    });
    });
></script> -->

 
</head>


<form id="form"> 
  <input type="search" id="query" name="q" placeholder="Search...">
  <button>Add</button>
</form>


<!-- <h1>&darr; SCROLL &darr;</h1> -->
<table class="blue">
  <thead>
    <tr>
      <th>Stock Name</th>
      <th>Last Price</th>
      <th>Change</th>
      <th>% Change</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>

    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>

    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    <tr>
      <td>DBX</td>
      <td>27.06</td>
      <td>1.61</td>
      <td>6.33</td>
    </tr>
    
  </tbody>
</table>

<!-- <h1 class="scrollMore">&darr; SCROLL MORE &darr;</h1> -->
<table class="purple">
  <thead>
    <tr>
      <th>Stock Name</th>
      <th>Last Price</th>
      <th>Change</th>
      <th>% Change</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
    <tr>
      <td>JWN</td>
      <td>41.37</td>
      <td>3.97</td>
      <td>10.61</td>
    </tr>
  </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://dannocket.com/sandbox/IvtpK.js"></script>
<script src="js/watchlist.js"></script>
       
</main>

<?php
    include_once'footer.php'
?>