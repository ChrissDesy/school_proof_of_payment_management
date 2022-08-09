<?php

    //handle payment
	if(isset($_POST["addPayment"])) {
		$student = $_POST["student"];
		$fee = $_POST["fee"];
		$amount = $_POST['amount'];
		$dat2 = date("Y-m-d");
        $stat = $_POST['status'];

	    $sql = 'INSERT INTO transactions (student, fee, date, amount) 
			VALUES ("'.$student.'","'.$fee.'","'.$dat2.'","'.$amount.'")';
	    
	    $query = $db->prepare($sql);   
	    $query->execute();

        // update student payments
        $sql1 = "SELECT * FROM payments WHERE student = ".$student." AND fee = ".$fee;
        $statement = $db->prepare($sql1);
        $statement->execute();
        $result = $statement->fetchAll();

        if(isset($result[0])){
            // record available
            $ref = $result[0]['id'];
            $new_amt = ($result[0]['amount'] + $amount);
            $sql2 = 'UPDATE payments SET
                        amount = "'.$new_amt.'",
                        date_modified = "'.$dat2.'"
                    WHERE id = "'.$ref.'"';
	    
            $query2 = $db->prepare($sql2);   
            $query2->execute();
        }
        else{
            // create new record
            $sql3 = 'INSERT INTO payments (student, fee, date_modified, amount, status) 
			VALUES ("'.$student.'","'.$fee.'","'.$dat2.'","'.$amount.'","'.$stat.'")';
	    
            $query3 = $db->prepare($sql3);   
            $query3->execute();
        }

	    echo "<script type='text/javascript'> document.location ='./new-payment.php'; </script>";
	}

?>