<?php
    
    require_once 'user.php';
    
    $username = "";
    
    $password = "";
    
    $email = "";
	
	$query = "";
	
	// Get the JSON contents
    $json = file_get_contents('php://input');
    // decode the json data
    $postdata = json_decode($json,true);
	
	if (empty($username))
	 {
	 $username = $postdata['username']; 	 
	 }
	 
	if (empty($password))
	 {
	 $password = $postdata['password']; 	 
	 }
	 
    if (empty($email))
	 {
	 $email = $postdata['email']; 	 
	 } 
	 
	if (empty($query))
	 {
	 $query = $postdata['query']; 	 
	 }
	 
	
 /*   
    if(isset($_POST['username'])){
        
        $username = $_POST['username'];
        
    }
    
    if(isset($_POST['password'])){
        
        $password = $_POST['password'];
        
    }
    
    if(isset($_POST['email'])){
        
        $email = $_POST['email'];
        
    }
    
*/
    
    
    $userObject = new User();
	
		// Query database
	
	if(!empty($query)){
        
        $result = $userObject->queryDatabase($query);
        
       echo  "{\"message\":".json_encode($result)."}";
		
	return;	
    }
    
    // Registration
    
    if(!empty($username) && !empty($password) && !empty($email)){

        
        $hashed_password = md5($password);
        
        $json_registration = $userObject->createNewRegisterUser($username, $hashed_password, $email);
        
        echo json_encode($json_registration);
        
    }
    
    // Login

    if(!empty($username) && !empty($password) && empty($email)){

        $hashed_password = md5($password);
        
        $json_array = $userObject->loginUsers($username, $hashed_password);
        
        echo json_encode($json_array);
		
		if ($json_array['success']==1) {

		}
    }
	

    ?>