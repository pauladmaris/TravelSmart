
<div class="flex-container">
   <form method="post">
        <div class="search-container">
            <input class="search-input" type="text" id="myInput" placeholder="Search location.." name="searchStr" autocomplete="off">
            <button type="submit" class="search-button" name="search" > <i onclick="changeIcon()" aria-hidden="true" id="srch" class="fa fa-search"></i></button>
        </div>

        <div class="search-wrapper">
            <select class="selectStyle" name="tag" id="tag" >
                <option selected disabled value="">Choose tag</option>
                <option value="">All</option>
                <option value="Transport">Transport</option>
                <option value="Food">Food</option>
                <option value="Hotel">Hotel</option>
                <option value="Attraction">Attraction</option>
            </select>
                    
            <select class="selectStyle" name="person_type" id="person_type" >
                <option selected disabled value="">Choose type</option>
                <option value="">All</option>
                <option value="Traveler">Traveler</option>
                <option value="Local">Local</option>
            </select>
        </div>
    </form>
</div> 

<?php
    //search button
    if (isset($_POST["search"])) {
        $location = $_POST["searchStr"];
        $tag = $_POST["tag"];
        $person_type = $_POST["person_type"];
    } 
?>

        
        