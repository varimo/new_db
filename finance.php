<?php 
$month_id  = $_GET['month_id'];
$staff_id = $_GET['staff_id'];

if (!is_numeric($month_id)) exit();
if (!is_numeric($staff_id)) exit();
?>


<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php    
    $month = get_month_by_id($month_id);
?>

<?php 
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'director'){ 
    ?>
        <div class="container-fluid">
            <form action="save_month.php" method="post">        
                <input type="hidden" name="month_id" value="<?=$month_id?>">
                <input type="hidden" name="staff_id" value="<?=$staff_id?>">
                <div class="border"><p>Месяц: <?=$month['month']?></p></div>
                <div class="border"><p>Оклад: <?=$month['salary']?></p></div>
                <div class="border"><p>Процент: <?=$month['percent']?></p></div>
                <div class="border"><p>Премия: <input type="text" id="prize" name="prize" value="<?=$month['prize']?>"></p></div>
                <div class="border"><p>Налог: <?=$month['tax']?></p></div>
                <div class="border"><p>На руки: <?=$month['profit']?></p></div>
                <button type="submit" class="btn btn-secondary">Сохранить</button>
            </form>
            <a href="/staff.php?staff_id=<?=$staff_id?>">Перейти к сотруднику</a>    
        </div>               
    <?php }
?>

<?php 
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'accounting'){ 
    ?>
        <div class="container-fluid">
            <form action="save_salary.php" method="post">        
                <input type="hidden" name="month_id" value="<?=$month_id?>">
                <input type="hidden" name="staff_id" value="<?=$staff_id?>">
                <div class="border"><p>Месяц: <?=$month['month']?></p></div>
                <div class="border"><p>Оклад: <input type="text" id="salary" name="salary" value="<?=$month['salary']?>"></p></div>
                <div class="border"><p>Процент: <input type="text" id="percent" name="percent" value="<?=$month['percent']?>"></p></div>
                <div class="border"><p>Премия: <input type="text" id="prize" name="prize" value="<?=$month['prize']?>"></p></div>
                <div class="border"><p>Налог: <?=$month['tax']?></p></div>
                <div class="border"><p>На руки: <?=$month['profit']?></p></div>
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