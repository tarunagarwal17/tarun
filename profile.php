<!DOCTYPE html>
<html>
<head>
	<title>Crear Monde</title>
	<link rel="stylesheet" type="text/css" href="css/web.css">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link href="https://fonts.googleapis.com/css?family=Pacifico|Roboto:300,400,500,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/fb.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<style>
div.containerr {
    width: 1100px;
align:center;
border:1px solid black;
}

div.box {
    box-sizing: border-box;
    width: 50%;
align:center;
    float: left;
}
div.box1{
float:center;
}
</style>
	
	</head>
<body>

<!-- Header -->
<header id="main_sec_bar_profile">
<header id="inner_sec_bar_profile">
    <div id="logo">
    <img src="images/logo.jpg">
    <p>Crear<span>Monde</span></p>
    </div>
	<nav id="nav">
		<ul>
			
			<li><a id="active" href="logout.php">Logout</a></li>
		</ul>
	</nav>
</header>
</header>
<!-- Header End -->
<?php //include ("users.php"); ?>

<?php
error_reporting(E_ERROR | E_PARSE);
//session_start();

$con = mysqli_connect("localhost", "root", "", "crearmonde");

 $ID = $_GET['id'];
$_SESSION['id'] = $ID;
$query = mysqli_query($con, "SELECT id,username , email  FROM profile  WHERE id='".$ID."'");
$row = mysqli_fetch_array($query,MYSQLI_BOTH);
 $username=$row['username'];
 $email=$row['email'];
  $idmine=$row['id'];
if(mysqli_num_rows($query) > 0){
}

  //$session_user_id=$_SESSION['id'];
    //$user_data=user_data( $session_user_id,'id','email','username','password');
	
$queryyy = mysqli_query($con, "SELECT id,phone , age,qualification,profession,company,residence,about  FROM info  WHERE id='".$ID."'");
$roww = mysqli_fetch_array($queryyy,MYSQLI_BOTH);
$idreturn=$roww['id'];
$phonereturn=$roww['phone'];
$agereturn=$roww['age'];
$qualificationreturn=$roww['qualification'];
$professionreturn=$roww['profession'];
$companyreturn=$roww['company'];
$residencereturn=$roww['residence'];
$aboutreturn=$roww['about'];


if(mysqli_num_rows($queryyy) > 0){
}

?>




<hr/><br><br>
<div class="container">


<div class="row">
  <div class="col-sm-4" align="center">
  <!--
   <img src=" <?php
            $rand=(rand(1,5));
           //  echo 'images/anon.png';
			 
			 switch ($rand) {
                case 1:
				 echo 'images/anon.png';
				 break;
				 case 2:
				 echo 'images/i1.jpg';
				 break;
				 case 3:
				 echo 'images/i2.jpg';
				 break;
				 case 4:
				 echo 'images/i3.jpg';
				 break;
				 case 5:
				 echo 'images/i4.jpg';
				 break;
				 
			 }
          
            ?>" alt="" width="250px" height="250px" style="border-radius:5px;"><br/>  -->
			
			<?php
			$queryphoto = mysqli_query($con, "SELECT picture  FROM `picture` WHERE id='".$ID."'");
$rowphoto = mysqli_fetch_array($queryphoto,MYSQLI_BOTH);
$profilephoto=$rowphoto['picture'];
			?>
			 <img src="
            <?php
            if(empty($profilephoto)){
             echo 'images/anon.png';
            }else {
                echo $profilephoto;
            }

            ?>" alt="" width="250px" height="250px"><br/>
            <?php
            
                if (empty($profilephoto)) {

                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>Upload photo
                                <td><input type="file" id="profile" name="profile"></td>
                                <br/>
                                <td><input type="submit" name="submit" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
<span class="glyphicon glyphicon-camera logo-small slideanim" style="color:#00a1f1;"></span> 
                <?php }?>
			
			
			
  </div>
  
  <?php


