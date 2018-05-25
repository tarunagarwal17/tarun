<?php

$con =mysqli_connect("localhost", "root", "", "crearmonde");
  
function logged_in(){
    return (isset($_SESSION['id'])) ? true : false;
}


function change_profile_image($id,$file_temp,$file_extn){
    echo $file_path='image/'.substr(  md5(time()),0,10 ).'.'.$file_extn;
   move_uploaded_file($file_temp,$file_path);

}


function change_password($id,$password){
    $con =mysqli_connect("localhost", "root", "", "crearmonde");
    $id=(int)$id;
    $password=md5($password);
    mysqli_query($con, "  UPDATE `profile`  SET `password` ='$password' WHERE `id` ='$id'  " );

}


function register_user($register_data){

    $con =mysqli_connect("localhost", "root", "", "crearmonde");
    array_walk($register_data,'array_sanatize');
    //$register_data['password']=md5($register_data['password']);
    
     //$fields= '`'.implode(' `,` ',array_keys($register_data)).' `';
    //$data=  ' \' '.implode(' \',\'   ',$register_data).' \' ' ;
    //mysqli_query($con," INSERT INTO `profile` ($fields) VALUES ($data) ");
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password_hash=md5($password);
    $email=$_POST['email'];

    mysqli_query($con,"INSERT INTO `profile` VALUES ('','".mysqli_real_escape_string($con,$username)."','".mysqli_real_escape_string($con,$password_hash)."','".mysqli_real_escape_string($con,$email)."')");
}

function user_data($id){
    $con =mysqli_connect("localhost", "root", "", "crearmonde");
    $data=array();
    $id=(int)$id;

    $func_num_args=func_num_args();
    $func_get_args=func_get_args();

    if($func_num_args >1){
        unset($func_get_args[0]);

        $fields=   ' `' .implode('`,`',$func_get_args). '`'  ;
        $data=mysqli_fetch_assoc(mysqli_query($con," SELECT  $fields  FROM `profile` WHERE `id` =$id "  ) );
        return $data;
    }

}



function user_exists($email){
    $con =mysqli_connect("localhost", "root", "", "crearmonde");
 //   $email = sanatize($email);
    $query = mysqli_query($con, " SELECT COUNT(`id`) FROM `profile`  WHERE `email`='$email'");
   return (mysqli_fetch_assoc($query,MYSQLI_BOTH) == 1) ? true : false;




}
    /*

    while($row = mysqli_fetch_assoc($query)){
        if($row==1){
            return true;
        }
        else{
            return false;
        }
    }
   */

    function user_id_from_username($email){
        $con =mysqli_connect("localhost", "root", "", "crearmonde");
        $email=sanatize($email);
        return mysqli_fetch_array(  mysqli_query($con, "SELECT `id` FROM `profile` WHERE `email`='$email'" ) ,0 ,`id`);
    }
	if(logged_in()===true){
    $session_user_id=$_SESSION['id'];
    $user_data=user_data( $session_user_id,'id','email','username','password');
}
/*
    function login($email,$password){
        $id=user_id_from_username($email);
        $con =mysqli_connect("localhost", "root", "", "crearmonde");
        $email=sanatize($email);
        $password=md5($password);

        return ( mysqli_fetch_array( mysqli_query($con,"SELECT  COUNT(`id`) FROM `profile` WHERE `email`='$email' AND `password`='$password' ") ,0) ==1  ) ? $id : false;
    }
    */
?>


