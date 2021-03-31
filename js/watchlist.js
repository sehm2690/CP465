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


const http = require("https");

const options = {
	"method": "GET",
	"hostname": "apidojo-yahoo-finance-v1.p.rapidapi.com",
	"port": null,
	"path": "/market/v2/get-quotes?region=US&symbols=AMD%2CIBM%2CAAPL",
	"headers": {
		"x-rapidapi-key": "1351fd3e73mshf9c79221e8acff1p127f35jsn6272bcbd7b09",
		"x-rapidapi-host": "apidojo-yahoo-finance-v1.p.rapidapi.com",
		"useQueryString": true
	}
};

const req = http.request(options, function (res) {
	const chunks = [];

	res.on("data", function (chunk) {
		chunks.push(chunk);
	});

	res.on("end", function () {
		const body = Buffer.concat(chunks);
		console.log(body.toString());
	});
});

req.end();


 