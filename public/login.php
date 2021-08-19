<?php 
    require_once("../connect/connection.php");

    session_start();

    $not_registered = false;
    if(isset($_POST["usuario"])){
        $username = $_POST["usuario"];
        $password = $_POST["senha"];
        
        $access = "SELECT * ";
        $access .= "FROM clientes ";
        $access .= "WHERE usuario = '{$username}' AND senha = '{$password}' ";
        
        $logon = mysqli_query($connect, $access);
        
        if(!$logon){
            die("Failed to query database.");
        }
        
        $user = mysqli_fetch_assoc($logon);
        
        if(empty($user)) {
            $not_registered = true;
        } else {
            $_SESSION["usuario"] = $user["clienteID"];
            $_SESSION["nivel"] = $user["nivel"];
            header("location:index.php");
        }   
    }

    $checkout = "";
    if(isset($_GET["Checkout"])) {
        $checkout = '<h2 style="color:darkseagreen; margin-bottom:20px">
                        To complete your purchase you need to register or login
                    </h2>';
    } else {
        $checkout = "";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("includes/head_global.php"); ?>
        <link rel="stylesheet" href="_css/login/login_style.css">
        <link rel="stylesheet" href="_css/responsive/login.css">
        <title>Andes Coffee - login</title>
    </head>
    <body>
        <?php require_once("includes/header.php"); ?>
        <?php require_once("includes/window_alert.php"); ?>

        <main>
            <div class="content">
                <div class="login-content">
                    <div class="login-window">
                    <?php echo $checkout ?>
                        <form action="login.php" method="POST">
                            <div>
                                <h2>Enter your user</h2>
                                <label for="usuario">User name</label>
                                <input type="text" name="usuario" required autofocus>
                                <label for="senha">Password</label>
                                <input type="password" name="senha" required>
                                <input class="button-hover" type="submit" value="login" title="Submit">
                                <hr>
                                <h4>Don't have an account yet?</h4>
                                <a class="button-hover" href="sign_up.php" title="Sign Up" rel="Sign Up">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>        
        <?php require_once("includes/footer.php") ?>
        <script src="js/alert.js"></script>
        <script src="js/index/addToCart.js"></script>
        <script src="js/index/getFavorite.js"></script>
        <script>
            let userNotRegister =  <?php echo $not_registered ?>;

            if(userNotRegister) {
                windowAlert('This user is not registered, check if the name is correct or register');
            }
        </script>
    </body>
</html>
<?php mysqli_close($connect); ?>