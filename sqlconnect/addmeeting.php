<?php

    $con = mysqli_connect('bqbxbuerhzolifexxeim-mysql.services.clever-cloud.com', 'ur31kfvnrvrocgdy', 'fdZgRxAydtLaR9c3HhLe', 'bqbxbuerhzolifexxeim');

    //check that connection happened

    if(mysqli_connect_errno())
    {
        echo "1: Connection failed"; //error code #1 = connection failed
        exit();
    }

    $username = $_POST["name"];
    $start = $_POST["start"];
    $duration = $_POST["duration"];
    $end = $_POST["Endd"];
    $isActive = $_POST["isActive"];
    $JoinURL = $_POST["JoinURL"];
    $useWaitRoom = $_POST["useWaitRoom"];
    $MeetingType = $_POST["MeetingType"];
    $capacity = $_POST["capacity"];
    $isRecurring = $_POST["isRecurring"];
    $name2 = $_POST["name2"];
    $color = $_POST["MyColor"];
    $MyDate = $_POST["MyDate"];
    $endDate = $_POST["EndDate"];
    $JoinURL = md5(time().$username);

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

    $updatequery = "INSERT INTO meetings (namee, creatorID, Startt, duration ,Endd, isActive, JoinURL, useWaitRoom, MeetingType, capacity, isRecurring, color, meetingDate, endDate) VALUES ('$name2', $id,'$start' ,'$duration', '$end', '$isActive', '$JoinURL' , '$useWaitRoom' , '$MeetingType' , '$capacity' , '$isRecurring' , '$color', '$MyDate', '$endDate')";
    
    mysqli_query($con, $updatequery) or die("Error: " . $sql . "<br>" . $con->error ."F: Add Meeting Failed");// error code #F - Add Meeting query failed

    $getMeetingIDquery = "SELECT id FROM meetings WHERE creatorID ='" . $id . "' AND activated = 0;";

    $MIDCheck = mysqli_query($con, $getMeetingIDquery) or die("H: failed to get meeting id callback");

    if(mysqli_num_rows($MIDCheck) != 1)
    {
        echo "G: Meeting Activation Failed. My activations: " . mysqli_num_rows($MIDCheck) . ", ". $sql . "<br>" . $con->error; //error code #G - failed to activate meeting
        exit();
    }
    $Nexistinginfo = mysqli_fetch_assoc($MIDCheck);

    $meetingIDD = $Nexistinginfo["id"];

    $linkquery = "INSERT INTO playersinmeetings (playerID, meetingID, muted, video, coHost) VALUES ('$id', '$meetingIDD' ,'0','1','0')";

    //$newupdatequery = "UPDATE meetings SET activated = 1 WHERE meetingID = $meetingIDD;";
    $newupdatequery = "UPDATE meetings SET activated = " . 1 . " WHERE id = '" . $meetingIDD . "';";

    mysqli_query($con, $newupdatequery) or die("7: Save query failed" . $sql . "<br>" . $con->error);// error code #7 - Update query failed

    mysqli_query($con, $linkquery) or die("Error: " . $sql . "<br>" . $con->error ."H: Add Meeting Failed");// error code #F - Add Meeting query failed

    echo "0: Meeting Saved \t" . $JoinURL;

?>