<?php
    require_once("dbconnect.php");
?>

<?php

    function get_staff_by_id_main($staff_id) {
        global $mysqli;
        $sql1 = "SELECT * FROM staffs WHERE id = ".$staff_id;
        $result1 = mysqli_query($mysqli, $sql1);
        $staff = mysqli_fetch_assoc($result1);
        $sql2 = "SELECT * FROM educations WHERE student_id = ".$staff_id;
        $result2 = mysqli_query($mysqli, $sql2);
        $education = mysqli_fetch_assoc($result2);
        return [$staff, $education];
    }

    function get_children_by_id_parent($staff_id) {
        global $mysqli;
        $sql = "SELECT parent_id, child_id FROM staffs_childrens WHERE parent_id = ".$staff_id;
        $result = mysqli_query($mysqli, $sql);
        $parents = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $parents;
    }

    function get_child_by_id($child_id) {
        global $mysqli;
        $sql = "SELECT * FROM children WHERE id = ".$child_id;
        $result = mysqli_query($mysqli, $sql);
        $children = mysqli_fetch_assoc($result);
        return $children;
    }

    function saveStaff($staff_id, $staff_surname, $staff_name, $staff_patronymic, $staff_date_of_birth, $place_of_birth, $sex, $nationality, $home_address, $marital_status, $stay_abroad, $attitude_to_military_duty, $awards, $date_of_entry, $experience) {
        global $mysqli;
        $sql = "UPDATE staffs SET surname='".$staff_surname."', staffs.name='".$staff_name."', patronymic='".$staff_patronymic."', date_of_birth='".$staff_date_of_birth."', place_of_birth='".$place_of_birth."', sex='".$sex."', nationality='".$nationality."', home_address='".$home_address."', marital_status='".$marital_status."', stay_abroad='".$stay_abroad."', attitude_to_military_duty='".$attitude_to_military_duty."', awards='".$awards."', date_of_entry='".$date_of_entry."', experience='".$experience."' WHERE id = ".$staff_id;
        if (mysqli_query($mysqli, $sql)) {
            echo "Обновление прошло успешно!";
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
    }

    function saveChild($child_id, $child_surname, $child_name, $child_patronymic, $child_date_of_birth) {
        global $mysqli;
        $sql = "UPDATE children SET surname='".$child_surname."', children.name='".$child_name."', patronymic='".$child_patronymic."', date_of_birth='".$child_date_of_birth."' WHERE id = ".$child_id;
        if (mysqli_query($mysqli, $sql)) {
            echo "Обновление прошло успешно!";
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
    }

    function Tax() {
        global $mysqli;
        $sql = "SELECT * FROM finance WHERE id=1";
        $result = mysqli_query($mysqli, $sql);
        $newTax = mysqli_fetch_assoc($result);
        return $newTax;
    }

    function saveTax($newTax) {
        global $mysqli;
        $sql = "UPDATE finance SET tax=".$newTax;
        if (mysqli_query($mysqli, $sql)) {
            echo "Обновление прошло успешно!";
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
    }

    function get_finance_by_id_staff($staff_id) {
        global $mysqli;
        $sql = "SELECT id, staff_id, finance.month, salary, percent, prize, tax, ((salary + (salary / 100 * percent) + prize) / 100 * (100 - tax)) AS profit FROM finance WHERE staff_id =".$staff_id;
        $result = mysqli_query($mysqli, $sql);
        $finances = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $finances;
    }

    function get_month_by_id($month_id) {
        global $mysqli;
        $sql = "SELECT finance.month, salary, percent, prize, tax, ((salary + (salary / 100 * percent) + prize) / 100 * (100 - tax)) AS profit FROM finance WHERE id = ".$month_id;
        $result = mysqli_query($mysqli, $sql);
        $month = mysqli_fetch_assoc($result);
        return $month;
    }

    function saveMonth($month_id, $prize) {
        global $mysqli;
        $sql = "UPDATE finance SET prize='".$prize."' WHERE id = ".$month_id;
        if (mysqli_query($mysqli, $sql)) {
            echo "Обновление прошло успешно!";
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
    }

    function savePost($staff_id, $post) {
        global $mysqli;
        $sql = "UPDATE staffs SET post='".$post."' WHERE id = ".$staff_id;
        if (mysqli_query($mysqli, $sql)) {
            echo "Обновление прошло успешно!";
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
    }

    function saveStaffMax($staff_id, $staff_surname, $staff_name, $staff_patronymic, $staff_date_of_birth, $place_of_birth, $sex, $nationality, $home_address, $marital_status, $stay_abroad, $attitude_to_military_duty, $awards, $department, $post, $date_of_entry, $experience, $passport_series, $passport_id, $issued_by, $when_issued) {
        global $mysqli;
        $sql = "UPDATE staffs SET surname='".$staff_surname."', staffs.name='".$staff_name."', patronymic='".$staff_patronymic."', date_of_birth='".$staff_date_of_birth."', place_of_birth='".$place_of_birth."', sex='".$sex."', nationality='".$nationality."', home_address='".$home_address."', marital_status='".$marital_status."', stay_abroad='".$stay_abroad."', attitude_to_military_duty='".$attitude_to_military_duty."', awards='".$awards."', department='".$department."', post='".$post."', date_of_entry='".$date_of_entry."', experience='".$experience."', passport_series='".$passport_series."', passport_id='".$passport_id."', issued_by='".$issued_by."', when_issued='".$when_issued."' WHERE id = ".$staff_id;
        if (mysqli_query($mysqli, $sql)) {
            echo "Обновление прошло успешно!";
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
    }

    function saveSalary($month_id, $salary, $percent, $prize) {
        global $mysqli;
        $sql = "UPDATE finance SET salary='".$salary."', percent='".$percent."', prize='".$prize."' WHERE id = ".$month_id;
        if (mysqli_query($mysqli, $sql)) {
            echo "Обновление прошло успешно!";
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
    }

    function get_education_by_id_staff($staff_id) {
        global $mysqli;
        $sql = "SELECT * FROM educations WHERE student_id = ".$staff_id;
        $result = mysqli_query($mysqli, $sql);
        $educations = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $educations;
    }

    function get_education_by_id_education($education_id) {
        global $mysqli;
        $sql = "SELECT * FROM educations WHERE id = ".$education_id;
        $result = mysqli_query($mysqli, $sql);
        $education = mysqli_fetch_assoc($result);
        return $education;
    }

    function saveEducation($education_id, $education_name, $address, $faculty, $form_of_training, $specialty, $date_of_receipt, $expiry_date, $semesters, $number_of_diploma, $languages, $degree, $title) {
        global $mysqli;
        $sql = "UPDATE educations SET educations.name='".$education_name."', educations.address='".$address."', faculty='".$faculty."', form_of_training='".$form_of_training."', specialty='".$specialty."', date_of_receipt='".$date_of_receipt."', number_of_diploma='".$number_of_diploma."', languages='".$languages."', degree='".$degree."', title='".$title."' WHERE id = ".$education_id;
        if (mysqli_query($mysqli, $sql)) {
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
        if ($semesters == NULL) {
            $sql = "UPDATE educations SET semesters=NULL WHERE id = ".$education_id;
        }
        else {
            $sql = "UPDATE educations SET semesters='".$semesters."' WHERE id = ".$education_id;
        }
        if (mysqli_query($mysqli, $sql)) {
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
        if ($expiry_date == NULL) {
            $sql = "UPDATE educations SET educations.expiry_date=NULL WHERE id = ".$education_id;
        }
        else {
            $sql = "UPDATE educations SET educations.expiry_date='".$expiry_date."' WHERE id = ".$education_id;
        }
        if (mysqli_query($mysqli, $sql)) {
        } else {
            echo "Ошибка обновления!" . mysqli_error($mysqli);
        }
        if (!mysqli_error($mysqli)) {
            echo "Обновление прошло успешно!";
        }
    }