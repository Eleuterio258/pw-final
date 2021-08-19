<?php

require_once("../connect/connection.php");

session_start();

if (isset($_GET['product_Id'])) {
    $productID = $_GET['product_Id'];
} else {
    Header('location:index.php');
}

$product = "SELECT * FROM produtos WHERE produtoID = {$productID}";

$query = mysqli_query($connect, $product);
$details = mysqli_fetch_assoc($query);

if (!$query) {
    die("Falha na consulta ao banco de dados");
}

?>


<!DOCTYPE html>
<html>

<head>
    <?php require_once("includes/head_global.php"); ?>
    <link rel="stylesheet" href="css/product_details/product_details.css">
    <link rel="stylesheet" href="css/responsive/product_details.css">
    <title>Andes - Product details</title>
</head>

<body>
    <?php require_once("includes/header.php"); ?>

    <main>
        <div class="content">
            <div id="product-details">
                <ul>
                    <img width="225" src="<?php echo $details['imagemgrande']; ?>" alt="Imagem do produto">
                    <div id="details">
                        <div>
                            <h2><?php echo $details['nomeproduto']; ?></h2>
                        </div>
                        <div>
                            <h4><?php echo $details['descricao']; ?></h4>
                        </div>
                        <div>
                            <p><?php echo $details['estoque'] . " Available units"; ?></p>
                            <span><?php echo "USD " . number_format($details['precounitario'], 2, ",", ".") ?></span>
                        </div>
                    </div>
                    <button class="add-to-cart button-hover" value="<?php echo $details["produtoID"] ?>"
                        title="Add to cart">
                        Add to cart
                    </button>
                </ul>
            </div>
        </div>
    </main>

    <?php require_once("includes/footer.php") ?>
    <script src="js/index/addToCart.js"></script>
    <script src="js/index/getFavorite.js"></script>
</body>

</html>

<?php mysqli_close($connect); ?>