<?php $infosql=mysqli_query($connection, "SELECT title, price FROM service");
$rows=mysqli_num_rows($infosql);
if($rows>0){
    
    echo "<table><tr><th>Название</th><th>Цена</th></tr>";
    for ($i = 0 ; $i < $rows;$i++)
    { 
        $row = mysqli_fetch_row($infosql); 
        echo "<tr>";
              
            for ($j = 0 ; $j < 2 ;$j++) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
}