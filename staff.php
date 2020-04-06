<?php 
$staff_id  = $_GET['staff_id'];

if (!is_numeric($staff_id)) exit();
?>

<?php
    //Подключение шапки
    require_once("header.php");
?>

<?php    
    [$staff, $education] = get_staff_by_id_main($staff_id);
?>
<?php
    $parents = get_children_by_id_parent($staff_id);
?>

<?php #для админа
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'admin'){ 
    ?>
        <div class="container-fluid">
            <img src="<?=$staff['photo']?>" alt="">
            <form action="save_staff.php" method="post">        
                <input type="hidden" name="staff_id" value="<?=$staff['id']?>">
                <div class="border"><p><b>Фамилия:</b> <input type="text" id="staff_surname" name="staff_surname" value="<?=$staff['surname']?>"></p></div>
                <div class="border"><p><b>Имя:</b> <input type="text" id="staff_name" name="staff_name" value="<?=$staff['name']?>"></p></div>
                <div class="border"><p><b>Отчество:</b> <input type="text" id="staff_patronymic" name="staff_patronymic" value="<?=$staff['patronymic']?>"></p></div>
                <div class="border"><p><b>Дата рождения:</b> <input type="text" id="staff_date_of_birth" name="staff_date_of_birth" value="<?=$staff['date_of_birth']?>"></p></div>
                <div class="border"><p><b>Место рождения:</b> <input type="text" id="place_of_birth" name="place_of_birth" value="<?=$staff['place_of_birth']?>"></p></div>
                <div class="border"><p><b>Пол:</b> <input type="text" id="sex" name="sex" value="<?=$staff['sex']?>"></p></div>
                <div class="border"><p><b>Национальность:</b> <input type="text" id="nationality" name="nationality" value="<?=$staff['nationality']?>"></p></div>
                <div class="border"><p><b>Домашний адрес:</b> <input type="text" id="home_address" name="home_address" value="<?=$staff['home_address']?>"></p></div>
                <div class="border"><p><b>Семейное положение:</b> <input type="text" id="marital_status" name="marital_status" value="<?=$staff['marital_status']?>"></p></div>
                <div class="border"><p><b>Пребывание за границей:</b> <input type="text" id="stay_abroad" name="stay_abroad" value="<?=$staff['stay_abroad']?>"></p></div>
                <div class="border"><p><b>Отношение к воинской обязанности:</b> <input type="text" id="attitude_to_military_duty" name="attitude_to_military_duty" value="<?=$staff['attitude_to_military_duty']?>"></p></div>
                <div class="border"><p><b>Награды:</b> <input type="text" id="awards" name="awards" value="<?=$staff['awards']?>"></p></div>
                <div class="border"><p><b>Отдел:</b> <?=$staff['department']?></p></div>
                <div class="border"><p><b>Должность:</b> <?=$staff['post']?></p></div>
                <div class="border"><p><b>Дата вступления на должность:</b> <input type="text" id="date_of_entry" name="date_of_entry" value="<?=$staff['date_of_entry']?>"></p></div>
                <div class="border"><p><b>Стаж:</b> <input type="text" id="experience" name="experience" value="<?=$staff['experience']?>"></p></div>
                <div class="border">
                    <p><b>Дети:</b> <?php if($parents == NULL) { echo 'нет'; }?></p>
                    <?php 
                        if($parents != NULL) { ?>
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
                                    <?php foreach($parents as $parent): ?>
                                        <?php 
                                            $child_id = $parent['child_id']; 
                                            $children = get_child_by_id($child_id); 
                                        ?>
                                        <tr>
                                            <td><a href="/child.php?child_id=<?=$children['id']?>&parent_id=<?=$staff_id?>"><?=$children['surname']?></a></td>
                                            <td><?=$children['name']?></td>
                                            <td><?=$children['patronymic']?></td>
                                            <td><?=$children['date_of_birth']?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php }
                    ?>
                </div>
                <div class="border">
                    <a href="/education.php?education_id=<?=$education['id']?>&staff_id=<?=$staff_id?>"><p><b>Образование:</b></p></a>
                    <div class="education border">
                        <p><b>Название университета:</b> <?=$education['name']?></p>
                        <p><b>Адрес:</b> <?=$education['address']?></p>
                        <p><b>Факультет:</b> <?=$education['faculty']?></p>
                        <p><b>Форма обучения:</b> <?=$education['form_of_training']?></p>
                        <p><b>Специальность:</b> <?=$education['specialty']?></p>
                        <p><b>Дата поступления:</b> <?=$education['date_of_receipt']?></p>
                        <?php 
                            if(($education['expiry_date'] != NULL) && ($education['number_of_diploma'] != NULL))
                            { ?>
                                <p><b>Дата окончания:</b> <?=$education['expiry_date']?></p>
                                <p><b>Номер диплома:</b> <?=$education['number_of_diploma']?></p>
                            <?php } else { ?>
                                <p><b>Количество семестров:</b> <?=$education['semesters']?></p>
                            <?php }
                        ?>
                        <?php 
                            if($education['languages'] != NULL)
                            { ?>
                                <p><b>Языки:</b> <?=$education['languages']?></p>
                            <?php } else { ?>
                                <p><b>Языки:</b> нет</p>
                            <?php }
                        ?>                    
                        <?php 
                            if($education['degree'] != NULL)
                            { ?>
                                <p><b>Ученая степень:</b> <?=$education['degree']?></p>
                            <?php } else { ?>
                                <p><b>Ученая степень:</b> нет</p>
                            <?php }
                        ?>
                        <?php 
                            if($education['title'] != NULL)
                            { ?>
                                <p><b>Звание:</b> <?=$education['title']?></p>
                            <?php } else { ?>
                                <p><b>Звание:</b> нет</p>
                            <?php }
                        ?>                    
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary">Сохранить</button>
            </form>        
        </div>               
    <?php }
