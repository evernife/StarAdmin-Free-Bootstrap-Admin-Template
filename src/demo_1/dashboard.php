<?php
require "php/sessionvalidator.php";

function getPageFromGet(){
    if (!isset($_GET["action"])){
        return "";
    }
    return $_GET["action"];
}
function getFileFromGet(){
    if (!isset($_GET["file"])){
        return null;
    }
    return $_GET["file"];
}
$_SESSION["page"] = getPageFromGet();
$_SESSION["file"] = getFileFromGet();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Premium Bootstrap Admin Dashboard Template</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php require 'dashboard/top_nav.php'?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <?php require 'dashboard/sidebar.php'?>
        <!-- partial -->
        <div class="main-panel">
            <!-- content-wrapper starts -->
            <?php require 'dashboard/main.php'?>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a href="https://github.com/evernife" target="_blank">Pétrus Pradella</a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Frase do dia: Mais vale um bilhão de passaros na mão, tanto bate, até que fura! <i class="mdi mdi-heart text-danger"></i>
              </span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="../assets/js/shared/off-canvas.js"></script>
<script src="../assets/js/shared/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script>
    class UserData {
        constructor(username, email, fullname) {
            this.username = username;
            this.email = email;
            this.fullname = fullname;
        }
    }
    userData = new UserData(
        "<?php echo $_SESSION['username'] ?>",
        "<?php echo $_SESSION['email'] ?>",
        "<?php echo $_SESSION['fullname'] ?>"
    );
</script>
<script src="../assets/js/dashboard.js"></script>
<?php require 'dashboard/all_js.php'?>
<!-- End custom js for this page-->
</body>
</html>