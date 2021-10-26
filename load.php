
<?php
    $connect = new PDO('mysql:host=localhost;dbname=calendar', 'root', '');

    $data = array();

$query = "SELECT * FROM table_events ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'eventname'   => $row["eventname"],
  'mail'   => $row["mail"],
  'start'   => $row["from"],
  'end'   => $row["to"],
  'details'   => $row["details"],
  'duration'   => $row["duration"],
  'notification'   => $row["notification"],
  'status'   => $row["status"]
 );
}

echo json_encode($data);

?>
