<?php

    require './vendor/autoload.php';

    // Authenticate with Username/Password
    //$username = "Username_123";
    //$password = "Password_456";
    //$username = mysqli_real_escape_string($con,$_POST["name"]);//$_POST["name"];
    echo "Herejid";
    $username = $_POST["name"];
    $usernameclean = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) or die("Failed to clean name");
    $password = $_POST["password"];
    $account = "RobinhoodAccount#";
    $token = "RobinhoodAuthToken";

    $robinhood = new Robinhood\Robinhood($usernameclean, $password) or die("ROBINHOOD QUERY FAILED!");
    // OR
    //$robinhood = new Robinhood\Robinhood(null, null, $account, $token);

    // Get the latest quote for Netflix (NFLX)
    $orders = $robinhood->quotes->quote('NFLX') or die("NETFLIX QUERY FAILED");

    //////$myID = $robinhood->user->userId()
    echo "0\t" .  "HERE";
    exit();


/*

    $con = mysqli_connect('bxh4dwfceuoiprsc0heb-mysql.services.clever-cloud.com', 'u1exqv0w4ilg7eep', 'hxQbTSldOIX8Kq9VPsJw', 'bxh4dwfceuoiprsc0heb');

    //check that connection happened

    if(mysqli_connect_errno())
    {
        echo "1: Connection failed"; //error code #1 = connection failed
        exit();
    }

    $username = mysqli_real_escape_string($con,$_POST["name"]);//$_POST["name"];
    $usernameclean = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    $password = $_POST["password"];

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

    //echo $salt;

    $hash = $existinginfo["hashe"];

    //echo "_____________________". $hash;

    $loginhash = crypt($password, $salt);
    if($hash != $loginhash)
    {
        echo "6: Incorrect password"; // error code #6 - password does not hash to match table
        exit();
    }
    if($verified == 1)
    {
        //Continue Processing
        //echo "<p align='center' style='color:green;'>Your account is verified and you have logged in.</p>";
        //$myObj->name = $u;
        //$myObj->score = $score;
        //$myObj->ADMIN = $ADMNLEVEL;
        //$myJSON = json_encode($myObj);
        //echo $myJSON;
    }
    else{
        $error = "C: This account has not yet been verified. An email was sent to $email on $date.";
        echo $error;
        exit();
    }

    echo "0\t" . $existinginfo["score"] ."\t" . $existinginfo["ADMN"];
*/

?>