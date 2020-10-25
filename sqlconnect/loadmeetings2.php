<?php

    $con = mysqli_connect('bxh4dwfceuoiprsc0heb-mysql.services.clever-cloud.com', 'u1exqv0w4ilg7eep', 'hxQbTSldOIX8Kq9VPsJw', 'bxh4dwfceuoiprsc0heb');


    //check that connection happened

    if(mysqli_connect_errno())
    {
        echo "1: Connection failed"; //error code #1 = connection failed
        exit();
    }

    $username = $_POST["name"];
    $meetingURL = $_POST["meetingURL"];
    //check if name exists
    $namecheckquery = "SELECT username FROM players WHERE username='" . $username . "';";

    $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //eror code #2 - name check query failed

    if(mysqli_num_rows($namecheck) != 1)
    {
        echo "5: Either no user with name, or more than one" . $username; //error code #5 - number of names matching != 1
        exit();
    }

    $namecheckquery = "SELECT id FROM players WHERE username='" . $username . "';";

    $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //eror code #2 - name check query failed

    $existinginfo = mysqli_fetch_assoc($namecheck);

    $id = $existinginfo["id"];

    $getMeetingIDquery = "SELECT id FROM meetings WHERE JoinURL ='" . $meetingURL . "';";

    $MIDCheck = mysqli_query($con, $getMeetingIDquery) or die("H: failed to get meeting id callback");

    if(mysqli_num_rows($MIDCheck) != 1)
    {
        echo "J: No Meetings Found with URL" . mysqli_num_rows($MIDCheck) . ", ". $sql . "<br>" . $con->error; //error code #G - failed to activate meeting
        exit();
    }
    $Nexistinginfo = mysqli_fetch_assoc($MIDCheck);

    $meetingIDD = $Nexistinginfo["id"];

    $linkquery = "INSERT INTO playersinmeetings (playerID, meetingID, muted, video, coHost) VALUES ('$id', '$meetingIDD' ,'0','1','0')";

    mysqli_query($con, $linkquery) or die("Error: " . $sql . "<br>" . $con->error ."H: Add Meeting Failed");// error code #F - Add Meeting query failed

    echo "0: Meeting Added to your Calendar \t" . $JoinURL;

?>