<?php 
$child_id  = $_GET['child_id'];
$parent_id = $_GET['parent_id'];

if (!is_numeric($child_id)) exit();
if (!is_numeric($parent_id)) exit();
?>


<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php    
    $child = get_child_by_id($child_id);
?>

<?php #для админа
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && ($_SESSION['login'] == 'admin' || $_SESSION['login'] == 'PersonnelDepartment')){ 
    ?>
        <div class="container-fluid">
            <form action="save_child.php" method="post">        
                <input type="hidden" name="child_id" value="<?=$child['id']?>">
                <input type="hidden" name="parent_id" value="<?=$parent_id?>">
                <div class="border"><p>Фамилия: <input type="text" id="child_surname" name="child_surname" value="<?=$child['surname']?>"></p></div>
                <div class="border"><p>Имя: <input type="text" id="child_name" name="child_name" value="<?=$child['name']?>"></p></div>
                <div class="border"><p>Отчество: <input type="text" id="child_patronymic" name="child_patronymic" value="<?=$child['patronymic']?>"></p></div>
                <div class="border"><p>Дата рождения: <input type="text" id="child_date_of_birth" name="child_date_of_birth" value="<?=$child['date_of_birth']?>"></p></div>
                <button type="submit" class="btn btn-secondary">Сохранить</button>
            </form>
            <a href="/staff.php?staff_id=<?=$parent_id?>">Перейти к сотруднику</a>    
        </div>               
    <?php }
?>

<?php
    //Подключение подвала
    require_once("footer.php");
?>