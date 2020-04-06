<?php
    $filter_surname = NULL;
    $filter_name = NULL;
    $filter_patronymic = NULL;
    $filter_department = NULL;
    $filter_post = NULL;
    if ($_POST != NULL) {
        $filter_surname = $_POST['filter_surname'];
        $filter_name = $_POST['filter_name'];
        $filter_patronymic = $_POST['filter_patronymic'];
        $filter_department = $_POST['filter_department'];
        $filter_post = $_POST['filter_post'];
    }
    if ($_POST == NULL) {
        function printStaff($filter_surname, $filter_name, $filter_patronymic, $filter_department, $filter_post) {
            global $mysqli;
            $sql = "SELECT * FROM staffs";
            $result = mysqli_query($mysqli, $sql);        
            $staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $staffs;
        }
    } else {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        function printStaff($filter_surname, $filter_name, $filter_patronymic, $filter_department, $filter_post) {
            global $mysqli;
            $sql = "SELECT * FROM staffs";             
            if ($filter_surname != "")
            {
                $sql = "SELECT * FROM (" . $sql . ") AS T WHERE surname='$filter_surname'";
            }
            if ($filter_name != "")
            {
                $sql = "SELECT * FROM (" . $sql . ") AS T WHERE name='$filter_name'";
            }
            if ($filter_patronymic != "")
            {
                $sql = "SELECT * FROM (" . $sql . ") AS T WHERE patronymic='$filter_patronymic'";
            }
            if ($filter_department != "")
            {
                $sql = "SELECT * FROM (" . $sql . ") AS T WHERE department='$filter_department'";
            }
            if ($filter_post != "")
            {
                $sql = "SELECT * FROM (" . $sql . ") AS T WHERE post='$filter_post'";
            }
            $result = mysqli_query($mysqli, $sql);     
            $staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $staffs;
        }        
    }    
?>

<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php 
    $staffs = printStaff($filter_surname, $filter_name, $filter_patronymic, $filter_department, $filter_post);
?>

<?php
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] != 'TradeUnion'){ 
    ?>
    <div class="container-fluid">
        <div class="filters">
            <form action="index.php" method="post">
                <p><b>Фильтры:</b></p>
                <p>По фамилии: <input type="text" id="filter_surname" name="filter_surname" value=""></p>
                <p>По имени: <input type="text" id="filter_name" name="filter_name" value=""></p>
                <p>По отчеству: <input type="text" id="filter_patronymic" name="filter_patronymic" value=""></p>
                <p>По отделу: <input type="text" id="filter_department" name="filter_department" value=""></p>
                <p>По должности: <input type="text" id="filter_post" name="filter_post" value=""></p>
                <button type="submit" class="btn btn-secondary">Фильтровать</button>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Отчество</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Отдел</th>
                <th scope="col">Должность</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($staffs as $staff): ?>
                    <tr>
                        <td><p><a href="/staff.php?staff_id=<?=$staff['id']?>"><?=$staff['surname']?></a></p></td>
                        <td><p><?=$staff['name']?></p></td>
                        <td><p><?=$staff['patronymic']?></p></td>
                        <td><p><?=$staff['date_of_birth']?></p></td>
                        <td><p><?=$staff['department']?></p></td>
                        <td><p><?=$staff['post']?></p></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>          
    <?php }
?>

<?php
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'admin'){ 
    ?>
        <?php $newTax = Tax(); ?>
        <form action="save_tax.php" method="post">
            <div class="tax">
                <p>Ставка налога: <input type="text" id="newTax" name="newTax" value="<?=$newTax['tax']?>"></p>
                <button type="submit" class="btn btn-secondary">Изменить ставку</button>
            </div> 
        </form>               
    <?php }
?>

<?php
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'TradeUnion'){ 
    ?>
    <?php $count2 = 0; ?>
    <div class="container-fluid">
        <div class="filters">
            <form action="index.php" method="post">
                <p><b>Фильтры:</b></p>
                <p>По фамилии: <input type="text" id="filter_surname" name="filter_surname" value=""></p>
                <p>По имени: <input type="text" id="filter_name" name="filter_name" value=""></p>
                <p>По отчеству: <input type="text" id="filter_patronymic" name="filter_patronymic" value=""></p>
                <p>По отделу: <input type="text" id="filter_department" name="filter_department" value=""></p>
                <p>По должности: <input type="text" id="filter_post" name="filter_post" value=""></p>
                <button type="submit" class="btn btn-secondary">Фильтровать</button>
            </form>
        </div>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Отчество</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Отдел</th>
                <th scope="col">Должность</th>
                <th scope="col">Дети</th>
                <th scope="col">Количество<br>подарков</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($staffs as $staff): ?>
                <tr>
                    <td><p><a href="/staff.php?staff_id=<?=$staff['id']?>"><?=$staff['surname']?></a></p></td>
                    <td><p><?=$staff['name']?></p></td>
                    <td><p><?=$staff['patronymic']?></p></td>
                    <td><p><?=$staff['date_of_birth']?></p></td>
                    <td><p><?=$staff['department']?></p></td>
                    <td><p><?=$staff['post']?></p></td>
                    <td>
                    <?php
                        $parents = get_children_by_id_parent($staff['id']);
                    ?>
                        <?php 
                            if($parents == NULL) { ?>
                                нет
                            <?php } else { ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Фамилия</th>
                                            <th scope="col">Имя</th>
                                            <th scope="col">Отчество</th>
                                            <th scope="col">Дата рождения</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($parents != NULL) { ?>
                                                <?php foreach($parents as $parent): ?>
                                                    <?php 
                                                        $child_id = $parent['child_id']; 
                                                        $children = get_child_by_id($child_id); 
                                                    ?>
                                                    <tr>
                                                        <td><?=$children['surname']?></a></td>
                                                        <td><?=$children['name']?></td>
                                                        <td><?=$children['patronymic']?></td>
                                                        <td><?=$children['date_of_birth']?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php } else { ?>
                                            <?php }
                                            ?>
                                    </tbody>
                                </table>
                            <?php }
                        ?>
                    </td>
                    <td>
                        <?php
                            $parents = get_children_by_id_parent($staff['id']);
                        ?>
                        <?php $count1 = 0; ?>
                        <?php foreach($parents as $parent): ?>
                        <?php
                            $child_id = $parent['child_id']; 
                            $children = get_child_by_id($child_id);
                            $date1 = strtotime($children['date_of_birth']);
                            $date_now = date("d.m.Y");
                            $date2 = strtotime($date_now);
                            $result = ($date2-$date1) / (60*60*24*365);
	                        $years = floor($result);
                            if($years < 14) {                            
                                $count1 = $count1 + 1;
                                $count2 = $count2 + 1;                        
                            }
                        ?>
                        <?php endforeach; ?>
                        <?php echo $count1; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    <?php 
        echo 'Всего подарков: ';
        echo $count2;
    ?>          
    <?php }
?>

<?php
    //Подключение подвала
    require_once("footer.php");
?>

