<?php


/**
 * @param $page = Page active in the wiew
 * @param $numberPages = Number of pages to show
 * @return string = <li>..</li> to include in <ul></ul>
 */
function paginate ($page, $numberPages)
{
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;          //if no page var is given, default to 1.
    $prev = $page - 1;              //previous page is page - 1
    $next = $page + 1;              //next page is page + 1
    $lastpage = $numberPages;    //lastpage is = total pages / items per page, rounded up.
    $rmn = $lastpage - 1;            //last page minus 1
    $adjacents = 1;


    /*
      Now we apply our rules and draw the pagination object.
      We're actually saving the code to a variable in case we want to draw it more than once.
    */
    $pagination = '';
    if ($lastpage > 1) {
        //previous button
        if ($page > 1)
            $pagination .= "<li><a class='pagi' href='#' value='$prev'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Précédent</span></a></li>";
        else
            $pagination .= "<li class='disabled'><a href='#'>&laquo</a></li>";

        //pages
        if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
        {
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination .= "<li class='active'><a href='#'>$counter</a></li>";
                else
                    $pagination .= "<li><a class='pagi' href='#' value='$counter'>$counter</a></li>";
            }
        } elseif ($lastpage > 5 + ($adjacents * 2))  //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if ($page < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class='active'><a href='#'>$counter</a></li>";
                    else
                        $pagination .= "<li><a class='pagi' href='#' value='$counter'>$counter</a>";
                }
                $pagination .= "<li><a href='#'>...</a></li>";
                $pagination .= "<li><a class='pagi' href='#' value='$rmn'>$rmn</a></li>";
                $pagination .= "<li><a class='pagi' href='#'  value='$lastpage'>$lastpage</a></li>";
            } //in middle; hide some front and some back
            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                $pagination .= "<li><a class='pagi' value ='1' href='#'>1</a></li>";
                $pagination .= "<li><a class='pagi' value ='2' href='#'>2</a></li>";
                $pagination .= "<li><a class='pagi' href='#'>...</a></li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class='active'><a href='#'>$counter</a></li>";
                    else
                        $pagination .= "<li><a class='pagi' href='#' value='$counter'>$counter</a>";
                }
                $pagination .= "<li><a class='pagi' href='#'>...</a></li>";
                $pagination .= "<li><a class='pagi' href='#' value='$rmn'>$rmn</a></li>";
                $pagination .= "<li><a class='pagi' href='#' value='$lastpage'>$lastpage</a></li>";
            } //close to end; only hide early pages
            else {
                $pagination .= "<li><a class='pagi' href='#' value='1'>1</a></li>";
                $pagination .= "<li><a class='pagi'  href='#' value='2'>2</a></li>";
                $pagination .= "<li><a href='#'>...</a></li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class='active'><a href='#'>$counter</a></li>";
                    else
                        $pagination .= "<li><a href='#' value='$counter'>$counter</a></li>";
                }
            }
        }

        //next button
        if ($page < $counter - 1) {
            $pagination .= "<li><a class='pagi' href='#' value= '$next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Suivant</span></a></li>";
        } else {
            $pagination .= "<li class='disabled'><a class='pagi' href='#'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Suivant</span></a></li>";
        }

    }
    return $pagination;
}