?>  

<?php #для директора
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'director'){ 
    ?>
        <div class="container-fluid">
            <img src="<?=$staff['photo']?>" alt="">
            <form action="save_post.php" method="post">        
                <input type="hidden" name="staff_id" value="<?=$staff['id']?>">
                <div class="border"><p><b>Фамилия:</b> <?=$staff['surname']?></p></div>
                <div class="border"><p><b>Имя:</b> <?=$staff['name']?></p></div>
                <div class="border"><p><b>Отчество:</b> <?=$staff['patronymic']?></p></div>
                <div class="border"><p><b>Дата рождения:</b> <?=$staff['date_of_birth']?></p></div>
                <div class="border"><p><b>Место рождения:</b> <?=$staff['place_of_birth']?></p></div>
                <div class="border"><p><b>Пол:</b> <?=$staff['sex']?></p></div>
                <div class="border"><p><b>Национальность:</b> <?=$staff['nationality']?></p></div>
                <div class="border"><p><b>Домашний адрес:</b> <?=$staff['home_address']?></p></div>
                <div class="border"><p><b>Семейное положение:</b> <?=$staff['marital_status']?></p></div>
                <div class="border"><p><b>Пребывание за границей:</b> <?=$staff['stay_abroad']?></p></div>
                <div class="border"><p><b>Отношение к воинской обязанности:</b> <?=$staff['attitude_to_military_duty']?></p></div>
                <div class="border"><p><b>Награды:</b> <?=$staff['awards']?></p></div>
                <div class="border"><p><b>Отдел:</b> <?=$staff['department']?></p></div>
                <div class="border"><p><b>Должность:</b> <input type="text" id="post" name="post" value="<?=$staff['post']?>"></p></div>
                <div class="border"><p><b>Дата вступления на должность:</b> <?=$staff['date_of_entry']?></p></div>
                <div class="border"><p><b>Стаж:</b> <?=$staff['experience']?></p></div>
                <div class="border">
                    <p><b>Дети:</b> <?php if($parents == NULL) { echo 'нет'; }?></p>
                    <?php 
                        if($parents != NULL) { ?>
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
                                    <?php foreach($parents as $parent): ?>
                                        <?php 
                                            $child_id = $parent['child_id']; 
                                            $children = get_child_by_id($child_id); 
                                        ?>
                                        <tr>
                                            <td><?=$children['surname']?></td>
                                            <td><?=$children['name']?></td>
                                            <td><?=$children['patronymic']?></td>
                                            <td><?=$children['date_of_birth']?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php }
                    ?>
                </div>
                <div class="border">
                    <p><b>Образование:</b></p>
                    <div class="education border">
                        <p><b>Название университета:</b> <?=$education['name']?></p>
                        <p><b>Адрес:</b> <?=$education['address']?></p>
                        <p><b>Факультет:</b> <?=$education['faculty']?></p>
                        <p><b>Форма обучения:</b> <?=$education['form_of_training']?></p>
                        <p><b>Специальность:</b> <?=$education['specialty']?></p>
                        <p><b>Дата поступления:</b> <?=$education['date_of_receipt']?></p>
                        <?php 
                            if(($education['expiry_date'] != NULL) && ($education['number_of_diploma'] != NULL))
                            { ?>
                                <p><b>Дата окончания:</b> <?=$education['expiry_date']?></p>
                                <p><b>Номер диплома:</b> <?=$education['number_of_diploma']?></p>
                            <?php } else { ?>
                                <p><b>Количество семестров:</b> <?=$education['semesters']?></p>
                            <?php }
                        ?>                       
                        <?php 
                            if($education['languages'] != NULL)
                            { ?>
                                <p><b>Языки:</b> <?=$education['languages']?></p>
                            <?php } else { ?>
                                <p><b>Языки:</b> нет</p>
                            <?php }
                        ?>
                        <?php 
                            if($education['degree'] != NULL)
                            { ?>
                                <p><b>Ученая степень:</b> <?=$education['degree']?></p>
                            <?php } else { ?>
                                <p><b>Ученая степень:</b> нет</p>
                            <?php }
                        ?>
                        <?php 
                            if($education['title'] != NULL)
                            { ?>
                                <p><b>Звание:</b> <?=$education['title']?></p>
                            <?php } else { ?>
                                <p><b>Звание:</b> нет</p>
                            <?php }
                        ?>                    
                    </div>
                </div>
                <div class="border"><p><b>Серия паспорта:</b> <?=$staff['passport_series']?></p></div>
                <div class="border"><p><b>Номер паспорта:</b> <?=$staff['passport_id']?></p></div>
                <div class="border"><p><b>Кем выдан паспорт:</b> <?=$staff['issued_by']?></p></div>
                <div class="border"><p><b>Дата выдачи паспорта:</b> <?=$staff['when_issued']?></p></div>
                <div class="border">
                    <p><b>Финансы за год:</b></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Месяц</th>
                                <th scope="col">Оклад</th>
                                <th scope="col">Процент</th>
                                <th scope="col">Премия</th>
                                <th scope="col">Налог</th>
                                <th scope="col">На руки</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                    $finances = get_finance_by_id_staff($staff_id); 
                                ?>
                                <?php foreach($finances as $finance): ?>                                
                                <tr>
                                    <td><a href="/finance.php?month_id=<?=$finance['id']?>&staff_id=<?=$staff_id?>"><?=$finance['month']?></a></td>
                                    <td><?=$finance['salary']?></td>
                                    <td><?=$finance['percent']?></td>
                                    <td><?=$finance['prize']?></td>
                                    <td><?=$finance['tax']?></td>
                                    <td><?=$finance['profit']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-secondary">Сохранить</button>
            </form>        
        </div>               
    <?php } 
