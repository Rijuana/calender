<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=calendar', 'root', '');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE table_events 
 SET eventname=:eventname, mail=:mail, from=:start, to=:end, details=:details, duration=:duration,notification=:notification, status=status
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
    
   ':eventname'  => $_POST['eventname'],
   ':mail'=> $_POST['mail'],
   ':start' => $_POST['from'],
   ':end' => $_POST['to'],
   ':details'   => $_POST['details'],
   ':duration'   => $_POST['duration'],
   ':notification'   => $_POST['notification'],
   ':status'   => $_POST['status'],
   ':id'   => $_POST['id'],
  )
 );
}

?>