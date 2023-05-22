<?php
session_start();

include 'headers.php'
?>
<div class="header-nav">
    <?php
    include 'navigation.php'

    ?>

    <h2 style="color:black; margin:0;margin-bottom:.5em;text-align:center;font-size:40px;padding:1em;">Welcome Guest</h2>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h2" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="loginlogic.php" method="post">
                        <?php if (isset($_SESSION['message'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['message']; ?>
                            </div>
                        <?php } ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Please type your Student ID here.">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Please type your password here.">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit-btn">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p class="text-muted">Don't have an account? <a href="registrationform.php">Register</a></p>
                </div>
            </div>
        </div>
    </div>

</div>

<section class="search-reserve active">

    <h1 class="cartno" style="padding:1em 0em;padding-left:2em; margin:0;">BOOK COLLECTION</h1>
    <div class="filtercontainer">
        <?php include 'ajax.php'; ?>
        <!-- search field -->
    </div>
    <div class="container-4categories"></div>
    <div class="books-collection"></div>
</section>

<p class="trackcat" style="visibility:hidden;">All</p>

<div class="viewbookcontainer">
</div>

<script>
    //SEARCH AREA
    const tracat = document.querySelector(".trackcat");
    const select = document.querySelector("#select");
    const searchform = document.querySelector(".filter-search");

    const input = document.querySelector("#search");
    const droplistcontainer = document.querySelector(".searchdroplist");

    input.addEventListener('keyup', search);
    droplistcontainer.addEventListener('click', autocomplete);
    searchform.addEventListener('submit', submitsearch);

    function ajaxReq(filename, setparam = '') {
        return new Promise(function(resolve, reject) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", filename, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status == 200) {
                    const res = xhr.responseText;
                    resolve(res);
                } else {
                    reject("failed");
                }
            }

            xhr.send(setparam);
        });
    }

    //events area
    function submitsearch(e) {
        e.preventDefault();
        console.log(tracat.textContent);
        if (input.value.length >= 0) {
            ajaxReq('trysearch2.php',
                `search=${input.value}&select=${select.value}&category=${tracat.textContent}`).then(res => collection.innerHTML = res).catch(err => console.log(err));
        }
    }

    function search(e) {
        if (input.value.length >= 0) {
            ajaxReq('trysearch.php',
                `search=${input.value}&select=${select.value}&category=${tracat.textContent}`).then(res => droplistcontainer.innerHTML = res).catch(err => console.log(err));
            droplistcontainer.style.display = "block";
        }
    }

    function autocomplete(e) {
        if (e.target.dataset.listid) {
            input.value = e.target.textContent;
            droplistcontainer.style.display = "none";
            ajaxReq('trysearch2.php',
                `search=${input.value}&select=${select.value}&category=${tracat.textContent}`).then(res => collection.innerHTML = res).catch(err => console.log(err));
        }
    }

    //end of search area 


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
        ajaxReq('methods/showallbooks.php').then(res => collection.innerHTML = res).catch(err => console.log(err));
    }

    //for filter category buttons "methods/getcollectionjson.php"
    function showcategories() {

        return ajaxReq('methods/getcollectionjson.php').then(res => {
            const categories = getcategories(JSON.parse(res))

            let outputcat = categories.map(e => {
                if (e == "All") {
                    return `<button data-cat="${e}"class="btncatactive">${e}</button>`
                } else {
                    return `<button data-cat="${e}">${e}</button>`
                }
            }).join("");
            categoriescontainer.innerHTML = outputcat
        }).catch(err => console.log(err));

    }
    showcategories();

    //click events for categories
    categoriescontainer.addEventListener("click", filtercat)

    function filtercat(e) {

        if (e.target.dataset.cat) {
            tracat.innerHTML = e.target.dataset.cat;
            const allbtncat = categoriescontainer.querySelectorAll("button");
            allbtncat.forEach(e => {
                e.classList.remove("btncatactive");
            })
            if (e.target.dataset.cat !== "All") {
                e.target.classList.add("btncatactive");
                ajaxReq("methods/filtercategories.php",
                    `category=${e.target.dataset.cat}`).then(res => collection.innerHTML = res).catch(err => console.log(err));
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
            openbookmodal();
            ajaxReq("methods2/viewbookdetail.php", `isbn=${abc}`).then(res => modalbook.innerHTML = res).catch(err => console.log(err));
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

<?php
include 'footer.php';
?>
</body>

</html>