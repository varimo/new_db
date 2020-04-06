<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php 
        $newTax = $_POST['newTax'];
        saveTax($newTax);        
?>

<br><a href="/index.php">Вернуться обратно</a>

<?php
    //Подключение подвала
    require_once("footer.php");
?>