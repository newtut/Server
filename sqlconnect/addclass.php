<?php

    $con = mysqli_connect('bxh4dwfceuoiprsc0heb-mysql.services.clever-cloud.com', 'u1exqv0w4ilg7eep', 'hxQbTSldOIX8Kq9VPsJw', 'bxh4dwfceuoiprsc0heb');

    //check that connection happened

    if(mysqli_connect_errno())
    {
        echo "1: Connection failed"; //error code #1 = connection failed
        exit();
    }

    $username = $_POST["myName"];
    $className = $_POST["classname"];
    $Sched = $_POST["MeetSched"];
    $classURL = $_POST["URL"];
    $classStatus = $_POST["STATUS"];
    $endDay = $_POST['endDate'];


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

    $updatequery = "INSERT INTO classes (instructorID, className, classURL, classStatus , classSched, endDate) VALUES ('$id', $className,'$classURL' ,'$$classStatus', '$end', '$Sched', '$endDay')";
    
    mysqli_query($con, $updatequery) or die("Error: " . $sql . "<br>" . $con->error ."F: Add Meeting Failed");// error code #F - Add Meeting query failed

    $getMeetingIDquery = "SELECT id FROM classes WHERE instructorID ='" . $id . "' AND activated = 0;";

    $MIDCheck = mysqli_query($con, $getMeetingIDquery) or die("H: failed to get meeting id callback");

    if(mysqli_num_rows($MIDCheck) != 1)
    {
        echo "I: Class Activation Failed. My activations: " . mysqli_num_rows($MIDCheck) . ", ". $sql . "<br>" . $con->error; //error code #G - failed to activate meeting
        exit();
    }
    $Nexistinginfo = mysqli_fetch_assoc($MIDCheck);

    $meetingIDD = $Nexistinginfo["id"];

    $linkquery = "INSERT INTO studentsinclasses (studentID, classID, Grade) VALUES ('$id', '$meetingIDD' ,'0')";

    //$newupdatequery = "UPDATE meetings SET activated = 1 WHERE meetingID = $meetingIDD;";
    $newupdatequery = "UPDATE classes SET activated = " . 1 . " WHERE id = '" . $meetingIDD . "';";

    mysqli_query($con, $newupdatequery) or die("7: Save query failed" . $sql . "<br>" . $con->error);// error code #7 - Update query failed

    mysqli_query($con, $linkquery) or die("Error: " . $sql . "<br>" . $con->error ."J: Add Class Failed");// error code #F - Add Meeting query failed

    echo "0: Meeting Saved";

?>