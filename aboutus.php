<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        * {

            font-family: arial, sans-serif;
        }

        body {
            margin: 0;


        }

        button {
            padding: .6em;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            margin: 3px 1px;
            transition-duration: 0.4s;
            cursor: pointer;
            background-color: whitesmoke;
            color: black;
            border: 2px solid #555555;
        }

        button:hover {
            background-color: #555555;
            color: white;
        }

        .header-nav {
            display: block;

        }

        .header-nav nav {
            background-color: rgb(41, 41, 41);

            box-sizing: border-box;
            width: 100%;
            padding: .1em 1em;
            color: white;
            box-shadow: 0px 1px 4px grey;
            height: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .loginbtn {
            background-color: rgb(41, 41, 41);
            color: white;
            border: 1px solid white;
            font-size: 17px;
            padding: .2em 1em;
            margin-right: 4em;
        }

        .loginbtn:hover {
            color: white;
            border: 1px solid grey;
            background-color: rgb(41, 41, 41);
        }

        .modal-login {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            place-items: center;
            z-index: 99;

        }

        .modal-login form {
            width: 100px;
            /* #1 */
            border: 3px solid hsl(0, 0%, 40%);

            /* #2 */
            padding: 3px;
            background: hsl(0, 0%, 20%);
            /* #3 */
            outline: 3px solid hsl(0, 0%, 60%);
            /* #4 AND INFINITY!!! (CSS3 only) */
            box-shadow:
                0 0 0 5px hsl(0, 0%, 80%),
                0 0 0 8px hsl(0, 0%, 90%);
            background-color: rgba(0, 0, 0, 0.9);

            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 2em 8em 8em 5em;
        }

        .modal-login form p {
            font-size: 35px;
            color: whitesmoke;
        }

        .fletter {
            font-size: 100px;
            line-height: 70px;
            margin-right: 2px;
            color: goldenrod;
        }

        .modal-login form input {
            margin: .4em 0em;
            padding: .4em;
            background-color: rgba(0, 0, 0, 0.7);
            color: #eee;
            border-radius: 3px;
            border: 1px solid grey;
            width: 5rem;
        }

        .btn-login-modal {
            border: none;
            width: 11em;
            border-radius: 5px;

        }

        .links-container {
            margin-left: auto;
            margin-right: 1.2em;


        }

        .links-container a {
            text-decoration: none;
            font-size: 17px;
            font-weight: normal;
            color: whitesmoke;
            margin: 0em .3em;
            padding: .2em;

            position: relative;

        }

        .links-container a::before {
            content: '';
            height: 1px;
            width: 100%;
            background-color: white;
            position: absolute;
            z-index: 99;
            bottom: 0px;
            transform: scale(0);
            transition: all 170ms;

        }

        .links-container a:hover:not(.active)::before {

            transform: scale(1);
        }

        .links-container a.active::before {
            transform: scale(1);
        }

        .modal-login {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.8);
            display: grid;
            place-items: center;
            transform: scale(0);
        }

        .modal-login form {
            width: 100px;

            /* #1 */
            border: 1px solid hsl(0, 0%, 40%);

            /* #2 */
            padding: 1px;
            background: hsl(0, 0%, 20%);

            /* #3 */
            outline: 2px solid hsl(0, 0%, 60%);

            /* #4 AND INFINITY!!! (CSS3 only) */
            box-shadow:
                0 0 0 5px hsl(0, 0%, 80%),
                0 0 0 8px hsl(0, 0%, 90%);
            background-color: rgba(0, 0, 0, 0.9);

            display: flex;

            width: 300px;
            height: 420px;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            align-items: center;

        }

        .modal-login form p {
            font-size: 35px;
            color: whitesmoke;
        }

        .fletter {
            font-size: 100px;
            line-height: 70px;
            margin-right: 2px;
            color: goldenrod;
        }

        .modal-login form input {
            margin: .4em 0em;
            padding: .4em;
            background-color: rgba(0, 0, 0, 0.7);
            color: #eee;
            border-radius: 3px;
            border: 1px solid grey;
            width: 11em;
        }

        .btn-login-modal {
            border: none;
            width: 12em;
            border-radius: 5px;

        }


        /* show modal */
        .show-modal {
            transform: scale(1);
            transition: all 200ms;
        }

        .donthidemodal {
            transform: scale(1);

        }
    </style>
    <div class="header-nav">

        <nav>
            <h1>Library Management System</h1>
            <div class="links-container">
                <a href="home.php">Book Collection</a>
                <a href="aboutus.php" class="active">About us</a>
            </div>
            <button class="loginbtn">Login__</button>
        </nav>


        <div class="modal-login">

            <form action="loginlogic.php" method="post">
                <div style="color:yellowgreen;width:200px;"><span style="color:white;margin-right:2px;font-size:20px;">*</span><?php if (isset($_SESSION['message'])) {
                                                                                                                                    echo $_SESSION['message'];
                                                                                                                                } ?></div>
                <p><span class="fletter">L</span>ogIn</p>

                <input type="text" autocomplete="off" name="username" placeholder="STUDENT-ID....">
                <input type="text" autocomplete="off" name="password" placeholder="PASSWORD....">
                <button class="btn-login-modal" style="margin-top:1em;" name="submit-btn" type="submit">Submit</button>
                <button class="btn-login-modal " id="close-login">Close</button>
                <a href="registrationform.php" style="color:yellowgreen;">register?</a>
            </form>

        </div>


        <div style="margin-left:2rem;">


            <h1>About us</h1>
            <h3>What is the purpose of library system? </h3>
            <p>Thus a library is also a system and its various sections/divisions are its components.</p>
            <p>The primary objective of any library system is to collect, store, organize, retrieve and make available the information sources to the information users.</p>


            <h2>Policy</h2>
            <h3> C. Policies
                The system will be operating under following policies:</h3>
            <p>1. Reservation Policy</p>
            <p>a. Only active members can make the reservation of the title</p>
            <p>b. Maximum of three books can be reserved by particular member, unless otherwise a new policy for allowable number of books to be borrowed is approved.</p>
            <p>c. Reservation is valid only for twenty-four (24) hours, unless otherwise a new policy on validity of reservation is approved.
            </p>
            <p>2. Borrowing Policy</p>
            <p>
                a. Only active members can borrow books</p>

        </div>



        <script>
            // login modal codes
            const modalcontainer = document.querySelector(".modal-login");
            const logbtn = document.querySelector(".loginbtn");
            const logclose = document.querySelector("#close-login");

            logbtn.addEventListener("click", showmodal);

            function showmodal() {

                modalcontainer.classList.add("show-modal");

            }

            function stuckmodal() {
                modalcontainer.classList.add("donthidemodal");

            }
            <?php
            if (!empty($_GET['action'])) {
                echo "stuckmodal();";
            } else if (isset($_SESSION['message'])) {
                echo "stuckmodal();";
            }
            ?>

            logclose.addEventListener('click', closemodal);

            function closemodal(e) {
                e.preventDefault();

                modalcontainer.classList.remove("show-modal");

                modalcontainer.classList.remove("donthidemodal");

            }
        </script>

</body>


</html>