if( isset($_FILES["profile"]) ==true ){
    if( empty($_FILES["profile"]["name"])==true ){
        echo  'choose a file';
    }
    else{
        $allowed=array('jpg','jpeg','png','gif');
        $file_name=$_FILES["profile"]["name"];



        $tmp = explode('.', $file_name);
        $file_extn=strtolower( end($tmp) );
        $file_temp=$_FILES["profile"]["tmp_name"];

        if(in_array($file_extn,$allowed)==true){

            // change_profile_image($session_user_id,$file_temp,$file_extn);
            $file_path='images/'.substr(  md5(time()),0,10 ).'.'.$file_extn;
            // move_uploaded_file($file_temp,$file_path);
            if (move_uploaded_file($file_temp, $file_path)) {
                echo "File is valid, and was successfully uploaded.\n";
                
             //   header("Location:profile.php?ID=$ID");
             $con = mysqli_connect("localhost", "root", "", "crearmonde");
                $query= "INSERT INTO `picture` VALUES ('','$ID','$file_path')";
				header("Location:profile.php?id=$ID");
                mysqli_query($con,$query);
            } else {
                echo "Upload failed";
            }

            echo  $file_path;

        }
        else{
            echo 'only jpg,jpeg,png,gif are allowed.';
        }

    }

}
else{
    //echo 'problem';
}
?>
  
  
  
  
  
  
  
  
  <div class="col-sm-4"><p style="font-size:40px;" align="center"><?php echo  $username?></p><hr/><i><p align="center"><?php echo $aboutreturn?></p></i></div>
  <div class="col-sm-4"></div>
</div>

<div class="row">
 <div class="col-sm-4"></div>
 <div class="col-sm-4"></div>
<div class="col-sm-4" align="left"> 
<p style="font-size:18px;"> Email:<i><?php echo $email?></i></p>
<?php if(!empty($idreturn)){ ?>
<p style="font-size:18px;">Phone:<i><?php echo $phonereturn?></i></p>
<p style="font-size:18px;">Age:<i><?php echo $agereturn?></i></p>
<p style="font-size:18px;">Qualification:<i><?php echo $qualificationreturn?></i></p>
<p style="font-size:18px;">Profession:<i><?php echo $professionreturn?></i></p>
<p style="font-size:18px;">Company:<i><?php echo $companyreturn?></i></p>
  
  <?php }?>
  </div>
  
</div>

