<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="{{URL::asset('server/node_modules/bootstrap/dist/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{URL::asset('server/resources/css/main.css')}}">
	<title>Document</title>
	<script src="{{URL::asset('server/node_modules/jquery/dist/jquery.js')}}"></script>
</head>
<body>
<div class="box">
	<input type="checkbox" id="checkbox1" /> <br />
	<input type="text" id="textbox1" />
</div>
@include('layouts.header')
<div class="container">
	
	@yield('content')
	@yield('footer')
</div>

<script src="{{URL::asset('server/node_modules/bootstrap/js/modal.js')}}"></script>
<script>
$(document).ready(function() {
    //set initial state.
    $('#textbox1').val($(this).is(':checked'));


    $('#checkbox1').change(function() {
      var that = $(this)
      setTimeout(function() {
      	that.parent().find("input").hide();
      }, 1)
    });
});
</script>
</body>
</html>