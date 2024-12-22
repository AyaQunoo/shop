<?php include 'partials/header.php' ?>
<?php include 'partials/navbar.php';
include "dbConnection.php"; ?>
<section id="product1" class="section-p1">
  <h2>Featured Products</h2>
  <p>Summer Collection New Modren Desgin</p>
  <div class="pro-container">
    <?php
    $errors = $_SESSION["errors"] ?? [];

    ?>
    <?php
    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    } else {
      $page = 1;
    }
    $limit = 2;
    $offset = ($page - 1) * $limit;
    $query = "SELECT count(id) as total FROM products ;";
    $runQuery = mysqli_query($conn, $query);
    $total = mysqli_fetch_assoc($runQuery)["total"];
    $numberOfPages =  ceil($total / $limit);


    $selectProducts = "select * from `products` limit $limit offset $offset ";
    $runSelectProducts = mysqli_query($conn, $selectProducts);
    $resultProducts = mysqli_fetch_all($runSelectProducts, MYSQLI_ASSOC);

    if (count($resultProducts) > 0) {
      foreach ($resultProducts as $product) { ?>
        <div class="pro">
          <!-- <form> -->
          <img src="admin/upload/<?php echo $product['image']; ?>" alt="p1" />
          <div class="des">
            <h2><?php echo $product['name']; ?></h2>
            <h5><?php echo $product['description']; ?></h5>
            <div class="star ">
              <i class="fas fa-star "></i>
              <i class="fas fa-star "></i>
              <i class="fas fa-star "></i>
              <i class="fas fa-star "></i>
              <i class="fas fa-star "></i>
            </div>
            <h4><?php echo $product['price']; ?></h4>
            <form action="handle/addToCart.php" method="post">
              <input type="number" name="quantity">
              <input type="hidden" hidden name="product" value='<?php echo json_encode($product); ?>'>
              <button type="submit" name="submit"><a class="cart "><i class="fas fa-shopping-cart "></i></a></button>

            </form>


          </div>
        </div>

    <?php }
    }
    ?>
    <?php showError($errors) ?>
    <?php if (isset($_SESSION["success"])) : ?>
      <div class="alert alert-success" role="alert">
        <?= $_SESSION["success"] ?>
      </div>
    <?php endif ?>

  </div>

  </div>
</section>



<section id="pagenation" class="section-p1">
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
        <a class="page-link" href="shop.php?page=<?= $page - 1 ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#"><?= $page ?> of<?= $numberOfPages ?> </a></li>

      <li class="page-item <?php if ($numberOfPages == $page) echo 'disabled'; ?>">
        <a class="page-link" href="shop.php?page=<?= $page + 1 ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav>

</section>

<section id="newsletter" class="section-p1 section-m1">
  <div class="newstext ">
    <h4>Sign Up For Newletters</h4>
    <p>Get E-mail Updates about our latest shop and <span class="text-warning ">Special Offers.</span></p>
  </div>
  <div class="form ">
    <input type="text " placeholder="Enter Your E-mail... ">
    <button class="normal ">Sign Up</button>
  </div>
</section>


<?php include 'partials/footer.php' ?>
<?php
unset($_SESSION["errors"]);
unset($_SESSION["success"]);

?>