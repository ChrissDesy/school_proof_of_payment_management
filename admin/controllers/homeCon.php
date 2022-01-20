<?php

    // sql queries
    $sql1 = "
        SELECT 
            date_acquired, make, model, serial_number, asset_number, name
        FROM assets, types
        WHERE assets.status = 'active' and assets.type = types.id
        ORDER BY date_acquired DESC
        LIMIT 5;
    ";

    $sql2 = "
        SELECT
            (SELECT COUNT(*) FROM users) AS users,
            (SELECT COUNT(*) FROM assets) AS assets,
            (SELECT COUNT(*) FROM types WHERE status = 'active') AS types,
            (SELECT COUNT(DISTINCT assets) FROM holders ) AS assigned
    ";

    // sql statements
    $statement = $db->prepare($sql1);
    $statement2 = $db->prepare($sql2);

    // execute and get results
    $statement->execute();
    $statement2->execute();

    $assets = $statement->fetchAll();
    $stats = $statement2->fetchAll();

?>