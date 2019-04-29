$(document).ready(function(){
    $("#queryTextbox").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("tr").filter(function() 
      {
          var excludeHeader = $(this).attr("id") == "headTr"; //Keeps header safe.
          if(!excludeHeader)
              $(this).toggle(($(this).text().toLowerCase().indexOf(value) > -1));
      });
    });
  });