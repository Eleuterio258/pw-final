<?php 
    require_once("../connect/connection.php");

    session_start();

    $user_create = false;
    $users;
    
    if(isset($_POST["nomecompleto"])){
        $nomecompleto = $_POST["nomecompleto"];
        $endereco     = $_POST["endereco"];   
        $telefone     = $_POST["telefone"];
        $email        = $_POST["email"];
        $usuario      = $_POST["usuario"];  
        $senha        = $_POST["senha1"];   

        $insert  = "INSERT INTO clientes ";
        $insert .= "(nomecompleto, endereco, telefone, email, usuario, senha) ";
        $insert .= "VALUES ";
        $insert .= "('$nomecompleto','$endereco','$telefone','$email','$usuario','$senha')";
        
        $acesso = mysqli_query($connect, $insert);
        if(!$acesso){
            die("Falha ao consultar banco de dados.");
        }

        $user_create = true;
    }   
    
    $select_users = "SELECT usuario FROM clientes ";

    $query = mysqli_query($connect, $select_users);
    
    while($user = mysqli_fetch_assoc($query)) {          
        $users[] = $user['usuario'];
    }   

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("includes/head_global.php"); ?>
        <link rel="stylesheet" href="_css/login/sign_up.css">
        <link rel="stylesheet" href="_css/responsive/sign_up.css">
        <title>Andes Coffee - Sign up</title>
    </head>
    <body>
        <?php require_once("includes/header.php"); ?>
        <?php require_once("includes/window_alert.php"); ?>

        <main>
            <div class="content">
                <div class="signup-window">

                    <h2>Create your user</h2>
                    <p><span>*</span>All fields are mandatory</p>
                    <form action="sign_up.php" method="POST">

                        <div>
                            <label for="nomecompleto">Full name</label>
                            <input type="text" autocomplet name="nomecompleto" placeholder="" required autofocus>

                            <label for="endereco">Adress</label>
                            <input type="text" name="endereco" placeholder="" required>
							
                           <label for="telefone">Phone</label>
                            <input type="text"  placeholder="" name="telefone" required>
                        </div>

                        <div>
                           
							
							<label for="email">Email</label>
                            <input type="email" name="email" placeholder="Exe: youremail@mail.com" required>

                            <label for="usuario">User name</label>
                            <input type="text" name="usuario" placeholder="" required>
                        </div>

                        <div>
                         

                            <label for="senha1">Password</label>
                            <input type="password" name="senha1" placeholder="minimum 8 characters" required>

                            <label for="senha2">Repeat the password</label>
                            <input type="password" name="senha2" placeholder="" required>

                            <input class="button-hover" type="submit" value="Register">

                        </div>


                        <input type="hidden" name="ddd"     value="">
                        <input type="hidden" name="state"   value="">
                        <input type="hidden" name="city"    value="">
                    </form>
                </div>
            </div>
        </main>
                
        <?php require_once("includes/footer.php") ?>
    </body>
    <script src="js/alert.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/login/signup_validation.js"></script>
    <script src="js/index/addToCart.js"></script>
    <script src="js/index/getFavorite.js"></script>
    <script type="text/javascript">
        const userNameInput = document.querySelector('input[name=usuario]')        
        let varr = <?php echo json_encode($users) ?>;

        userNameInput.addEventListener('blur', (event) => {

            let nome = varr[varr.indexOf(event.target.value)];
            
            if(event.target.value == nome) {
                windowAlert('Existing user, please choose another name');
                onColosed(userNameInput)
            }
        });

        if("<?php echo $user_create ?>" == true) {
            setTimeout(() => {
                window.location = "login.php"
            }, 2000);
        }
    </script>
</html>
<?php mysqli_close($connect); ?>