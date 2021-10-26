<?php


  $connect = new PDO('mysql:host=localhost;dbname=calendar', 'root', '');
    ?>

<table align="center" border="1px" style="" line-height:"10px">
<tr>
<th colspan="8"><h2>REMINDER RECORDS</h2></th>
</tr>
<t>
<th>CLIENT NAME</th>
<th>MAIL TO REMIND</th>
<th>REMIND ON DATE & TIME</th>

<th>NOTES</th>

</t>
<?php

  $data = array();

$query = "SELECT * FROM table_reminder";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{

?>
<tr>
<td> <?php echo $row['clientname']; ?> </td>
<td> <?php echo $row['rmail']; ?></td>
<td> <?php echo $row['rdate'];?> </td>
<td> <?php echo $row['rnotes']; ?> </td>

</tr>
<?php
}
?>