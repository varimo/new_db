<?php 
$education_id  = $_GET['education_id'];
$staff_id = $_GET['staff_id'];

if (!is_numeric($education_id)) exit();
if (!is_numeric($staff_id)) exit();
?>


<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php    
    $education = get_education_by_id_education($education_id);
?>

<?php 
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && (($_SESSION['login'] == 'admin') || ($_SESSION['login'] == 'director') || ($_SESSION['login'] == 'PersonnelDepartment'))){ 
    ?>
        <div class="container-fluid">
            <form action="save_education.php" method="post">        
                <input type="hidden" name="education_id" value="<?=$education_id?>">
                <input type="hidden" name="staff_id" value="<?=$staff_id?>">
                <div class="border"><p><b>Название университета:</b> <input type="text" id="education_name" name="education_name" value="<?=$education['name']?>"></p></div>
                <div class="border"><p><b>Адрес:</b> <input type="text" id="address" name="address" value="<?=$education['address']?>"></p></div>
                <div class="border"><p><b>Факультет:</b> <input type="text" id="faculty" name="faculty" value="<?=$education['faculty']?>"></p></div>
                <div class="border"><p><b>Форма обучения:</b> <input type="text" id="form_of_training" name="form_of_training" value="<?=$education['form_of_training']?>"></p></div>
                <div class="border"><p><b>Специальность:</b> <input type="text" id="specialty" name="specialty" value="<?=$education['specialty']?>"></p></div>
                <div class="border"><p><b>Дата поступления:</b> <input type="text" id="date_of_receipt" name="date_of_receipt" value="<?=$education['date_of_receipt']?>"></p></div>
                <div class="border"><p><b>Дата окончания:</b> <input type="text" id="expiry_date" name="expiry_date" value="<?=$education['expiry_date']?>"></p></div>
                <div class="border"><p><b>Количество семестров:</b> <input type="text" id="semesters" name="semesters" value="<?=$education['semesters']?>"></p></div>
                <div class="border"><p><b>Номер диплома:</b> <input type="text" id="number_of_diploma" name="number_of_diploma" value="<?=$education['number_of_diploma']?>"></p></div>
                <div class="border"><p><b>Языки:</b> <input type="text" id="languages" name="languages" value="<?=$education['languages']?>"></p></div>
                <div class="border"><p><b>Ученая степень:</b> <input type="text" id="degree" name="degree" value="<?=$education['degree']?>"></p></div>
                <div class="border"><p><b>Звание:</b> <input type="text" id="title" name="title" value="<?=$education['title']?>"></p></div>
                <button type="submit" class="btn btn-secondary">Сохранить</button>
            </form>
            <a href="/staff.php?staff_id=<?=$staff_id?>">Перейти к сотруднику</a>    
        </div>               
    <?php }
?>

<?php
    //Подключение подвала
    require_once("footer.php");
?>