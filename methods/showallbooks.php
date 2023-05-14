<?php


function fetch_data()
{
  include "../connection/oopconnection.php";

  $query = "SELECT * from book_collection JOIN stocks ON book_collection.ISBN = stocks.ISBN;";

  $stmt = $conn->prepare($query);
  $stmt->execute();
  $rows = $stmt->get_result();
  if ($rows->num_rows) {
    while ($data = $rows->fetch_assoc()) {
      $arraydata[] = $data;
    }
    return $arraydata;
  } else {
    return 0;
  }


  $stmt->close();
  $conn->close();
}
$fetchData = fetch_data();
if ($fetchData) {
  echo show_data($fetchData);
} else {
  echo "no books found!";
}

function show_data($fetchData)
{

  include "../connection/oopconnection.php";

  echo '<div class="main-containerofitems">';
  if (count($fetchData) > 0) {


    foreach ($fetchData as $data) {

      if ($data['available'] > 0) {
        $avail = ">>Available<< stocks of [ " . $data['available'] . "/" . $data['quantity'] . " ]";
      } else {
        $avail = "Not Availble";
      }
      $isbnn = $data['ISBN'];
      $sqlImg = "SELECT * FROM book_image where ISBN = '$isbnn'";
      $resultImg = $conn->query($sqlImg);
      $rowImg = $resultImg->fetch_assoc();
      echo "<div style='display:flex;flex-direction:column;' onclick='viewbookev(event)' class='item-container' data-bookuniq='" . $data['ISBN'] . "'>";

      if ($rowImg['status'] == 0) {
        $filename = "../booksimg/book" . $data['ISBN'] . "*";
        $fileInfo = glob($filename);
        $fileext = explode(".", $fileInfo[0]);

        $fileActualExt1 = strtolower(end($fileext));
        echo "<img class='img' loading='lazy'src='booksimg/book" . $data['ISBN'] . ".$fileActualExt1?" . mt_rand() . "'" . $data['ISBN'] . "'>
               ";
      } else {
        echo "<img src='booksimg/bookdefault.png' loading='lazy' class='img'data-bookinfo = '" . $data['ISBN'] . "'>
               ";
      }


      echo "
     
      <span style='font-weight:bold;'>Title :" . $data['title'] . "</span>
      <span>ISBN :" . $data['ISBN'] . "</span>
      <span>Author :" . $data['author'] . "</span>
      <div class='desc'>
          <p>
      Description:
           <p>" . $data['abstract'] . "</p>
          </p>
          <div>.$avail.</div>
          </div>
 
 
          <button id='addcartbtn' data-isbn='" . $data['ISBN'] . "'>Add TO CART</button>
      </div>";
    }
    $conn->close();
  } else {

    echo "

     ";
  }

  echo "</div>";
}
