<?php

function draw_generic_sidebar(){

    echo "<div class=\"col-lg-3 sticky-top sticky-offset align-self-start\" id=\"page-title\">";
        
        echo "<div class=\"row-md-auto\">";
            echo "<div class=\"text-center\">";
                echo "<h2>Home</h2>";
                echo "<a class=\"nav-item nav-link\" href=\"#\"><i class=\"icon-user\" style=\"font-size: 7rem;\"></i></a>";
                echo "<p>John Doe</p>";
                echo "<p>up000000000</p>";
                echo "<p>#mieic</p>";
            echo "</div>";
        echo "</div>";
        
        echo "<hr class=\"featurette-divider\">";

        echo "<div class=\"row-md-auto\">";
            echo "<h4 class=\"text-center\">My CU's</h4>";
                echo "<ul>";
                    
                    echo "<li class=\"list-group-item d-flex justify-content-between align-items-center\">";
                        echo "COMP";
                        echo "<span class=\"badge badge-primary badge-pill\">14</span>";
                    echo "</li>";
                    
                    echo "<li class=\"list-group-item d-flex justify-content-between align-items-center\">";
                        echo "IART";
                        echo "<span class=\"badge badge-primary badge-pill\">2</span>";
                    echo "</li>";
                    
                    echo "<li class=\"list-group-item d-flex justify-content-between align-items-center\">";
                        echo "LBAW";
                        echo "<span class=\"badge badge-primary badge-pill\">1</span>";
                    echo "</li>";
    
                    echo "<li class=\"list-group-item d-flex justify-content-between align-items-center\">";
                        echo "PPIN";
                        echo "<span class=\"badge badge-primary badge-pill\">1</span>";
                    echo "</li>";

                echo "</ul>";
                
        echo "</div>";
    echo "</div>";

}

function draw_cu_sidebar(){

    echo "<div class=\"col-lg-3 sticky-top sticky-offset align-self-start\" id=\"page-title\">";
        
        echo "<div class=\"row-md-auto\">";
            echo "<div class=\"text-center\">";
                echo "<h2>LBAW</h2>";
            echo "</div>";
        echo "</div>";

        echo "<hr class=\"featurette-divider\">";
        
        echo "<div class=\"row-md-auto\">";

            echo "<div class=\"btn-group-vertical\">";
                echo "<button type=\"button\" class=\"btn btn-link\"><h3>General</h3></button>";
                echo "<button type=\"button\" class=\"btn btn-link\"><h3>Drive</h3></button>";
                echo "<button type=\"button\" class=\"btn btn-link\"><h3>Doubts</h3></button>";
                echo "<button type=\"button\" class=\"btn btn-link\"><h3>Tuttoring</h3></button>";
                echo "<button type=\"button\" class=\"btn btn-link\"><h3>Classes</h3></button>";
                echo "<button type=\"button\" class=\"btn btn-link\"><h3>About</h3></button>";
            echo "</div>";
           
        echo "</div>";


    echo "</div>";    

}
