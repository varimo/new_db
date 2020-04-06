<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php 
        $staff_id = $_POST['staff_id'];
        $month_id = $_POST['month_id'];
        $salary = $_POST['salary'];
        $percent = $_POST['percent'];
        $prize = $_POST['prize'];
        saveSalary($month_id, $salary, $percent, $prize);
?>

<br><a href="/finance.php?month_id=<?=$month_id?>&staff_id=<?=$staff_id?>">Перейти к месяцу</a>
<br><a href="/staff.php?staff_id=<?=$staff_id?>">Перейти к сотруднику</a>

<?php
    //Подключение подвала
    require_once("footer.php");
?>