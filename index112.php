<?php

?>
<html>
<head >
<style >
#loginBox{
	position:fixed;
    top: 30%;
    left: 30%;
    width:60%;
    height:35%;
}
</style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1;charset=utf-8" />
    <title>ATD Login</title>
    
    <script type="text/javascript">       
    window.setTimeout(function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/client:plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      },1000)();
	
    
    function signinCallback(authResult) {   
		if (authResult['access_token']) { 
			document.getElementById('signinButton').setAttribute('style', 'display: none');
			document.getElementById('loading').setAttribute('style', 'display: true');
			document.getElementById('loading').innerHTML =  authResult['access_token'];
		} 
		else if (authResult['error']) {   
			console.log('Sign-in state: ' + authResult['error']);   
		} 
    } 

</script>
    
</head>    
<body>
	<div id="loginBox" >
		<font color="green" face="Calibri" size=5>Advanced Technology Development Dashboard</font>
		<br /><br />
			<span id="signinButton" >
		   <span 
				class="g-signin" 
				data-callback="signinCallback" 
				data-clientid="396111735866.apps.googleusercontent.com" 
				data-cookiepolicy="single_host_origin" 
				data-requestvisibleactions="http://schemas.google.com/AddActivity"     
				data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile">   
			</span> 
		</span> 
		<div id = "loading" style="display: none"></div>
	</div>
</body>
</html>
