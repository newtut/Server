<?php
include 'includes.php';

    $error = NULL;

    if(isset($_POST['submit']))
    {
        $con = mysqli_connect('bxh4dwfceuoiprsc0heb-mysql.services.clever-cloud.com', 'u1exqv0w4ilg7eep', 'hxQbTSldOIX8Kq9VPsJw', 'bxh4dwfceuoiprsc0heb');
        $u = $con->real_escape_string($_POST['u']);
        $p = $con->real_escape_string($_POST['p']);
        $usernameclean = filter_var($u, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        //check if name exists
        $namecheckquery = "SELECT username, salt, hashe, score, ADMN, verified, email, createdDate FROM players WHERE username='" . $usernameclean . "';";

        $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //eror code #2 - name check query failed

        if(mysqli_num_rows($namecheck) != 1)
        {
            echo "5: Name does not exist!"; //error code #5 - number of names matching != 1
            exit();
        }

        //echo (string)mysqli_num_rows($namecheck);

        //get login info from array
        $existinginfo = mysqli_fetch_assoc($namecheck);
        $salt = $existinginfo["salt"];
        $verified = $existinginfo["verified"];
        $email = $existinginfo["email"];
        $date = $existinginfo["createdDate"];
        $date = strtotime($date);
        $date = date('M d Y', $date);
        $score = $existinginfo["score"];
        $ADMNLEVEL = $existinginfo["ADMN"];

        $hash = $existinginfo["hashe"];

        //echo "_____________________". $hash;

        $loginhash = crypt($p, $salt);
        if($hash != $loginhash)
        {
            echo "<p align='center' id='CODE' style='color:red;'>6: Incorrect password</p>"; // error code #6 - password does not hash to match table
            $log = "User entered incorrect password ($p)";
            #logger($log);
            exit();
        }
        else{

        }

        if($verified == 1)
        {
            //Continue Processing
            //echo "<p align='center' style='color:green;'>Your account is verified and you have logged in.</p>";
            $myObj->name = $u;
            $myObj->score = $score;
            $myObj->ADMIN = $ADMNLEVEL;
            $myJSON = json_encode($myObj);
            echo $myJSON;
        }
        else{
            $error = "This account has not yet been verified. An email was sent to $email on $date.";
        }

        //echo $salt;


    }

    echo $error;
?>