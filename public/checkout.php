<?php 
    
    require_once("../connect/connection.php");

    session_start();

    $use = false;

    if(isset($_POST['_total'])) {
        $total = $_POST['_total'];
    }

    if(isset($_SESSION["usuario"])) {
        $user = true;
    } else {
        $user = false;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once("includes/head_global.php"); ?>
        <link rel="stylesheet" href="_css/checkout/checkout.css">
        <title>Andes - Checkout</title>
    </head>
    <body>
        <?php require_once("includes/header.php"); ?>

        <main>
            <div class="content">
                <?php if($user == false) { 
                    
                    header("location:login.php?Checkout")
                ?>
                <?php } else { ?>
                    <div id="payment-content">
                        <div class="tipy-pay">
                            <div>

                                <label for="credit-card">Mpesa payments</label>
                            </div>


                        </div>

                        <strong id="purchase-price">Total purchase amount: <?php echo $total.' Mts'?></strong>
                        <input type="hidden" name="total" value="<?php echo $total ?>">

                        <form action="#" class="credit-card show">
                            <div class="flags">
                                <div class="flags-title">M-Pesa</div>
                                <div class="line">
                                    <img src="assets/m-pesa-logo.png" width="60" alt="Visa" title="Visa">

                                </div>
                            </div>
                            <label for="card-number">Vodacom number</label></br>
                            <input type="text" name="card-number" value="" placeholder="Ex: 84/854000008" autofocus><br>
                            <input class="button-hover" type="submit" value="Submit">

                        </form> 

                    </div>
                <?php } ?>    
            <div>    
        </main>

        <?php require_once("includes/footer.php") ?>
    </body>
    <script src="js/index/addToCart.js"></script>
    <script src="js/index/getFavorite.js"></script>
    
</html>

<?php mysqli_close($connect); ?>