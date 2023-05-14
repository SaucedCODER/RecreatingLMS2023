<?php
session_start();
include "connection/oopconnection.php";


if (isset($_POST["username"]) and isset($_POST["password"])) {
    $user = $conn->real_escape_string($_POST["username"]);
    $pass = $conn->real_escape_string($_POST["password"]);
    $sql = "SELECT * from accounts WHERE username = '$user' AND password = '$pass'";
    $res = $conn->query($sql);
    if ($res->num_rows) {
        $row = $res->fetch_assoc();
        $userid = $row['user_id'];
        $username = $row['username'];
        if ($row['status'] == 0) {
            $sqlupdatestatus = "UPDATE accounts SET status = 0 WHERE user_id = $userid";
            $conn->query($sqlupdatestatus) or die("fatal error");
            if ($row["type"] == "ADMIN") {
                header("Location: admins.php?userid=$userid&username=$username");
            } else {
                header("Location: members.php?userid=$userid&username=$username");
            }
        } else {
            $_SESSION['message'] = "Your account is not yet approved..";
            header('Location: home.php');
        }

        $conn->close();
        // status to online


    } else {
        $_SESSION['message'] = "Don't have an account?Just click the link below!";
        header('Location: home.php');
    }
}

// reserve 
// output >> 
// output count 0:0:0 approve reject
//step1
// show all collection 
//step2
//search
