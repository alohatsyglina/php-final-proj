<?php
echo "<h3>Ваши записи</h3>";
$clientid=mysqli_real_escape_string($connection,$_SESSION['id']);
$infosql=mysqli_query($connection, "CALL getall('$clientid')");
$rows=mysqli_num_rows($infosql);
if($rows>0){
    
    echo "<table><tr><th>Дата</th><th>Время</th><th>Адрес</th><th>Услуги</th></tr>";
    for ($i = 0 ; $i < $rows;$i++)
    { 
        $row = mysqli_fetch_row($infosql); 
        echo "<tr>";
              
            for ($j = 0 ; $j < 4 ;$j++) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
} else print("У вас пока нет записей, вы можете оформить запись по ссылке: 
    </br><a href='visit.php'>Записаться</a>");