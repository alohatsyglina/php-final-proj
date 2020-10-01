<?php
if(isset($_REQUEST['nextnextnext'])){
    $_SESSION['comment']=$_REQUEST['comment'];
    $receipt=$_SESSION['id'].$_SESSION['address_id'].$_REQUEST['date'];

    $totalsum=0;
    foreach($_SESSION['price'] as $price){
        $totalsum+=$price;
    }
    $c=mysqli_real_escape_string($connection, $_SESSION['id']);
    $d=mysqli_real_escape_string($connection, $_REQUEST['date']);
    $t=mysqli_real_escape_string($connection, $_REQUEST['time']);
    $com=mysqli_real_escape_string($connection, $_SESSION['comment']);
    $r=mysqli_real_escape_string($connection, $receipt);

    $insert=mysqli_query($connection, "CALL insertorder('$r','$c','$d','$t','$com')");

    $res=mysqli_query($connection, "CALL getorderid('$r')");
    $orderid=mysqli_fetch_all($res, MYSQLI_BOTH);
    $o=$orderid[0]['id'];
    $adid=mysqli_real_escape_string($connection,$_SESSION['address_id']);

    mysqli_next_result($connection);
    for($i=0; $i<count($_SESSION['service']);$i++){
            $s=$_SESSION['service'][$i];
            $findid=mysqli_query($connection, "CALL getsdid('$s','$adid')");
            $sdid=mysqli_fetch_all($findid, MYSQLI_BOTH);
            mysqli_next_result($connection);
            for($j=0;$j<count($sdid);$j++){
            $sd=$sdid[$j]['id'];
            $res=mysqli_query($connection,"CALL insertfullorder('$sd','$o')") or die("Ошибка".mysqli_error($connection));
            }
    }
    $text="Сумма вашего заказа: ".$totalsum." рублей</br>Ждем вас по адресу ".$_SESSION['address_name'].", ".$orderid[0]['date']." в ".$orderid[0]['time'];
    echo $text;
    ?>
    <form action='order.php' method='post'></br>Отправить информацию о записи на почту: <input type='text' name='wheretosend' value="<?php print_r($_SESSION['email'])?>">
    <input type='submit' value='Отправить' name='send'></form><?php    
}

if(isset($_REQUEST['send'])) echo "aaaaa";