?>  

<?php #для отдела кадров
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'PersonnelDepartment'){ 
    ?>
        <div class="container-fluid">
            <img src="<?=$staff['photo']?>" alt="">
            <form action="save_staff_max.php" method="post">        
                <input type="hidden" name="staff_id" value="<?=$staff['id']?>">
                <div class="border"><p><b>Фамилия:</b> <input type="text" id="staff_surname" name="staff_surname" value="<?=$staff['surname']?>"></p></div>
                <div class="border"><p><b>Имя:</b> <input type="text" id="staff_name" name="staff_name" value="<?=$staff['name']?>"></p></div>
                <div class="border"><p><b>Отчество:</b> <input type="text" id="staff_patronymic" name="staff_patronymic" value="<?=$staff['patronymic']?>"></p></div>
                <div class="border"><p><b>Дата рождения:</b> <input type="text" id="staff_date_of_birth" name="staff_date_of_birth" value="<?=$staff['date_of_birth']?>"></p></div>
                <div class="border"><p><b>Место рождения:</b> <input type="text" id="place_of_birth" name="place_of_birth" value="<?=$staff['place_of_birth']?>"></p></div>
                <div class="border"><p><b>Пол:</b> <input type="text" id="sex" name="sex" value="<?=$staff['sex']?>"></p></div>
                <div class="border"><p><b>Национальность:</b> <input type="text" id="nationality" name="nationality" value="<?=$staff['nationality']?>"></p></div>
                <div class="border"><p><b>Домашний адрес:</b> <input type="text" id="home_address" name="home_address" value="<?=$staff['home_address']?>"></p></div>
                <div class="border"><p><b>Семейное положение:</b> <input type="text" id="marital_status" name="marital_status" value="<?=$staff['marital_status']?>"></p></div>
                <div class="border"><p><b>Пребывание за границей:</b> <input type="text" id="stay_abroad" name="stay_abroad" value="<?=$staff['stay_abroad']?>"></p></div>
                <div class="border"><p><b>Отношение к воинской обязанности:</b> <input type="text" id="attitude_to_military_duty" name="attitude_to_military_duty" value="<?=$staff['attitude_to_military_duty']?>"></p></div>
                <div class="border"><p><b>Награды:</b> <input type="text" id="awards" name="awards" value="<?=$staff['awards']?>"></p></div>
                <div class="border"><p><b>Отдел:</b> <input type="text" id="department" name="department" value="<?=$staff['department']?>"></p></div>
                <div class="border"><p><b>Должность:</b> <input type="text" id="post" name="post" value="<?=$staff['post']?>"></p></div>
                <div class="border"><p><b>Дата вступления на должность:</b> <input type="text" id="date_of_entry" name="date_of_entry" value="<?=$staff['date_of_entry']?>"></p></div>
                <div class="border"><p><b>Стаж:</b> <input type="text" id="experience" name="experience" value="<?=$staff['experience']?>"></p></div>
                <div class="border">
                    <p><b>Дети:</b> <?php if($parents == NULL) { echo 'нет'; }?></p>
                    <?php 
                        if($parents != NULL) { ?>
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
                                    <?php foreach($parents as $parent): ?>
                                        <?php 
                                            $child_id = $parent['child_id']; 
                                            $children = get_child_by_id($child_id); 
                                        ?>
                                        <tr>
                                            <td><a href="/child.php?child_id=<?=$children['id']?>&parent_id=<?=$staff_id?>"><?=$children['surname']?></a></td>
                                            <td><?=$children['name']?></td>
                                            <td><?=$children['patronymic']?></td>
                                            <td><?=$children['date_of_birth']?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php }
                    ?>
                </div>
                <div class="border">
                    <a href="/education.php?education_id=<?=$education['id']?>&staff_id=<?=$staff_id?>"><p><b>Образование:</b></p></a>
                    <div class="education border">
                        <p><b>Название университета:</b> <?=$education['name']?></p>
                        <p><b>Адрес:</b> <?=$education['address']?></p>
                        <p><b>Факультет:</b> <?=$education['faculty']?></p>
                        <p><b>Форма обучения:</b> <?=$education['form_of_training']?></p>
                        <p><b>Специальность:</b> <?=$education['specialty']?></p>
                        <p><b>Дата поступления:</b> <?=$education['date_of_receipt']?></p>
                        <?php 
                            if(($education['expiry_date'] != NULL) && ($education['number_of_diploma'] != NULL))
                            { ?>
                                <p><b>Дата окончания:</b> <?=$education['expiry_date']?></p>
                                <p><b>Номер диплома:</b> <?=$education['number_of_diploma']?></p>
                            <?php } else { ?>
                                <p><b>Количество семестров:</b> <?=$education['semesters']?></p>
                            <?php }
                        ?>                       
                        <?php 
                            if($education['languages'] != NULL)
                            { ?>
                                <p><b>Языки:</b> <?=$education['languages']?></p>
                            <?php } else { ?>
                                <p><b>Языки:</b> нет</p>
                            <?php }
                        ?>
                        <?php 
                            if($education['degree'] != NULL)
                            { ?>
                                <p><b>Ученая степень:</b> <?=$education['degree']?></p>
                            <?php } else { ?>
                                <p><b>Ученая степень:</b> нет</p>
                            <?php }
                        ?>
                        <?php 
                            if($education['title'] != NULL)
                            { ?>
                                <p><b>Звание:</b> <?=$education['title']?></p>
                            <?php } else { ?>
                                <p><b>Звание:</b> нет</p>
                            <?php }
                        ?>                    
                    </div>
                </div>
                <div class="border"><p><b>Серия паспорта:</b> <input type="text" id="passport_series" name="passport_series" value="<?=$staff['passport_series']?>"></p></div>
                <div class="border"><p><b>Номер паспорта:</b> <input type="text" id="passport_id" name="passport_id" value="<?=$staff['passport_id']?>"></p></div>
                <div class="border"><p><b>Кем выдан паспорт:</b> <input type="text" id="issued_by" name="issued_by" value="<?=$staff['issued_by']?>"></p></div>
                <div class="border"><p><b>Дата выдачи паспорта:</b> <input type="text" id="when_issued" name="when_issued" value="<?=$staff['when_issued']?>"></p></div>
                <button type="submit" class="btn btn-secondary">Сохранить</button>
            </form>        
        </div>               
    <?php }
