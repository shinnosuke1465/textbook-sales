import $ from 'jquery';

$(document).ready(function() {
    $(".js-drop-target").on("click", function() {
      var dropdownMenu = $(".js-drop");
      if (dropdownMenu.css("display") === "none") {
        dropdownMenu.css("display", "block");
      } else {
        dropdownMenu.css("display", "none");
      }
    });
  });
