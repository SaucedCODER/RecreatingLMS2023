<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="./css/bookcollection.css">

</head>

<body>
    <style>
        * {

            font-family: sans-serif;
            box-sizing: border-box;
        }

        .btncatactive {
            background: black;
            color: white;

        }

        body {
            margin: 0;


        }


        .header-nav nav {
            /* background-color: #4D0404; */
            background-color: rgb(41, 41, 41);
            box-sizing: border-box;
            width: 100%;
            padding: 2em 1em;
            color: white;
            box-shadow: 0px 1px 4px grey;
            height: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .loginbtn {
            border-radius: 50px;
            background-color: dodgerblue;
            outline: 2px solid #999;
            border: none;
            color: white;
            font-size: 1rem;
            padding: .2em 1em;
            margin-right: 2em;
        }

        .loginbtn:hover {
            color: white;
            outline: 2px solid dodgerblue;
            background-color: rgb(41, 41, 41);
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
            z-index: 99;
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
            font-size: 3rem;
            line-height: 70px;
            margin-right: 2px;
            color: goldenrod;
        }

        .modal-login form input {
            margin: .4em auto;
            padding: .4em;
            background-color: rgba(0, 0, 0, 0.7);
            color: #eee;
            border-radius: 3px;
            border: 1px solid grey;
            width: 90%;
        }

        .btn-login-modal {
            border: none;
            width: 12em;
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
    </style>




    <div class="header-nav">

        <nav>
            <h1>Library Management System</h1>
            <div class="links-container">
                <a href="home.php" class="active">Book Collection</a>
                <a href="aboutus.php">About us</a>
            </div>
            <button class="loginbtn">Login</button>
        </nav>
        <div class="heading-text" style="padding:5rem 0; ">
            <h2 style="color:dodgerblue; margin:0;text-align:center;font-size:2.5rem;">Welcome to Our School Library</h2>
            <p style="color:#999;text-align:center;">Explore Our Books and Resources Today!</p>
        </div>

        <div class="modal-login">

            <form action="loginlogic.php" method="post">
                <div style="color:yellowgreen;width:200px;"><span style="color:white;margin-right:2px;font-size:20px;">*</span><?php if (isset($_SESSION['message'])) {

                                                                                                                                    echo $_SESSION['message'];
                                                                                                                                } ?></div>
                <p><span class="fletter">L</span>ogIn</p>

                <input type="text" autocomplete="off" name="username" placeholder="your student id">
                <input type="password" autocomplete="off" name="password" placeholder="your password">
                <button class="btn-login-modal" style="margin-top:1em;" name="submit-btn" type="submit">Submit</button>
                <button class="btn-login-modal " id="close-login">Close</button>
                <a href="registrationform.php" style="color:yellowgreen;margin-top:1em;">Click here to register</a>
            </form>

        </div>

    </div>

    <section class="search-reserve active" style="margin:0 auto">

        <h1 class="cartno" style="padding:1em 0em;padding-left:2em; margin:0;">BOOK COLLECTION</h1>
        <div class="filtercontainer">
            <?php include './partials/Filterform.php'; ?>
            <!-- search field -->
        </div>
        <div class="container-4categories"></div>
        <div class="books-collection"></div>
    </section>

    <p class="trackcat" style="visibility:hidden;">All</p>


    <!-- bookmodal -->
    <style>
        /* show modal */
        .show-modal {
            transform: scale(1);
            transition: all 200ms;
        }

        .donthidemodal {
            transform: scale(1);

        }

        /* modal view books */
        .viewbookcontainer {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            place-items: center;
        }

        .bookdata {
            background-color: whitesmoke;
            height: 90%;
            width: 95%;
            overflow: auto;
            padding: 1em;
            box-sizing: border-box;
        }

        .bookdata h5 {
            display: inline;
            font-size: 24px;
            font-family: sans-serif;
        }

        .bookdata span {
            font-size: 22px;

        }

        .bookdata img {
            width: 300px;
            height: 320px;
            background: burlywood;
        }

        .bookdata .intro {
            display: flex;
            gap: 1em;
        }

        .bookdata a {
            font-size: 23px;
            color: navy;
            background: rgba(0, 0, 0, 0.2);
            padding: .5em;
            border-radius: 10px;
            text-decoration: none;
        }

        .showmodalbk {
            display: grid;
        }
    </style>
    <div class="viewbookcontainer">


    </div>

    <script src="./js/search.js"></script>

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
            unset($_SESSION['message']);
        }
        ?>


        logclose.addEventListener('click', closemodal);

        function closemodal(e) {
            e.preventDefault();

            modalcontainer.classList.remove("show-modal");

            modalcontainer.classList.remove("donthidemodal");

        }
        // login modal codes ends

        //variable declaration


        const sections = document.querySelectorAll("section");
        const searchandreserve = document.querySelector(".search-reserve");
        const categoriescontainer = document.querySelector(".container-4categories");

        const collection = document.querySelector(".books-collection");


        //click outside other events function for closing of modals
        window.addEventListener('click', () => {

            droplistcontainer.style.display = "none";
        })
        showallcollection();
        //collection
        function showallcollection() {

            const xhr = new XMLHttpRequest();
            xhr.open("GET", "methods/showallbooks.php", true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    const res = xhr.responseText;
                    collection.innerHTML = res;


                } else {
                    console.log("failed");
                }
            }
            xhr.send();
        }

        //for filter category buttons
        function showcategories() {
            const xhrs = new XMLHttpRequest();
            xhrs.open("GET", "methods/getcollectionjson.php", true);

            xhrs.onload = function() {
                if (xhrs.status == 200) {
                    const res = JSON.parse(xhrs.responseText);
                    console.log(res);

                    const categories = getcategories(res);

                    let outputcat = categories.map(e => {
                        if (e == "All") {
                            return `<button data-cat="${e}"class="btncatactive">${e}</button>`
                        } else {
                            return `<button data-cat="${e}">${e}</button>`
                        }

                    }).join("");
                    categoriescontainer.innerHTML = outputcat;

                } else {
                    console.log("failed");
                }

            }
            xhrs.send();

        }
        showcategories();

        //click events for categories
        categoriescontainer.addEventListener("click", filtercat)

        function filtercat(e) {

            console.log(e.target.dataset.cat);

            if (e.target.dataset.cat) {
                tracat.innerHTML = e.target.dataset.cat;
                const allbtncat = categoriescontainer.querySelectorAll("button");
                allbtncat.forEach(e => {
                    e.classList.remove("btncatactive");
                })
                if (e.target.dataset.cat !== "All") {
                    e.target.classList.add("btncatactive");
                    const param = `category=${e.target.dataset.cat}`;
                    const xhrs = new XMLHttpRequest();
                    xhrs.open("POST", "methods/filtercategories.php", true);

                    xhrs.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                    xhrs.onload = function() {
                        if (xhrs.status == 200) {
                            const res = xhrs.responseText;
                            collection.innerHTML = res;


                        } else {

                            console.log("failed");
                        }

                    }
                    xhrs.send(param);
                } else {
                    e.target.classList.add("btncatactive");
                    showallcollection();
                }
            }

        }

        //show button category
        function getcategories(items) {
            const categorylist = items.reduce((total, item) => {
                if (!total.includes(item.category)) {
                    total.push(item.category);
                }
                return total;
            }, ["All"])

            return categorylist;
        }

        //book modal area

        const modalbook = document.querySelector(".viewbookcontainer");

        function viewbookev(e) {

            if (e.currentTarget.dataset.bookuniq) {
                const abc = e.currentTarget.dataset.bookuniq;
                console.log(abc);
                openbookmodal();
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "methods2/viewbookdetail.php", true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        const res = xhr.responseText;
                        modalbook.innerHTML = res;
                    } else {
                        console.log("failed");
                    }
                }
                xhr.send(`isbn=${abc}`);
            }
        }

        function openbookmodal() {
            modalbook.classList.add("showmodalbk");
        }

        function closebookmodal(e) {
            e.preventDefault();
            modalbook.classList.remove("showmodalbk");
        }
    </script>
</body>

</html>