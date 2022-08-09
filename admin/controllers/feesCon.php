<?php

    //handle posting
	if(isset($_POST["addFee"])) {
		$levy = $_POST["levy"];
		$tuition = $_POST["tuition"];
		$total = $_POST['total'];
		$min = $_POST['minimum'];
		$year = $_POST['year'];
		$term = $_POST['term'];

	    $sql = 'INSERT INTO fees (year, period, levy, tuition, total, minimum) 
			VALUES ("'.$year.'","'.$term.'","'.$levy.'","'.$tuition.'","'.$total.'","'.$min.'")';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./fees.php'; </script>";
	}

    //handle editing
	if(isset($_POST["editFee"])) {
		$ref = $_POST["id"];
		$total = $_POST['total'];
		$min = $_POST['minimum'];
		$levy = $_POST['levy'];
		$tuition = $_POST['tuition'];

	    $sql = '
            UPDATE fees SET
                levy = "'.$levy.'",
                total = "'.$total.'",
                tuition = "'.$tuition.'",
                minimum = "'.$min.'"
            WHERE id = "'.$ref.'"
        ';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./fees.php'; </script>";
	}

	//handle deleting
	if(isset($_POST["deleteFee"])) {
		$id = $_POST["id"];

	    $sql = "
			DELETE FROM fees 
			WHERE id = '".$id."'
        ";
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./fees.php'; </script>";
		// echo $id;
	}

 ?>