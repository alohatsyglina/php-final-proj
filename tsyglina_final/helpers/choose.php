<?php 
if(isset($_SESSION['type'])){
    if($_SESSION['type']=='client'){
        if(!isset($_REQUEST['next'])){
            if(isset($_REQUEST['nextnext'])) {
                echo "Вы выбрали салон на ".$_SESSION['address_name'];
                $_SESSION['service']=$_REQUEST['service'];
                $_SESSION['price']=array();
                for($i=0;$i<count($_SESSION['service']);$i++){
                    $serv=$_SESSION['service'][$i];
                    $getprice=mysqli_query($connection, 
                    "SELECT price FROM service WHERE id='$serv'") or die (mysqli_error($connection));
                    $res=mysqli_fetch_assoc($getprice);
                    array_push($_SESSION['price'],$res['price']);
                }

                ?>
                <form action='order.php' method='post'>
                Выберите дату и время</br>
                <input type='date' name='date' min='2020-05-01' max='2020-06-30' required>
                <input type='time' name='time' min='10:00' max='20:00' step='900' required>
                <input type='text' name='comment' placeholder='Комментарии к заказу'>
                <input type='submit' name='nextnextnext' value='Оформить запись'>
                </form>
                <?php
			} 
            else {
            ?>
			<form action="visit.php" method="post">
			<select name="address" required>
				<option value='1' name="ad1">Ул.Бармалеева, 27</option>
				<option value=2 name="ad2">Пр.Стачек, 134</option>
				<option value=3 name="ad3">Ул.Оптиков, 11</option>
				<option value=4 name="ad4">Ул.Первого Мая, 1</option>
			</select>
			<input type="submit" name="next" value="Продолжить">
			</form>
			<?php
        }
    }

        else {
            $add_id=mysqli_real_escape_string($connection,$_REQUEST['address']);
            $query_address=mysqli_query($connection,
            "SELECT address FROM department WHERE id='$add_id'");
            $add_res=mysqli_fetch_assoc($query_address);
            $_SESSION['address_name']=$add_res['address'];
            $_SESSION['address_id']=$_REQUEST['address'];
            echo "Вы выбрали салон на ".$_SESSION['address_name'];

            if(!isset($_REQUEST['nextnext'])){
                $service_query=mysqli_query($connection, 
                "SELECT s.title, s.id
                FROM service_in_department sid JOIN service s ON sid.service_id=s.id
                WHERE sid.department_id=$add_id");    
                $res=mysqli_fetch_all($service_query, MYSQLI_BOTH);?>
                <form action='visit.php' method='post'><?php
                for($i=0;$i<mysqli_num_rows($service_query);$i++) { ?>
                    </br><input type="checkbox" name="service[]" value="<?php print_r($res[$i]['id']);?>"><?php print_r($res[$i]['title'])?> <?php 
                } ?>
                </br><input type="submit" name="nextnext" value="Продолжить">
                </form><?php
            }

        }

    }


    else {
         echo "Для оформления записи необходимо войти под учетной записью клиента";
         ?></br> <a href='../index.php'>Перейти на страницу авторизации</a><?php
        }
}


else {
    echo "Для оформления записи необходимо авторизоваться";
    ?></br> <a href='../index.php'>Перейти на страницу авторизации</a><?php
}
