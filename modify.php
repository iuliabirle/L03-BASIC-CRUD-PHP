<?php

$id = $_POST['id'];

$forModify = $_POST['message'];

$connectionAuxiliary = new mysqli('remotemysql.com', 'feCGU0aVFb', 'W63Q8qmNUW');
$sql = " UPDATE feCGU0aVFb.`collectted_data`   SET  `collectted_data`.name =  '$forModify'  WHERE  `collectted_data`.id = '$id'; ";



$result = $connectionAuxiliary->query($sql);

if ($result === TRUE) printf("modificare ok \n");
else printf("nu modificare ok\n");
