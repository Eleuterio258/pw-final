<?php 
    
    require_once("../connect/connection.php");

    session_start();
    
    require_once("purchase_infor.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once("includes/head_global.php"); ?>
        <link rel="stylesheet" href="_css/cart/cart.css">
        <link rel="stylesheet" href="_css/responsive/cart.css">
        <title>Andes - you cart</title>
    </head>
    <body>
        <?php require_once("includes/header.php"); ?>

        <main>
            <div class="content">
                <?php if(isset($_COOKIE[$cookie_name])) { ?>

                    <h1>Your cart</h1>

                    <?php
                        for($i = 0; $i < $arraysize; $i++) {

                            $product = "SELECT * FROM produtos WHERE produtoID = {$array[$i]}";
                
                            $query = mysqli_query($connect, $product);
                            $details = mysqli_fetch_assoc($query);
                            
                            $produtoID      = $details['produtoID'];
                            $imagempequena  = $details['imagempequena'];
                            $nomeproduto    = $details['nomeproduto'];
                            $codigobarra    = $details['codigobarra'];
                            $estoque        = $details['estoque'];
                            $precounitario  = $details['precounitario'];                        
                    ?>

                    <div class="product-details">
                        <div class="item1">
                            <img width="69" src="<?php echo $imagempequena ?>" alt="Imagem do produto">
                        </div>
                        <div class="item2">
                            <h2><?php echo $nomeproduto ?></h2>
                            <h5><?php echo $estoque . " Available units"; ?></h5>
                            <h4><?php echo "Mts" . number_format($precounitario, 2,",",".") . " - Unit price" ?></h4>
                        </div>
                        <div class="item3 inputs">  

                            <div class="delete" id="<?php echo $i ?>">
                                <a href="#">
                                    <img width="24" src="assets/cruz.svg" alt="Delete item" title="Delete item">
                                </a>
                            </div>

                            <div>
                                <label for="amount">Units</label>
                                <input id="<?php echo $i ?>" type="number" name="amount" value="1" min="1" max="<?php echo $estoque ?>">
                            </div>
                      
                            <p id="total">
                                <?php echo "Total: Mts" . number_format($precounitario, 2,",",".") ?>
                            </p>
                        </div>
                        <input type="hidden" value="<?php echo $precounitario ?>">
                    </div>
                    
                    <?php } ?>
                    
                    <h2 id="total-value">Total value of your cart: </h2>

                    
                    <div id="checkout">
                        <div>
                            <span>
                                <a class="button-hover" id="keep-buying" href="index.php">Keep buying</a>
                            </span>
                        </div>
                        <div>
                            <form action="checkout.php" method="POST">
                                <input type="hidden" name="_total" value="">
                                <input class="button-hover" type="submit" value="checkout">
                            </form>
                        </div>
                    </div>

                <?php } else { ?>
                    <h1 style="text-align:center">Your shopping cart is empty</h1>
                <?php } ?>
            </div>
        </main>
        <?php require_once("includes/footer.php") ?>
    </body>
    <script src="js/cart/cart.js"></script>
    <script src="js/index/addToCart.js"></script>
    <script src="js/index/getFavorite.js"></script>
</html>

<?php mysqli_close($connect); ?>