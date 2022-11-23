$(document).ready(function () {
  $("#submit").click(function () {
    alert($("input:radio[name=fav_language]:checked").val());
    alert($("input:radio[name=age]:checked").val());
  });
});
