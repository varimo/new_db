<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php 
        $staff_id = $_POST['staff_id'];
        $staff_surname = $_POST['staff_surname'];
        $staff_name = $_POST['staff_name'];
        $staff_patronymic = $_POST['staff_patronymic'];
        $staff_date_of_birth = $_POST['staff_date_of_birth'];
        $place_of_birth = $_POST['place_of_birth'];
        $sex = $_POST['sex'];
        $nationality = $_POST['nationality'];
        $home_address = $_POST['home_address'];
        $marital_status = $_POST['marital_status'];
        $stay_abroad = $_POST['stay_abroad'];
        $attitude_to_military_duty = $_POST['attitude_to_military_duty'];
        $awards = $_POST['awards'];
        $department = $_POST['department'];
        $post = $_POST['post'];
        $date_of_entry = $_POST['date_of_entry'];
        $experience = $_POST['experience'];
        $passport_series = $_POST['passport_series'];
        $passport_id = $_POST['passport_id'];
        $issued_by = $_POST['issued_by'];
        $when_issued = $_POST['when_issued'];
        saveStaffMax($staff_id, $staff_surname, $staff_name, $staff_patronymic, $staff_date_of_birth, $place_of_birth, $sex, $nationality, $home_address, $marital_status, $stay_abroad, $attitude_to_military_duty, $awards, $department, $post, $date_of_entry, $experience, $passport_series, $passport_id, $issued_by, $when_issued);
?>

<br><a href="/staff.php?staff_id=<?=$staff_id?>">Перейти к сотруднику</a>

<?php
    //Подключение подвала
    require_once("footer.php");
?>