<?php
if(isset($_GET['vkey'])){
    //Process Verification
    $vkey = $_GET['vkey'];

    $con = mysqli_connect('bqbxbuerhzolifexxeim-mysql.services.clever-cloud.com', 'ur31kfvnrvrocgdy', 'fdZgRxAydtLaR9c3HhLe', 'bqbxbuerhzolifexxeim');

    $resultSet = $con->query("SELECT verified, vkey FROM players WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");

    if($resultSet->num_rows == 1){
        //Validate The email
        $updatequery = $con->query("UPDATE players SET verified = 1 WHERE vkey = '$vkey' LIMIT 1") or die("error with update");

        if($updatequery) {
            echo "Your account has been verified. You may now <a href='https://xrclass.ml/login'>log in.</a>";
        }
        else{
            echo $con->error;
        }
    }
    else{
        echo "This account is invalid or already verified";
    }
}
else{
    die("Something went wrong");
}
?>