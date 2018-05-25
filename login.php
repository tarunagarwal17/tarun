<?php

$con = mysqli_connect("localhost", "root", "", "crearmonde");

    $email=   $_POST['email'];
    $password=  $_POST['password'];



        $query=" SELECT id FROM profile WHERE email='".$email."' AND password='".$password."'  ";

        if($query_run=mysqli_query($con,$query)){
            $query_num_row=mysqli_num_rows($query_run);

            if($query_num_row==0){
                echo '<hr/>password and email did not match<hr/>';
            }
            else if($query_num_row==1){

               // $user_id=mysql_result($query_run,0,'ID');
                while($row = mysqli_fetch_assoc($query_run)) {
                    $id = $row['id'];
                }
                $_SESSION['ID']=$id;
               header("Location:profile.php?id=$id");

                         //echo "<script>location='profile.php?ID=$id'</script>";
            }



    }
    else{
        echo '<hr/>you must fill all the fields!<hr/>';
    }
?>