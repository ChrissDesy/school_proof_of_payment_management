<?php

    // sql queries
    $sql1 = "
        SELECT
            t.id, t.date, t.amount, s.fname, s.lname, f.year, f.period
        FROM transactions AS t
        LEFT JOIN students AS s ON t.student = s.id
        INNER JOIN fees AS f ON t.fee = f.id
        ORDER BY t.date DESC
        LIMIT 5;
    ";

    $sql2 = "
        SELECT
            (SELECT COUNT(*) FROM users) AS users,
            (SELECT COUNT(*) FROM students) AS students,
            (SELECT COUNT(*) FROM fees) AS fees,
            (SELECT COUNT(*) FROM payments WHERE status = 'owing') AS owing
    ";

    // sql statements
    $statement = $db->prepare($sql1);
    $statement2 = $db->prepare($sql2);

    // execute and get results
    $statement->execute();
    $statement2->execute();

    $transactions = $statement->fetchAll();
    $stats = $statement2->fetchAll();

?>