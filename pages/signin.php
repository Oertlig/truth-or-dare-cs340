<?php
session_start();

// If the user is already logged in, redirect them to the landing page.
if (isset($_SESSION['username'])) {
    header("Location: homepage.php"); // TODO this is not working
	die();
}
?>
<html>
<head>
<title>Login</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

function err(x) {
    $("#resp-err").html(x);
    $("#resp-err").css("visibility", "visible");
}
function valid() {
	v = true; // make false if any errors visible
	if (!$("input[name='username']").val()) {
		$("input[name='username']").addClass("invalid");
		$("#username-err").html("Please enter your username");
		$("#username-err").css("visibility", "visible");
		v = false;
	} else {
		$("input[name='username']").attr("class", "");
		$("#username-err").css("visibility", "hidden");
	}
	if (!$("input[name='password']").val()) {
		$("input[name='password']").addClass("invalid");
		$("#pass-err").html("Please enter a password");
		$("#pass-err").css("visibility", "visible");
		v = false;
	} else {
		$("input[name='password']").attr("class", "");
		$("#pass-err").css("visibility", "hidden");
	}
	return v;
}

function handle(x) {
	switch (x.trim()) {
        case "invalid_password":
            $("#pass-err").html("Invalid password");
            $("#pass-err").css("visibility", "visible");
            break;
        case "username_not_registered":
            $("#username-err").html("Username not registered");
            $("#username-err").css("visibility", "visible");
            break;
        case "invalid_username":
            $("#username-err").html("Invalid username");
            $("#username-err").css("visibility", "visible");
            break;
    }
}

$("document").ready(function() { // have to do everything when the document is loaded
    $("#login-button").on("click", function(e) {

    if (!valid())
        return false;

    var form = $("#attempt-login");

    var dat = {};

    form.serializeArray().map(function(x){dat[x.name]=x.value;});

        $.ajax({
            type: "POST",
            url: "login.php",
            data: JSON.stringify(dat),
            success: function(resp) {
                console.log(resp);
                if (resp == "success") {
                    window.location.replace("homepage.php");
                }
                else {
                    handle(resp);
                }
            }
        });
        return false;
    });
});
</script>
<style>
body {
	font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
    margin: 0;
    background-color: #192841;
	background-image: linear-gradient(to top right, #3dc431, #192841);
}
#login-form {
	margin-top: 250px;
}
#resp-err {
    visibility: hidden;
}

#attempt-login {
    margin: 0;
    margin-top: 44px;
    text-align: center;
}
#login-panel {
	box-shadow: 0 4px 20px -4px #555;
    position: absolute;
    top: 450px;
    margin-top: -240px;
    right: 15%;
    background-color: #fff;
    width: 320px;
    height: 450px;
    border: 1px solid #fff;
}
#attempt-login>input[type=text] {
    color: #111;
    width: 240px;
    height: 34px;
    border: 1px #666 solid;
    margin-bottom: 10px;
    border-radius: 4px;
    padding: 4px 6px;
}
#attempt-login>input[type=password] {
    color: #111;
    width: 240px;
    height: 34px;
    border: 1px #666 solid;
    margin-bottom: 10px;
    border-radius: 4px;
    padding: 4px 6px;
}
#attempt-login>input[type=submit] {
    border-radius: 4px;
    border: none;
    background-color: #4da845;
    width: 72px;
    height: 32px;
    color: #fff;
    margin-top: 10px;
}
#attempt-login>a {
	display: block;
	font-size: 14px;
	margin-top: 20px;
}
#attempt-login>span {
	display: block;
	margin-bottom: -16px;
}
#app-promo-bar {
    position: absolute;
    top: 820px;
    width: 100%;
    text-align: center;
}
#app-promo-bar>img {
    height: 64px;
    margin-left: 24px;
}
#logo {
    position: absolute;
    top: 200px;
    left: 10%;
    color: #fff;
    font-size: 80px;
	font-weight: bold;
}
#flavor {
    position: absolute;
    top: 280px;
    left: 10.25%;
    color: #fff;
    font-size: 32px;
	font-weight: bold;
}
.err {
	visibility: hidden;
	display: inline-block;
	width: 100%;
	margin-left: 42px;
	text-align: left;
	color: #AA0B00;
	font-size: 14px;
}
.invalid {
	border: 1px solid #AA0B00 !important;
}
.invalid::placeholder {
    color: #AA0B00;
}
</style>
</head>
<body>
<span id="logo">Truth or Dare</span>
<span id="flavor">Challenge your friends.</span>
<div id="login-panel">
<form id="attempt-login">
    <span style="font-size: 24px;">Sign In</span><br>
    <!-- <span class="err" id="resp-err">!</span><br> -->
    <span class="err" id="username-err">!</span><br>
    <input type="text" name="username" placeholder="Username"><br>
    <span class="err" id="pass-err">!</span><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="submit" id="login-button" value="Sign in"><br>
    <a href="signup.php">Don't have an account? Sign up</a>
</form>
</div>
</body>
</html>
