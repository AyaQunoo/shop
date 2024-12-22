<?php include 'partials/header.php' ?>
<?php include 'partials/navbar.php' ?>

<?php
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
?>
<section id="page-header" class="about-header">
    <h2>#Cart</h2>
    <p>Let's see what you have.</p>
</section>

<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Image</td>
                <td>Name</td>
                <td>Desc</td>
                <td>Quantity</td>
                <td>price</td>
                <td>Subtotal</td>
                <td>Remove</td>

            </tr>
        </thead>

        <tbody>
            <?php foreach ($cart as $product): ?>
                <tr>
                    <td><img src="admin/upload/<?= $product["image"] ?>" alt="product1"></td>
                    <td><?= $product["product_name"] ?></td>
                    <td><?= $product["Desc"] ?></td>
                    <td><?= $product["quantity"] ?></td>
                    <td><?= $product["price"] ?></td>
                    <td><?= $product["Subtotal"] ?></td>


                    <td></td>

                    <!-- Remove any cart item  -->
                    <td>
                        <form action="handle/removeFromCart.php" method="post">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" name="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>



                </tr>
            <?php endforeach ?>
        </tbody>
        <!-- confirm order  -->
        <td><button type="submit" name="" class="btn btn-success">Confirm</button></td>

    </table>
</section>

<!-- <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" placeholder="Enter coupon code">
            <button class="normal">Apply</button>
        </div>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$118.25</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$118.25</strong></td>
                </tr>
            </table>
            <button class="normal">proceed to checkout</button>
        </div>
    </section> -->

<?php include "partials/footer.php" ?>