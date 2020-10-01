
<form action method='post'>
<input type='submit' name='openaddpanel' value='Добавление записей'>
<input type='submit' name='opendeletepanel' value='Удаление записей'>
<input type='submit' name='openshowpanel' value='Просмотр'>
</form><?php

if(isset($_REQUEST['openaddpanel'])){
    ?><form action method='post'>
    <input type='text' name='client' placeholder='ID клиента' required></br>
    <input type='date' name='date' min='2020-05-01' max='2020-06-30' required></br>
    <input type='time' name='time' min='10:00' max='20:00' step='900' required></br>
    <input type='text' name='comment' placeholder='Комментарии к заказу'></br>
    <select name="address" placeholder='Адрес филиала' required>
        <option disabled selected>Адрес салона</option>
	    <option value='1' name="ad1">Ул.Бармалеева, 27</option>
		<option value=2 name="ad2">Пр.Стачек, 134</option>
		<option value=3 name="ad3">Ул.Оптиков, 11</option>
		<option value=4 name="ad4">Ул.Первого Мая, 1</option>
	</select></br>
    <input type='submit' name='next' value='Продолжить'>
    </form><?php
}

if(isset($_REQUEST['next'])){

    $_SESSION['address']=$_REQUEST['address'];
    $dep=mysqli_real_escape_string($connection, $_REQUEST['address']);
    $servsql=mysqli_query($connection, "CALL services('$dep')");
    $res=mysqli_fetch_all($servsql, MYSQLI_BOTH);?>
    <form action method='post'><?php
    for($i=0;$i<mysqli_num_rows($servsql);$i++) { ?>
        </br><input type="checkbox" name="service[]" value="<?php print_r($res[$i]['id']);?>"><?php print_r($res[$i]['title'])?> <?php 
    }
    mysqli_next_result($connection);
    ?></br> <input type='submit' name='add' value='Добавить'></form><?php
    $receipt=$_REQUEST['client'].$_REQUEST['address'].$_REQUEST['date'];
    $_SESSION['receipt']=$receipt;
    $r=mysqli_real_escape_string($connection, $receipt);
    $cl=mysqli_real_escape_string($connection, $_REQUEST['client']);
    $dt=mysqli_real_escape_string($connection, $_REQUEST['date']);
    $tm=mysqli_real_escape_string($connection, $_REQUEST['time']);
    $cm=mysqli_real_escape_string($connection, $_REQUEST['comment']);

     $insert=mysqli_query($connection, "CALL insertorder('$r','$cl','$dt','$tm','$cm')");
   
}

if(isset($_REQUEST['add'])){
    $r=mysqli_real_escape_string($connection, $_SESSION['receipt']);
    $ad=mysqli_real_escape_string($connection, $_SESSION['address']);
    $res=mysqli_query($connection, "CALL getorderid('$r')");
    $orderid=mysqli_fetch_all($res, MYSQLI_BOTH);
    $o=$orderid[0]['id'];
    mysqli_next_result($connection);
    for($i=0; $i<count($_REQUEST['service']);$i++){
        $s=$_REQUEST['service'][$i];
        $findid=mysqli_query($connection, "CALL getsdid('$s','$ad')");
        $sdid=mysqli_fetch_all($findid, MYSQLI_BOTH);
        mysqli_next_result($connection);
        for($j=0;$j<count($sdid);$j++){
        $sd=$sdid[$j]['id'];
        $res=mysqli_query($connection,"CALL insertfullorder('$sd','$o')") or die("Ошибка".mysqli_error($connection));
        }
    }
    if($res) echo "Записи успешно добавлены"; 
}


if(isset($_REQUEST['opendeletepanel'])){
    $infosql=mysqli_query($connection, "CALL allin()");
    if($infosql){    
        echo "<form action method='post'><table><tr><th></th><th>Клиент</th><th>Дата</th><th>Время</th><th>Адрес</th></tr>";
        for ($i = 0 ; $i < mysqli_num_rows($infosql);$i++)
        { 
            $row = mysqli_fetch_row($infosql); 
            echo "<tr><td><input type='radio' name='choose' value='$row[4]'></td>";                    
                for ($j = 0 ; $j < 4 ;$j++) echo "<td>$row[$j]</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<input type='submit' name='delete' value='Удалить запись'></form>";
    }
}

if(isset($_REQUEST['delete'])){
    $o=mysqli_real_escape_string($connection,$_REQUEST['choose']);
    $deletesql=mysqli_query($connection, "CALL deletingpro($o)") or die(mysqli_error($connection));
    if($deletesql) echo"Запись удалена";
}

if(isset($_REQUEST['openshowpanel'])){
    ?><form action method='post'>
    <select name="addr" placeholder='Адрес филиала' required>
        <option disabled selected>Адрес салона</option>
	    <option value='1' name="ad1">Ул.Бармалеева, 27</option>
		<option value=2 name="ad2">Пр.Стачек, 134</option>
		<option value=3 name="ad3">Ул.Оптиков, 11</option>
		<option value=4 name="ad4">Ул.Первого Мая, 1</option>
	</select></br>
    <input type='submit' name='show' value='Показать все записи'></br>
    <input type='submit' name='showgraph' value='График записей по дням'>
    </form><?php
}
if(isset($_REQUEST['showgraph'])){
    ?>
    <img src='../helpers/graph.php'><?php
}

if(isset($_REQUEST['show'])){
    $ad=mysqli_real_escape_string($connection,$_REQUEST['addr']);
    $showsql=mysqli_query($connection, "CALL allaboutdep('$ad')");
    $rows=mysqli_num_rows($showsql);
    if($rows>0){    
        echo "<table><tr><th>Клиент</th><th>Дата</th><th>Время</th><th>Чек</th></tr>";
        for ($i = 0 ; $i < $rows;$i++)
        { 
            $row = mysqli_fetch_row($showsql); 
            echo "<tr></td>";                    
                for ($j = 0 ; $j < 4 ;$j++) echo "<td>$row[$j]</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else echo "В этот салон пока нет записей";
}


