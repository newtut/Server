<?php

    $con = mysqli_connect('bxh4dwfceuoiprsc0heb-mysql.services.clever-cloud.com', 'u1exqv0w4ilg7eep', 'hxQbTSldOIX8Kq9VPsJw', 'bxh4dwfceuoiprsc0heb');

    //check that connection happened

    if(mysqli_connect_errno())
    {
        echo "1: Connection failed"; //error code #1 = connection failed
        exit();
    }

    $username = $_POST["name"];

    //check if name exists and get id
    $namecheckquery = "SELECT username, id, email FROM players WHERE username='" . $username . "';";

    $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //eror code #2 - name check query failed

    $existinginfo = mysqli_fetch_assoc($namecheck);

    $email = $existinginfo["email"];

    $id = $existinginfo["id"];

    if(mysqli_num_rows($namecheck) != 1)
    {
        echo "5: Either no user with name, or more than one" . $username; //error code #5 - number of names matching != 1
        exit();
    }

    //Find in playersinmeetings table all meetings with player id

    $nametomeetingcheckquery = "SELECT playersinmeetings.muted, playersinmeetings.video, playersinmeetings.coHost, meetings.* FROM playersinmeetings, meetings WHERE playersinmeetings.playerID ='" . $id . "' AND playersinmeetings.meetingID = meetings.id;";

    $nametomeetingcheck = mysqli_query($con, $nametomeetingcheckquery) or die("D: Name to meeting check query failed"); //eror code #D - name to meeting check query failed

    //$existinginfo = mysqli_fetch_assoc($nametomeetingcheck);

    //$meetingid = $existinginfo["meetingID"];

    //$muted = $existinginfo["muted"];

    //$meetingid = $existinginfo["video"];

    //$muted = $existinginfo["coHost"];

    //For each meeting in playersinmeetings get the meeting info

    if($nametomeetingcheck->num_rows > 0)
    {
        $meetings = "";
        $rows = array();
        while ($row = $nametomeetingcheck->fetch_assoc()) {
            $rows[] = $row;
            $meetings.= http_build_query($row, "", ",");
            $meetings.= "\t";
            //$meetings .= $row;
        }
        //echo json_encode($rows);
        echo $meetings;
        exit();
    }
    else
    {
        echo "E: No results Found";
        exit();
    }
    
    //Echo meeting info
    echo "0";
    $con->close();
?>