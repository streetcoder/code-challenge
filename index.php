<?php

session_start();

if (!isset($_SESSION['wishlist_cart'])) {
    $_SESSION['wishlist_cart'] = [];
}

require_once 'functions.php';

$results = [];
if(isset($_POST['find_book']) && !empty($_POST['find_book'])) {

    $query_str = filter_var(trim($_POST['find_book']), FILTER_SANITIZE_STRING);

    $results = get_books($query_str);

}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>YARDI Google Books API Code Challenge</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="container">

      <!-- Example row of columns -->
      <div class="row">


        <div class="col-md-offset-2 col-md-3">
            <div class="sidebar">

                <form id="form_find_book" method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" id="find_book" name="find_book" placeholder="Find a Book">
                    </div>
                </form>

                <?php

                    if(!empty($results)){

                        foreach ( $results as $item ) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="book-title"><?php print $item['volumeInfo']['title']. "<br /> \n"; ?></h3>
                                <p class="author">By <?php print $item['volumeInfo']['authors'][0]. "<br /> \n"; ?></p>
                                <button type="button" class="btn btn-default btn-xs wl-add-btn"
                                        data-id="<?php print $item['id']; ?>"
                                        data-title="<?php print $item['volumeInfo']['title']; ?>"
                                        data-author="<?php print $item['volumeInfo']['authors'][0]; ?>"
                                        data-thumb="<?php print $item['volumeInfo']['imageLinks']['thumbnail']; ?>"
                                        data-description="<?php print $item['volumeInfo']['description']; ?>"
                                        data-pageCount="<?php print $item['volumeInfo']['pageCount']; ?>">
                                    <?php print in_array_r($item['id'], $_SESSION['wishlist_cart']) ? 'Added' : 'Add <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'; ?>

                                </button>
                            </div>
                        </div>
                        <hr />
                <?php
                        }
                    }

                ?>

            </div>

        </div>
        <div class="col-md-5">
          <h2 class="text-center wishlist-heading">My Books</h2>


            <div id="wishlist-item-container">
                <?php

                    if(!empty($_SESSION['wishlist_cart'])){

                    foreach ($_SESSION['wishlist_cart'] as $cart){

                ?>
                <div class="book-item">

                    <div class="row">
                        <div class="col-md-4">

                            <img src="<?php print $cart['thumb'] ?>" class="book-item-thumb" alt="">

                        </div>
                        <div class="col-md-8">

                            <h3 class="wishlist-book-title"><?php print $cart['title'] ?></h3>
                            <p>By <?php print $cart['authors'] ?></p>

                            <p><?php print $cart['description'] ?></p>

                            <p class="wishlist-pages"><?php print $cart['pageCount'].' '.'pages' ?></p>

                        </div>
                    </div>
                </div>

                <?php
                        }

                    }else{
                        print "<h4 class='no-books-info bg-info'>No books in the wishlist</h4>";
                    }
                ?>
            </div>

       </div>
      </div>

    </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

    </body>
</html>
