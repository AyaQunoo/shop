<?php
include "../../functions.php";
include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";


?>

<?php
$errors = $_SESSION["errors"] ?? [];

?>
<div class="card-body px-5 py-5 ">
  <h3 class="card-title text-left mb-3">Add Category</h3>
  <?php showError($errors) ?>
  <form method="POST" action="../../handle/addCategory.php">
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control p_input text-light">
    </div>
    <div class="text-center">
      <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
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