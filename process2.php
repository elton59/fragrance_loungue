<?php

include("Admin/db.php");

if(isset($_POST['createfeedback']))
{
  
    $fdmessage=$_POST['fdmessage'];
    $fdreceiver=$_POST['fdreceiver'];
    $fdemail=$_POST['fdemail'];
 
  

    $result=$mysqli->query("INSERT INTO feedback(message,receiver,email) values('$fdmessage','$fdreceiver','$fdemail')")or die($mysqli->error);

    if($result)
    {
        echo
        "<script>alert('operation successfull');
        window.location.replace('index.php')
        </script>
        ";
    }
    else

    echo"<script>Alert('operation Failed');
        window.location.replace('index.php')
        </script>
        ";
}
//Edit feedback
if(isset($_POST['editfeedback']))
{
    $id=$_POST['id'];
    $fdreply=$_POST['fdreply'];
    $fdemail=$_POST['fdemail'];

  
   $result=$mysqli->query("UPDATE feedback SET reply='$fdreply',email='$fdemail', status='read' where id='$id'") or die($mysqli->error);

    if($result)
    {
        echo
        "<script>alert('operation sucessfully');
        window.location.replace('admin/editfeedback.php')
        </script>
        ";
    }
    else

    echo"<script>Alert('operation Failed');
        window.location.replace('admin/editfeedback.php')
        </script>
        ";


}
?>