?>

<?php #для бухгалтерии
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'accounting'){ 
    ?>
        <div class="container-fluid">
            <img src="<?=$staff['photo']?>" alt="">
            <div class="border"><p><b>Фамилия:</b> <?=$staff['surname']?></p></div>
            <div class="border"><p><b>Имя:</b> <?=$staff['name']?></p></div>
            <div class="border"><p><b>Отчество:</b> <?=$staff['patronymic']?></p></div>
            <div class="border"><p><b>Дата рождения:</b> <?=$staff['date_of_birth']?></p></div>
            <div class="border"><p><b>Отдел:</b> <?=$staff['department']?></p></div>
            <div class="border"><p><b>Должность:</b> <?=$staff['post']?></p></div>
            <div class="border">
                <p><b>Дети:</b> <?php if($parents == NULL) { echo 'нет'; }?></p>
                <?php 
                    if($parents != NULL) { ?>
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
                            <?php foreach($parents as $parent): ?>
                                <?php 
                                    $child_id = $parent['child_id']; 
                                    $children = get_child_by_id($child_id); 
                                ?>
                                <tr>
                                    <td><?=$children['surname']?></td>
                                    <td><?=$children['name']?></td>
                                    <td><?=$children['patronymic']?></td>
                                    <td><?=$children['date_of_birth']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php }
                ?>
            </div>
            <div class="border">
                <p><b>Финансы за год:</b></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Месяц</th>
                            <th scope="col">Оклад</th>
                            <th scope="col">Процент</th>
                            <th scope="col">Премия</th>
                            <th scope="col">Налог</th>
                            <th scope="col">На руки</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                                $finances = get_finance_by_id_staff($staff_id); 
                            ?>
                            <?php foreach($finances as $finance): ?>                                
                            <tr>
                                <td><a href="/finance.php?month_id=<?=$finance['id']?>&staff_id=<?=$staff_id?>"><?=$finance['month']?></a></td>
                                <td><?=$finance['salary']?></td>
                                <td><?=$finance['percent']?></td>
                                <td><?=$finance['prize']?></td>
                                <td><?=$finance['tax']?></td>
                                <td><?=$finance['profit']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>        
        </div>               
    <?php }
