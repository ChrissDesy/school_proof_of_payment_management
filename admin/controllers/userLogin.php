<?php
    if(isset($_POST['login']))
    {
        $uname = $_POST['username'];
        $pass = $_POST['password'];
    
        if($pass && $uname)
        {   

            //get employees
            $sql = "SELECT * FROM users WHERE username='".$uname."' AND password='".$pass."'";
            $statement = $db->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();

            if(sizeof($result) > 0){
                $r = $result[0];
                
                if($r['status'] == 'active'){
                    $_SESSION['username'] = $r['firstname']. ' '. $r['lastname'];
                    $_SESSION['uname'] = $r['username'];
                    $_SESSION['utype'] = $r['role'];
                
                    header("location:./admin/index.php");
                }
                else{
                    $_SESSION['errorMessage'] = 'Account Disabled or Deleted';
                }
            }
            else{
                $_SESSION['errorMessage'] = 'Invalid Credentials';
            }

        }
        else
        {
            $_SESSION['errorMessage'] = 'Enter Credentials';
        }
    }

    if(isset($_POST['reset']))
    {
        $uname = $_POST['username'];
    
        if($uname)
        {   

            //get employees
            $sql = "SELECT * FROM users WHERE username='".$uname."'";
            $statement = $db->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();

            if(sizeof($result) > 0){
                $r = $result[0];
                
                if($r['status'] == 'active'){
                    $_SESSION['uname'] = $r['username'];
                
                    $mode = 'change';
                    $uname = $uname;
                }
                else{
                    $_SESSION['errorMessage'] = 'Account Disabled or Deleted';
                }
            }
            else{
                $_SESSION['errorMessage'] = 'User not found.';
            }

        }
        else
        {
            $_SESSION['errorMessage'] = 'Enter Username.';
        }
    }

    if(isset($_POST['change']))
    {
        $uname = $_POST['uname'];
        $pwd = $_POST['password'];
        $pwd2 = $_POST['password2'];
    
        if($pwd == $pwd2)
        {   

            $sql2 = 'UPDATE users SET
                        password = "'.$pwd.'"
                    WHERE username = "'.$uname.'"';
	    
            $query2 = $db->prepare($sql2);   
            $query2->execute();

            $_SESSION['successMessage'] = 'Password changed.';

            // header("location:./index.php");

        }
        else
        {
            $_SESSION['errorMessage'] = 'Passwords Mismatch.';
        }
    }

?>