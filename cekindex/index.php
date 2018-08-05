<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<form action="ceker.php" method="post" id="form">
<textarea style="width:500px;height:100px" name="link"></textarea><br/>
<input type="submit" name="submit" id="tombol" value="submit"/>
</form>
<br/>
<input type="submit" onclick="window.location.reload(false);" value="refresh"/>
<div id="newpost"></div>
<div id="loading" class="alert alert-info" style="display:none" role="alert">Loading..</div><br />
<div class="alert alert-success" style="display:none" id="sukses" role="alert">Done.. !</div>
<script>
$(document).ready(function(){
	$('#tombol').click(function(e) {
	e.preventDefault();
	e.stopImmediatePropagation();
        $.ajax({
		type: "POST",
		url: "ceker.php",
		data: $('#form').serialize(),
		beforeSend: function(){
			$(document).prop('title', 'Loading...');			
			},
		success: function(response){
			$("#newpost").append(response);
			$(document).prop('title', 'Done!!');	
			}
	 });
	return false;
	});
});
</script>
</body>
</html>
