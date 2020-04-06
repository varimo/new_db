<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php 
        $staff_id = $_POST['staff_id'];
        $education_id = $_POST['education_id'];
        $education_name = $_POST['education_name'];
        $address = $_POST['address'];
        $faculty = $_POST['faculty'];
        $form_of_training = $_POST['form_of_training'];
        $specialty = $_POST['specialty'];
        $date_of_receipt = $_POST['date_of_receipt'];
        $expiry_date = $_POST['expiry_date'];
        $semesters = $_POST['semesters'];
        $number_of_diploma = $_POST['number_of_diploma'];
        $languages = $_POST['languages'];
        $degree = $_POST['degree'];
        $title  = $_POST['title'];
        saveEducation($education_id, $education_name, $address, $faculty, $form_of_training, $specialty, $date_of_receipt, $expiry_date, $semesters, $number_of_diploma, $languages, $degree, $title);
?>

<br><a href="/education.php?education_id=<?=$education_id?>&staff_id=<?=$staff_id?>">Перейти к образованию</a>
<br><a href="/staff.php?staff_id=<?=$staff_id?>">Перейти к сотруднику</a>

<?php
    //Подключение подвала
    require_once("footer.php");
?>