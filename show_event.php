<?php


  $connect = new PDO('mysql:host=localhost;dbname=calendar', 'root', '');
    ?>

<table align="center" border="1px" style="" line-height:"10px">
<tr>
<th colspan="8"><h2>Event record</h2></th>
</tr>
<t>
<th>EVENT NAME</th>
<th>MAIL</th>
<th>START</th>
<th>END</th>
<th>DETAILS</th>
<th>DURATION</th>
<th>NOTIFICATION</th>
<th>STATUS</th>
</t>
<?php

  $data = array();

$query = "SELECT * FROM table_events";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{

?>
  <tr>
      <td><?php echo $row['eventname'];?></td>
      <td><?php echo $row['mail'];?></td>
      <td><?php echo $row['from'];?></td>
      <td><?php echo $row['to'];?></td>
      <td><?php echo $row['details'];?></td>
      <td><?php echo $row['duration'];?></td>
      <td><?php echo $row['notification'];?></td>
      <td><?php echo $row['status'];?></td>
    
</tr>

<?php

}
?>
