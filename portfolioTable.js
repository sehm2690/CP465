/**
  Prototype code
  
  -Known issues:
    - The table sorter is using a string sort instead of a numeric sort as you would expect.
*/

$(document).ready(function() {
    addMarginGraph();
    $('.table2').tablesorter();
    $('.table3').tablesorter();
  });

  var statusColorGood = "rgba(121,216,121,1)";
  var statusColorMarginal = "rgba(255,242,61,1)";
  
  addMarginGraph = function() {
    $('.numbers .percent').each(function(e) {
      var percentage = parseFloat($(this).html());
      var color = "";
      if (percentage >= 0) {
        if (percentage >= 50) {
          color = statusColorGood;
        } else {
          color = statusColorMarginal;
        }
        $(this).css('background',"-webkit-linear-gradient(left, "+color+" 0%,"+color+" "+percentage+"%,rgba(255,255,255,0) "+(percentage+1)+"%,rgba(255,255,255,0) 100%)");
      } else {
        $(this).addClass('awful-highlight');
      }
    });
  }
    
  $('.publisher14').on('click', function(e) {
    $(this).next('tr').toggle('fast','swing');
  });
  
  $('body').on('click', 'h2', function(e) {
    $(this).find('i').toggleClass('icon-minus').toggleClass('icon-plus');
    $(this).next('table').toggle();
  });
  