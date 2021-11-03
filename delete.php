<?php

$id = $_POST['id'];


$connectionAuxiliary = new mysqli('remotemysql.com', 'feCGU0aVFb', 'W63Q8qmNUW');
$sql = " DELETE FROM feCGU0aVFb.`collectted_data`   WHERE   `collectted_data`.id = '$id'; ";

$result = $connectionAuxiliary->query($sql);
echo $result;

if ($result === TRUE) printf("stergere ok \n");
else printf("nu stergerere ok\n");

$sql2 = "SET @num := 0;
       UPDATE feCGU0aVFb.`collectted_data` SET id = @num := (@num+1);
       ALTER TABLE TGOhJ1gk0h.`collectted_data` AUTO_INCREMENT = 1;";


$result2 = $connectionAuxiliary->multi_query($sql2);
if ($result2 === TRUE) printf("tabel rearanjat\n");
else printf("nu tabel rearanjat\n");
