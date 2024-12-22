<?php
include "../../functions.php";
include "../../dbConnection.php";
include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
?>
<?php
$errors = $_SESSION["errors"] ?? [];
$query = "SELECT id , name FROM  category ";
$result = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="container-fluid page-body-wrapper full-page-wrapper">
  <div class="row w-100 m-0">
    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
      <div class="card col-lg-4 mx-auto">


        <div class="card-body px-5 py-5">
          <h3 class="card-title text-left mb-3">Add Product</h3>
          <form method="POST" action="../../handle/addProduct.php" enctype="multipart/form-data">
            <?php showError($errors) ?>
            <div class="form-group">
              <label for="category">Category</label>
              <select name="category" id="category">
                <?php foreach ($categories as $category): ?>
                  <option value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
                <?php endforeach ?>


              </select>

            </div>
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" name="desc" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="number" name="price" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="number" name="quantity" class="form-control p_input">
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="img" class="form-control p_input">
            </div>
            <div class="text-center">
              <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
            </div>
            <?php if (isset($_SESSION["success"])) : ?>
              <div class="alert alert-success" role="alert">
                <?= $_SESSION["success"] ?>
              </div>
            <?php endif ?>
          </form>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- row ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<?php
include "../view/footer.php";
?>
<?php
unset($_SESSION["errors"]);
unset($_SESSION["success"]);

?>