?>

<?php #для профкома
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && $_SESSION['login'] == 'TradeUnion'){ 
    ?>
        <div class="container-fluid">
            <img src="<?=$staff['photo']?>" alt="">
            <div class="border"><p><b>Фамилия:</b> <?=$staff['surname']?></p></div>
            <div class="border"><p><b>Имя:</b> <?=$staff['name']?></p></div>
            <div class="border"><p><b>Отчество:</b> <?=$staff['patronymic']?></p></div>
            <div class="border"><p><b>Дата рождения:</b> <?=$staff['date_of_birth']?></p></div>
            <div class="border"><p><b>Отдел:</b> <?=$staff['department']?></p></div>
            <div class="border"><p><b>Должность:</b> <?=$staff['post']?></p></div>
            <div class="border">
                <p><b>Дети:</b> <?php if($parents == NULL) { echo 'нет'; }?></p>
                <?php 
                    if($parents != NULL) { ?>
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
                                <?php foreach($parents as $parent): ?>
                                    <?php 
                                        $child_id = $parent['child_id']; 
                                        $children = get_child_by_id($child_id); 
                                    ?>
                                    <tr>
                                        <td><?=$children['surname']?></td>
                                        <td><?=$children['name']?></td>
                                        <td><?=$children['patronymic']?></td>
                                        <td><?=$children['date_of_birth']?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                <?php }
                ?>
            </div>
        </div>               
    <?php } 
?>

<?php
    //Подключение подвала
    require_once("footer.php");
?>