<?php

//insert.php

$connect = new PDO("mysql:host=localhost;dbname=coposmap", "root", "");

$query = "
INSERT INTO podata 
(s_name, po, gi, pi) 
VALUES (:s_name, :po, :gi, :pi)
";

for($count = 0; $count<count($_POST['hidden_s_name']); $count++)
{
 $data = array(
  ':s_name' => $_POST['hidden_s_name'][$count],
  ':po' => $_POST['hidden_po'][$count],
  ':gi' => $_POST['hidden_gi'][$count],
  ':pi' => $_POST['hidden_pi'][$count]
 );
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

?>