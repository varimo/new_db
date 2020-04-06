<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php 
        $staff_id = $_POST['staff_id'];
        $post = $_POST['post'];
        savePost($staff_id, $post);
?>

<br><a href="/staff.php?staff_id=<?=$staff_id?>">Перейти к сотруднику</a>

<?php
    //Подключение подвала
    require_once("footer.php");
?>