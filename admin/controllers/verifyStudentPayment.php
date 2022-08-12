<?php

    include('./../includes/dbcon.php');

    $stud = $_POST['student'];
    $fee = $_POST['fee'];

    $sql = "SELECT 
            date_modified, amount, status, total
            FROM payments AS p
            LEFT JOIN fees AS f ON p.fee=f.id
            WHERE p.student='$stud' AND p.fee='$fee'";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    echo json_encode($result);

?>