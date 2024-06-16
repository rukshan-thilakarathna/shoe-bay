<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
 <form id="f1" enctype="multipart/form-data">
		<input type="file" name="img" id="img">
		<input type="text" name="t" id="t">
		<input type="button" name="sent" id="sent" value="SEND" onclick="aj()"> 
 </form>
</body>
<script>
	function aj(){
 		var x = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	    x.open('POST', '_test.php');
	    var ff =  document.getElementById('f1');
	    var dd = new FormData(ff);
	    x.onreadystatechange = function() {
	        if (x.readyState>3 && x.status==200) { f(x.responseText); }
	    };
	 //   x.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	 //   x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    x.send(dd);
	    return x;
    }
   function f(d) {
   	console.log(d)
   } 
</script>
</html>