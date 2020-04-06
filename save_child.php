<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php 
        $parent_id = $_POST['parent_id'];
        $child_id = $_POST['child_id'];
        $child_surname = $_POST['child_surname'];
        $child_name = $_POST['child_name'];
        $child_patronymic = $_POST['child_patronymic'];
        $child_date_of_birth = $_POST['child_date_of_birth'];
        saveChild($child_id, $child_surname, $child_name, $child_patronymic, $child_date_of_birth);
?>

<br><a href="/child.php?child_id=<?=$child_id?>&parent_id=<?=$parent_id?>">Перейти к ребенку</a>
<br><a href="/staff.php?staff_id=<?=$parent_id?>">Перейти к сотруднику</a>

<?php
    //Подключение подвала
    require_once("footer.php");
?>