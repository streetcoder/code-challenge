<?php

session_start();

require_once 'functions.php';

if(isset($_POST) && !empty($_POST)){

    $action = filter_var(trim($_POST['action']), FILTER_SANITIZE_STRING);

    switch ($action) {

        case "add_item":

                add_item($_POST);

            break;

        default:
            echo "You did not make any request to add.";
    }

}else{
    header("Location: /");
}

function add_item($request){

    $id = filter_var(trim($request['id']), FILTER_SANITIZE_STRING);
    $title = filter_var(trim($request['title']), FILTER_SANITIZE_STRING);
    $author = filter_var(trim($request['author']), FILTER_SANITIZE_STRING);
    $thumb = filter_var(trim($request['thumb']), FILTER_SANITIZE_STRING);
    $description = filter_var(trim($request['description']), FILTER_SANITIZE_STRING);
    $pageCount = filter_var(trim($request['pageCount']), FILTER_SANITIZE_STRING);

    $wish_to_add = [
        'id' => $id,
        'title' => $title,
        'authors' => $author,
        'thumb' => $thumb,
        'description' => get_words($description, 25),
        'pageCount' => $pageCount
    ];

    $is_in_list = in_array_r($id, $_SESSION['wishlist_cart']) ? 'found' : 'notfound';

    if($is_in_list == 'notfound'){
        $_SESSION['wishlist_cart'][] = $wish_to_add;

        echo '<div class="book-item">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="'.$thumb.'" class="book-item-thumb" alt="">
                        </div>
                        <div class="col-md-8">
                            <h3 class="wishlist-book-title">'.$title.'</h3>
                            <p>By '.$author.'</p>
                            <p>'.get_words($description, 25).'</p>
                            <p class="wishlist-pages">'.$pageCount.' '.'pages</p>
                        </div>
                    </div>
                </div>';

    }else{
        print "<h4 class='no-books-info bg-info'>Book is already in the wish list</h4>";
    }
}
