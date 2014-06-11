<?php
# Logging in with Google accounts requires setting special identity, so this example shows how to do it.
require_once 'libs/openid/openid.php';
try {  
	echo "in controller....<br/>";   
	# Change 'localhost' to your domain name.     
	$openid = new LightOpenID($_SERVER['HTTP_HOST']);
	echo "object created <br/>";
	//Not already logged in
	if(!$openid->mode){         
		echo "//The google openid url";         
		$openid->identity = 'https://www.google.com/accounts/o8/id';                   
		echo "//Get google account information about the user email";         
		$openid->required = array('contact/email');                    
		echo "//start discovery";         
		header('Location: ' . $openid->authUrl());     
	}           
	else if($openid->mode == 'cancel')     
	{         
		echo 'User has canceled authentication!';         
		//redirect back to login page ??     
	}          
	 //Echo login information by default     
	 else{         
	 	if($openid->validate())         
	 	{             
	 		//User logged in             
	 		$data = $openid->getAttributes();             
	 		$email = $data['contact/email'];
	 		//now signup/login the user.             
	 		process_signup_login($email);         
	 	}         
	 	else {             
	 		echo "user is not logged in";         
	 	}     
	 } 
}   catch(ErrorException $e)  
	{     
		echo $e->getMessage(); 
	}
	
	
	function process_signup_login($data) {     
		$email = $data['email'];     
		$username = $data['username'];     
		$source = $data['source'];       

		echo $email."<br/>".$username;
		/*$result = $this->db->get_where('users' , array('email' => $email));               
		/*if the user already exists , then log him in rightaway     
		if($result->num_rows() > 0)     
		{         
			//already registered , just login him         
			$row = $result->row_array();         
			$this->do_login($row);     
		}        
		 //new user, first sign him up, then log him in    
		  else    
		  {         
		  	//register him , and login        
		  	$toi = array('email' => $email ,'username' => $username ,'password' => md5($this->new_password()) ,'source' => $source );
		  	$this->db->insert('users' , $toi);                  
		  	$result = $this->db->get_where('users' , array('email' => $email));                   
		  	if($result->num_rows() > 0)         
		  	{             
		  		$row = $result->row_array();             
		  		$this->do_login($row);         
		  	}     
		  }               
		  //redirect to somewhere     
		  redirect(site_url()); }   
		  
		  /**     Do login taking a row of resultset 
		  function do_login($row) 
		  {     
		  	session_set('uid' , $row['id']);     
		  	session_set('email' , $row['email']);     
		  	session_set('logged_in' , true); */          
		  	return true; 
		  }

?>