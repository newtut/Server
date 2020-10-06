<?php
session_start();
$output = NULL;

if(!isset($SESSION['loggedin']))
{
    //Display Welcome Guest / Display login form
    $output = "Welcome Guest.<p />";

}
?>

<form method="POST" id="sendForm" target="redirectHandle" action="https://app-b966dfc7-dd5a-4f82-a845-bdb827b087e6.cleverapps.io/sqlconnect/login/login.php">
    <table border="0" align="center" cellpadding="5">
        <tr>
            <td align="right">Username:</td>
            <td><input type="TEXT" name="u" required/></td>
        </tr>
        <tr>
            <td align="right">Password:</td>
            <td><input type="TEXT" name="p" required/></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="SUBMIT" name="submit" value="Log In" required/></td>
        </tr>
    </table>
</form>