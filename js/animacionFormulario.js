$(document).ready(function() {
  $(".signup-form").hide();
  $(".signup").css("background", "none");
  $(".signup").click(function(){
    $(".signup-form").show();
    $(".login-form").hide();
    $(".login").css("background", "none");
    $(".signup").css("background", "#fff");
  });
  $(".login").click(function(){
    $(".signup-form").hide();
    $(".login-form").show();
    $(".signup").css("background", "none");
    $(".login").css("background", "#fff");
  });
});
