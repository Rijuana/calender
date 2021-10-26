<!DOCTYPE html>
<html>
 <head>
  <title>Event Fullcalandar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: "load.php",
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = modal("to add event please click on add event or to add reminder please click on add reminder");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
      var eventname = event.eventname;
     var from = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var to = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     
     var mail = event.mail;
     var details = event.details;
     var duration = event.duration;
     var notification = event.notification;
     var status = event.status;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{eventname:eventname, from:from, to:to, id:id, mail:mail,details:details,duration:duration,notification:notification,status:status},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
      var from = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var to = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var eventname = event.eventname;
     var mail = event.mail;
     var details = event.details;
     var duration = event.duration;
     var notification = event.notification;
     var status = event.status;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{eventname:eventname, from:from, to:to, id:id, mail:mail,details:details,duration:duration,notification:notification,status:status},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
   
  </script>
 </head>
 <body>



<div class="container">
<div class="container">
<div class="text-right">
   <button type="button" class="btn btn-info btn-lg"> <a href="show_event.php">Show Events</a></button>
</div>
</div><!-- Trigger the modal with a button -->
<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Add Event</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
 <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal">&times;</button>
   <h4 class="modal-title">Add Event Details</h4>
 </div>
 <div class="modal-body">
   <form action="" method="post">
   <lable for='eventname'>Event Name</lable>
<input type="text" name="eventname" id="eventname" class="form-control">
<lable>Email of The Organizer</lable>
<input type="email" name="mail" id="mail" class="form-control">

<label for="from">From</label>
<input id="from" type="datetime-local" name="from" class="form-control"/>

<label for="to">To</label>
   <input id="to" type="datetime-local" name="to" class="form-control"/>
 <label for="details">Details</label>
<textarea id="details" type="text" name="details"  class="form-control"></textarea>
<label for="duration">Duration</label>
<textarea id="duration" type="text" name="duration" placeholder="in mins"  class="form-control"></textarea>
<label for="notification">Sent Notification Before the event</label>
<textarea id="notification" type="text" name="notification" placeholder="in mins"  class="form-control"></textarea>

<label for="status">Status</label>
<textarea id="status" type="text" name="status" placeholder="Cancelled/Completed" class="form-control"></textarea>


 </div>
 <div class="modal-footer">
 <button name="submit" id="submit" type="submit" class="btn btn-success" value="submit">Add Details</button>
   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 </div>
</div>

</div>
</div>
</div>
<br>
<div class="container">
<div class="container">
<div class="text-right">
   <button type="button" class="btn btn-info btn-lg"> <a href="show_reminder.php">SHow Reminders</a></button>
</div>
</div>
<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal2">Add Reminder</button>

<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
 <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal">&times;</button>
   <h4 class="modal-title">Add Reminder Details</h4>
 </div>
 <div class="modal-body">
 <form action="" method="post">
 <lable for="clientname">Client Name</lable>
<input type="text" name="clientname" id="clientname" class="form-control">
<lable>Email To send reminder Notification</lable>
<input type="email" name="rmail" id="rmail" class="form-control">

<label for="rdate"> Remind Me onDate & Time</label>
<input id="rdate" type="datetime-local" name="rdate" class="form-control"/>


 <label for="rnotes">Notes</label>
<textarea id="rnotes" type="text" name="rnotes"  class="form-control"></textarea>
 </div>

 <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   <button type="submit" name="set" id="set" value="set" class="btn btn-primary">Add Reminder</button>
 </div>
</div>

</div>
</div>

</div>


<div class="container">
<div id="calendar"></div>
</div>
</body>
</html>
<?php

$insert=false;
if(isset($_POST['submit'])){
  
include 'database.php';
 
$eventname =mysqli_real_escape_string($conn, $_POST['eventname']);
$mail = mysqli_real_escape_string($conn, $_POST['mail']);

$from =mysqli_real_escape_string ($conn, $_POST['from']);
$to = mysqli_real_escape_string($conn, $_POST['to']);
$details = mysqli_real_escape_string($conn, $_POST['details']);
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$notification =mysqli_real_escape_string ($conn, $_POST['notification']);
$status =mysqli_real_escape_string ($conn, $_POST['status']);

$insertquery="INSERT INTO `calendar`.`table_events` (`eventname`,`mail`,`from`,`to`,`details`,`duration`,`notification`,`status`) VALUES ('$eventname','$mail','$from','$to','$details','$duration','$notification','$status')";
$result=mysqli_query($conn,$insertquery);

if (! $result) {
  echo "data not inserted";
}

    }


?>

<?php

$insert=false;
if(isset($_POST['set'])){
  
include 'database.php';
 
$clientname =mysqli_real_escape_string($conn, $_POST['clientname']);
$rmail = mysqli_real_escape_string($conn, $_POST['rmail']);

$rdate =mysqli_real_escape_string ($conn, $_POST['rdate']);
$rnotes = mysqli_real_escape_string($conn, $_POST['rnotes']);



$insertquery="INSERT INTO `calendar`.`table_reminder` (`clientname`,`rmail`,`rdate`,`rnotes`) VALUES ('$clientname','$rmail','$rdate','$rnotes')";
$result=mysqli_query($conn,$insertquery);

if (! $result) {
  echo "data not inserted";
}

    }


?>
