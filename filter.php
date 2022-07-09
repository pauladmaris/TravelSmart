<?php 
    // filter posts after search:
    if($location == "" && $tag == "" && $person_type == "" ) {     
        $sql = "SELECT * FROM posts ORDER BY id_post DESC";        
    }
    else if($location == "" && $tag != "" && $person_type == "" ) {     
        $sql = "SELECT * FROM posts WHERE tag LIKE '%$tag%' ORDER BY id_post DESC";
    }
        else if($location == "" && $tag == "" && $person_type != "" ) {     
            $sql = "SELECT * FROM posts WHERE person_type LIKE '%$person_type%' ORDER BY id_post DESC";
        }
            else if($location != "" && $tag == "" && $person_type == "" ) {     
                $sql = "SELECT * FROM posts WHERE location LIKE '%$location%' ORDER BY id_post DESC";
            }
                else if($location != "" && $tag == "" && $person_type != "" ) {     
                    $sql = "SELECT * FROM posts WHERE (location LIKE '%$location%' AND person_type LIKE '%$person_type%') ORDER BY id_post DESC";
                }
                    else if($location != "" && $tag != "" && $person_type == "" ) {     
                        $sql = "SELECT * FROM posts WHERE (location LIKE '%$location%' AND tag LIKE '%$tag%') ORDER BY id_post DESC";
                    } 
                        else { 
                            $sql = "SELECT * FROM posts WHERE (location LIKE '%$location%' AND person_type LIKE '%$person_type%' AND tag LIKE '%$tag%') ORDER BY id_post DESC";
                        }
?>