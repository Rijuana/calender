
<?php
    $connect = new PDO('mysql:host=localhost;dbname=calendar', 'root', '');
?>
<table align="center" border="1px" style="" line-height:"10px">
<tr>
<th colspan="8"><h2>Event record</h2></th>
</tr>
<t>
<th>CLIENt NAME</th>
<th>CLIENT MAIL</th>
<th>REMIND DATE</th>
<th>NOTES</th>

<?php
    $rem = array();

$query = "SELECT * FROM table_reminder ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
?><tr>
  <td><?php echo $row['clientname'];?></td>
  <td><?php echo $row['rmail'];?></td>
  <td><?php echo $row['rdate'];?></td>
  <td><?php echo $row['rnotes'];?></td>
  
  </tr>

<?php

}
?>