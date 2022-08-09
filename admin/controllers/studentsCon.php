<?php

    //handle posting
	if(isset($_POST["addStudent"])) {
		$name = $_POST["name"];
	    $sname = $_POST["sname"];
	    $reg = $_POST["reg"];
	    $phone = $_POST["phone"];
	    $gender = $_POST["gender"];
		$dob = $_POST["dob"];
		$address = $_POST["address"];
		$pname = $_POST["pname"];
		$pmobile = $_POST['pmob'];
		$pemail = $_POST['pemail'];
		$year = $_POST['year'];
		$term = $_POST['term'];

	    $sql = 'INSERT INTO students (fname, lname, reg_number, phone, gender, dob, address, pname, pmobile, pemail, year, period) 
			VALUES ("'.$name.'","'.$sname.'","'.$reg.'","'.$phone.'","'.$gender.'","'.$dob.'","'.$address.'","'.$pname.'","'.$pmobile.'", "'.$pemail.'","'.$year.'", "'.$term.'")';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./students-list.php'; </script>";
	}

    //handle editing
	if(isset($_POST["editStudent"])) {
		$ref = $_POST["ref"];
	    $name = $_POST["name"];
	    $sname = $_POST["sname"];
	    $phone = $_POST["phone"];
	    $gender = $_POST["gender"];
		$dob = $_POST["dob"];
		$address = $_POST["address"];
		$pname = $_POST["pname"];
		$pmobile = $_POST['pmob'];
		$pemail = $_POST['pemail'];
		$year = $_POST['year'];
		$term = $_POST['term'];

	    $sql = '
            UPDATE students SET
                fname = "'.$name.'",
                lname = "'.$sname.'",
                phone = "'.$phone.'",
                gender = "'.$gender.'",
                dob = "'.$dob.'",
                address = "'.$address.'",
                pname = "'.$pname.'",
                year = "'.$year.'",
                term = "'.$term.'",
                pmobile = "'.$pmobile.'",
                pemail = "'.$pemail.'"
            WHERE id = "'.$ref.'"
        ';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./students-list.php'; </script>";
	}

	//handle deleting
	if(isset($_POST["deleteStudent"])) {
		$id = $_POST["id"];

	    $sql = "
			DELETE FROM students 
			WHERE id = '".$id."'
        ";
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./students-list.php'; </script>";
		// echo $id;
	}

 ?>