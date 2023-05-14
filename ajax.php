
    <style>
      .texts{
        padding: .5em;
        margin-left:3px;
        font-size: 15px;
        background: transparent;
        border: 1px solid grey;
        border-radius: 10px;
        color: grey;
        }

        .filter-search {
            display: flex;
            width: 100%;
            height: 50px;
          padding-left:3px ;
          justify-content: center;
      
          background-color:  black;
        }
        .filter-search label{
            color: whitesmoke;
            margin:0 5px;
        }
        .dropbox {

            display: flex;
            flex-direction: column;
        }
        .itemsearch{
            background-color: white;
            padding:4px;
        
        }
        .searchdroplist{
            box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        position: relative;
        z-index: 999;
          color:black;
          width:90%;
          margin-top: 1px;
          top: 3px;
          left: 2px;
          border-radius: 50px;
      

        }
        #search{
            width:50vw;
            
           
        }
        #select{
            font-weight: bold;
        }
        .itemsearch:hover{
            background-color: whitesmoke;
            color:black;
            cursor: pointer;
        }
    </style>

    <form class="filter-search">

        <div>
            <label>search Book by </label>

            <select id="select" class='texts'>
                <option value="title">title</option>
                <option value="author">author</option>
                <option value="ISBN">ISBN</option>
            </select>
            <label>for</label>
        </div>
        
        <div class='dropbox'>
       
            <input type="search" class='texts' name="search" id="search" placeholder="anything...." autocomplete="off">
            <div class='searchdroplist'></div>
        </div>
     
    </form>
 <script>
     



   
 </script>