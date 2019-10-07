<?php 
    include_once('header.php');
    include_once('nav.php');
?>
<?php
    include_once('model/book.php');
    $book = new Book(1,"OOP in PHP",50,"Hue",2019);
    $book->display();
?>
<?php 
    include_once('footer.php');
?>