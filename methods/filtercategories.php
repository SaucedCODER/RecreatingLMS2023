<?php 
include "../connection/oopconnection.php";

if(isset($_POST['category'])){
    
    $link = $_POST['category'];

    $array = array();
       
        $query = "SELECT * FROM book_collection join stocks on category = '$link' and book_collection.ISBN = stocks.ISBN";

    $res = $conn->query($query); 
    while( $row = $res->fetch_assoc()){
        $array[]=$row;
        }
   function show_data($array){
    include "../connection/oopconnection.php";

    echo '<div class="main-containerofitems">';
    if(count($array)>0){
       
         foreach($array as $data){ 
            if($data['available']>0){
                $avail = ">>Available<< stocks of [ ".$data['available']."/".$data['quantity']." ]";
    
               }else{
                $avail = "Not Availble";
               }

               $isbnn= $data['ISBN'];
               $sqlImg = "SELECT * FROM book_image where ISBN = '$isbnn'";
               $resultImg = $conn->query($sqlImg);
               $rowImg = $resultImg->fetch_assoc();
               echo "<div style='display:flex;flex-direction:column;' onclick='viewbookev(event)' class='item-container' data-bookuniq='".$data['ISBN']."'>";
         
                     if ($rowImg['status'] == 0) {
                         $filename = "../booksimg/book".$data['ISBN']."*";
                        $fileInfo = glob($filename);
                        $fileext = explode(".", $fileInfo[0]);
                        $fileActualExt1 = strtolower(end($fileext));
         
                        echo "<img class='img' src='booksimg/book".$data['ISBN'].".$fileActualExt1?".mt_rand()."'". $data['ISBN']."'>
                        ";
                     }
                     else {
                        echo "<img src='booksimg/bookdefault.png' class='img'data-bookinfo = '". $data['ISBN']."'>
                        ";
                    
                     }
     echo "

     <span style='font-weight:bold;'>Title :".$data['title']."</span>
     <span>ISBN :" . $data['ISBN'] . "</span>
     <span>Author :".$data['author']."</span>
     <div class='desc'>
         <p>
     Description:
          <p>".$data['abstract']."</p>
         </p>
         <div>.$avail.</div>
         </div>


         <button id='addcartbtn' data-isbn='".$data['ISBN']."'>Add TO CART</button>
     </div>";
          
   
        }
   }else{
        
     echo "
     "; 
   }
     echo "</div>";

}
show_data($array);
$conn->close();
} 
?>