<?php 
if($idmine=$ID){
if(empty($idreturn)){
	?>

<!--<div align="center";  style="
width: 500px;
    height: 800px;
    padding: 10px;
    border: 5px solid #4B0082;">
<form action="" method="POST">
  Phone:<br>
  <input  type="tel"  name="phone" id="phone" /><hr>

Age:<br>
  <input type="text" name="age" /><hr>
Qualification:<br>
  <input type="text" name="qualification" /><hr>

Profession:<br>
  <input type="text" name="profession" /><hr>

Company/School:<br>
  <input type="text" name="company" /><hr>

Residence:<br>
  <input type="text" name="residence" /><hr>

About:<br>
  <input type="text" name="about" style="width: 400px; height:100px;" /><hr>
<button type="submit" style="color:white; font-size:17px; height:45px; width:200px;  background-color:black; border: 2px solid;
    border-radius:10px; ">Submit</button>

</form>

</div>-->

<div class="row" align="center">
	 <div class="col-sm-3"></div>
  <div class="col-sm-6"  style="
    height: 800px;
	/*border-radius:30px;*/
    padding: 10px;
    border: 5px solid #25c1ec;
	
	">
<form action="" method="POST">
 <br>
  <input  type="tel"  class="form-control" name="phone" id="phone" placeholder="Phone:" /><hr>

<br>
  <input type="text"  class="form-control" name="age" placeholder="Age:"/><hr>
<br>
  <input type="text"  class="form-control" name="qualification" placeholder="Qualification:" /><hr>

<br>
  <input type="text"  class="form-control" name="profession"  placeholder="Profession:" /><hr>

<br>
  <input type="text"  class="form-control" name="company" placeholder="Company/School:" /><hr>

<br>
  <input type="text"  class="form-control" name="residence" placeholder="Residence:" /><hr>

<br>
  <input type="text" class="form-control" name="about" style="width: 400px; height:100px;" placeholder="About:" /><hr>
<button type="submit" style="color:white; font-size:17px; height:45px; width:200px;  background-color:#25c1ec; border: 2px solid;
    border-radius:25px; ">Submit</button>

</form>
</div>
 <div class="col-sm-3"></div>
</div>



<hr/><br>

<?php

$phone=$_POST['phone'];
$age=$_POST['age'];
$qualification=$_POST['qualification'];
$profession=$_POST['profession'];
$company=$_POST['company'];
$residence=$_POST['residence'];
$about=$_POST['about'];


$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'crearmonde';
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if( !empty($phone)&& !empty($age)&& !empty($qualification)&& !empty($profession)&& !empty($company)&& !empty($residence)&& !empty($about)  ){
$queryy = "INSERT INTO info VALUES ('".$ID."','".$phone."','".$age."','".$qualification."','".$profession."','".$company."','".$residence."','".$about."')";
$resultt = $conn->query($queryy);

if($resultt){
 header("Location:profile.php?id=$ID");

}else{
echo "Data insertion failed";
}
}
else{
	echo 'please fill all the fields!';
}

}
}
if($idmine==$ID){
?>

<hr/>
 <div align="center"  style="height: 130px; ">
 <form  role="form" action="" method="POST">
  <textarea  rows="5" style=" width:1000px;"
  placeholder="what's going on!" name="post" id="post"></textarea><br/>
<br/>

 <button class="btn btn-default" type="submitpost" id="submitpost" value="submitpost" style=" font-size:25px; width:100px; height:50px; color:white; background-color:#25c1ec; border-radius: 22px;" >
    Go!
 </button>
 
 </form>
 </div>
</div>
<br/><br/>
<hr/>

<div class="row">
<div class="col-sm-2" > </div>
  <div class="col-sm-8" align="center">
  <p style="font-size:20px;">Suggested Connections</p>
   
   <div class="scrollmenu" > 
 <!--  <div class="col-sm-12 text-center" > -->

          
            <?php

            $con = mysqli_connect("localhost", "root", "", "crearmonde");
            
            $queryfollowshow = mysqli_query($con, "SELECT `username`,id   FROM `profile`  ORDER BY `id` DESC   ");
            //   $qfollowshow = mysqli_fetch_array($queryfollowshow, MYSQLI_BOTH);
            // echo  $gid=$qfollowshow['groupfollowing'];
            if (mysqli_num_rows($queryfollowshow) == 0) {
                echo 'Not connected to any body ';
            }

            while ($rowsuggested = mysqli_fetch_assoc($queryfollowshow)) {
                $idsuggested = $rowsuggested['id'];
                $queryfollowshowname = mysqli_query($con, "SELECT `username`,id   FROM `profile`  WHERE id='" . $idsuggested . "'   ");
                $qn = mysqli_fetch_array($queryfollowshowname, MYSQLI_BOTH);
                
                ?>
            <!--     <div class="col-sm-3 "> -->
			
                    <a href="profile.php?id=<?= $qn['id'] ?>" style="font-size:17px; margin-left:7px;">  <?php echo $qn['username']; ?> |</a>
               <!--  </div>-->
			   
                <?php
            }
            
            ?>
       <!--  </div> -->
		</div>
   
   
   
   
   
   
   
   
  </div>
  <div class="col-sm-2" >  </div>
 </div>
<hr/>
<?php
}
//$post= $_POST['post'];
$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'crearmonde';
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
  if (empty($_POST['post']) == false) {
//$quer = "INSERT INTO post VALUES ('','".$ID."','".$post."')";
$quer = "INSERT INTO post VALUES ('','".$ID."','".$_POST['post']."')";
$resu = $conn->query($quer);
if($resu){
	header("Location:profile.php?id=$ID");
}
}


$querypost = mysqli_query($con, "SELECT number, id,post FROM post WHERE id='" . $ID . "' ORDER BY number DESC");
$rowpost = mysqli_fetch_array($querypost,MYSQLI_BOTH);
 $post=$rowpost['post'];
 if(mysqli_num_rows($querypost)== 0){
}
 while ($rowp = mysqli_fetch_assoc($querypost)) {
?>
<br/><br/>
<div  style="border: 1px solid #242424; border-radius: 1px; padding: 0px; margin: 15px; width:1000px; margin-left:170px;">
 <div style="padding: 20px; " >
<b> <?php echo  $username;?></b><hr/>
 <div align="center">
<i><?php echo nl2br( $rowp["post"]); ?></i>
</div>

<br>
</div>
</div>
<?php
}


?>

