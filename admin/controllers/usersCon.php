<?php

    //handle posting
	if(isset($_POST["addRec"])) {
		$nid = $_POST["natid"];
	    $fname = $_POST["fname"];
	    $uname = $_POST["uname"];
	    $lname = $_POST["lname"];
		$gen = $_POST["gender"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$dat = $_POST["dat"];
		$role = $_POST["role"];
		$pwd = $_POST["pwd"];

	    $sql = 'INSERT INTO users (username, firstname, lastname, gender, email, phone, dateofbirth, role, password, nationalid, status) VALUES ("'.$uname.'","'.$fname.'","'.$lname.'","'.$gen.'","'.$email.'","'.$phone.'","'.$dat.'","'.$role.'","'.$pwd.'","'.$nid.'","active")';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./users-list.php'; </script>";
	}

    //handle editing
	if(isset($_POST["editRec"])) {
		
	    $nid = $_POST["natid"];
	    $fname = $_POST["fname"];
	    $uname = $_POST["uname"];
	    $lname = $_POST["lname"];
		$gen = $_POST["gender"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$dat = $_POST["dat"];

	    $sql = '
            UPDATE users SET
                username = "'.$uname.'",
                firstname = "'.$fname.'",
                lastname = "'.$lname.'",
                gender = "'.$gen.'",
                email = "'.$email.'",
                phone = "'.$phone.'",
                dateofbirth = "'.$dat.'",
                nationalid = "'.$nid.'"
            WHERE id = "'.$ref.'"
        ';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./users-list.php'; </script>";
	}

	//handle deleting
	if(isset($_POST["deleteRec"])) {
		$id = $_POST["id"];

	    $sql = "
			UPDATE users SET 
			status = 'deleted' 
			WHERE id = '".$id."'
        ";
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./users-list.php'; </script>";
		// echo $id;
	}

 ?>