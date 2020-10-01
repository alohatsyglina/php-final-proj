<?php
if(!isset($_SESSION['email']))
{
    ?><form action='index.php' method='post'>
     Email <input type="text" name="email" style="margin-left: 10px"><br> 
     Пароль <input type="password" name="password"><br>
     <input type="submit" name="submit" value="Вход" style="margin-left: 45px"></br>
     Еще нет аккаунта? <a href="pages/registration.php">Зарегистрироваться</a> 
        </form></br><?php
    if(isset($_REQUEST['submit']))
    {
        $email=mysqli_real_escape_string($connection,$_REQUEST['email']);
        $query_client=mysqli_query($connection,"SELECT id,email, password FROM client WHERE email='$email'");
        $query_employee=mysqli_query($connection,"SELECT id, email, password, job_id FROM employee WHERE email='$email'");
        $result_client=mysqli_fetch_assoc($query_client);
        $result_employee=mysqli_fetch_assoc($query_employee);
        if($result_employee)
        {
            $result=$result_employee;
            if($result_employee['job_id']==1)
            {
                $_SESSION['type']='admin';
            }
            else $_SESSION['type']='employee';
        }
        else
        {
            $result=$result_client;
            $_SESSION['type']='client';
        }
        if($result['email']&&$result['password']==$_REQUEST['password'])
            {
                $_SESSION['email']=$_REQUEST['email'];
                $_SESSION['id']=$result['id'];
                $_SESSION['password']=$_REQUEST['password'];
                ?>
                <meta http-equiv='refresh' content='0; url=index.php'><?php
               
            }
        
        else echo"Неверный адрес электронной почты или пароль. Попробуйте еще раз";    
    }
}

else{
    echo "<p>Авторизация пройдена успешно</p>";
    ?>
    <p><a href="pages/personalinfo.php">Перейти в личный кабинет</a></p>
    <form method="POST">
    <input type="submit" name="logout" value="Выйти">
    </form>
        <?php } if(isset($_REQUEST['logout']))
        {
     session_destroy(); ?>
     <meta http-equiv='refresh' content='0; url=index.php'>
<?php };
    