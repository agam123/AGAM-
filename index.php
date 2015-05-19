<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<center>

<style>


.weather-table {
	font-weight: bold;
	font-style: italic;
	color: #ffffff;
}
</style></center>
</head>
<body style="background-image: url('Sunshine-And-Nutrients.jpg')">

<?php if(isset($_COOKIE['loggedin']) and $_COOKIE['loggedin'] === "true"): ?>
	<span style="color: red;">Welcome!</span> <a style="color: red;" href="logout.php">Logout</a>
<?php endif; ?>

<center>
<h1><font color="#f40108" size="3" face="arial,serif">Weather Data Station</h1></font>

<font color=#f40108 size=+2>City</font> <input id="Searchbox" type="text"><input type="button" onclick="DelayedGetWeather()" value="Get weather">


</b><font color=#f40108 size=+2>

<table id="result" style="display: none;">
	<tr>
		<td class="weather-table">City</td>
		<td id="Name" class="weather-table"></td>
	</tr>
	<tr>
		<td class="weather-table">Country</td>
		<td id="country" class="weather-table"></td>
	</tr>
	<tr>
		<td class="weather-table">Temperature</td>
		<td id="temperature" class="weather-table"></td>
	</tr>
	<tr>
		<td class="weather-table">Wind</td>
		<td id="wind" class="weather-table"></td>
	</tr>
	<tr>
		<td class="weather-table">Weather</td>
		<td id="weather" class="weather-table"></td>
	</tr>
<B><I><font color="#f40108"></font></I></B>
</table>
</font>
<p id="location">

</p>
</center>

<?php if(!isset($_COOKIE['loggedin']) or $_COOKIE['loggedin'] !== "true"): ?>
<div id="loginSection">
	<form action="form.php" method="post">
		<label for="username" style="width: 100px; color: white;">Username</label>
		<input name="username" id="username" type="text" style="width: 200px;">
		<br />
		<label for="password" style="width: 100px; color: white;">Password</label>
		<input name="password" id="password" type="password" style="width: 200px;">

		<br />
		<input type="submit" value="Log in">
	</form>
</div>
<?php endif; ?>

<script>
function getWeather(city)
{
	var address = "http://api.openweathermap.org/data/2.5/weather?";

	if(typeof(city) === "undefined") {
		city = $("#Searchbox").val();
	}

	$.ajax({
  	method: "GET",
  	url: address,
  	data: { q: city}
	})
  .done(function( data ) {
		console.log(data);
		$("#Name").html(data.name);
		$("#country").html(data.sys.country);

		// converting kelvin to celsius and round it to 2 digits
		var temp = Math.round(data.main.temp - 273.15);
		$("#temperature").html(temp);

		$("#wind").html(data.wind.speed);
		$("#weather").html(data.weather[0].description);

		$("#result").show();


		var forecastSrc = "http://forecast.io/embed/#lat=" + data.coord.lat + "&lon=" + data.coord.lon + "&name=" + data.name + "&color=#00aaff&font=Georgia&units=uk";
		console.log(forecastSrc);
		if($("#forecast").length) {
			$("#forecast").attr("src",forecastSrc);
		}
  });
}

function DelayedGetWeather(city) {
	setTimeout(getWeather, 3000, city);
}

getWeather("London, England");
</script>

<?php if(isset($_COOKIE['loggedin']) and $_COOKIE['loggedin'] === "true"): ?>
	<iframe style="background-color: white; color: black;" id="forecast" type="text/html" frameborder="0" height="245" width="100%" src="http://forecast.io/embed/#lat=51.5072&lon=0.1275&name=Central London&color=#00aaff&font=Georgia&units=uk"> </iframe>
<?php endif; ?>
</body>
</html>
