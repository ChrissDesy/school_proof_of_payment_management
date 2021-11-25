<?php 

    //handle posting
	if(isset($_POST["addType"])) {
		$desc = $_POST["desc"];
	    $name = $_POST["name"];

	    $sql = 'INSERT INTO types (name, description, status) VALUES ("'.$name.'","'.$desc.'","active")';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./asset-types.php'; </script>";
	}

    //handle editing
	if(isset($_POST["editType"])) {
		
	    $ref = $_POST["ref"];
	    $desc = $_POST["desc"];
	    $name = $_POST["name"];

	    $sql = '
            UPDATE types SET
                name = "'.$name.'",
                description = "'.$desc.'"
            WHERE id = "'.$ref.'"
        ';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./asset-types.php'; </script>";
	}

	//handle deleting
	if(isset($_POST["deleteType"])) {
		$id = $_POST["id"];

	    $sql = "
			UPDATE types SET 
			status = 'deleted' 
			WHERE id = '".$id."'
        ";
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

	    echo "<script type='text/javascript'> document.location ='./asset-types.php'; </script>";
		// echo $id;
	}

?>