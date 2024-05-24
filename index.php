<?php 
include "config/koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en"></html>
<?php 
    include 'tampilan/template/header.php';
?>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php 
                include 'tampilan/template/profil.php';
            ?>
            <?php 
                include 'tampilan/template/menu.php';
            ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="container-fluid">
                    <?php   
                            $page = isset($_GET['page']) ? $_GET['page'] : 'index'; ?>
                    <?php      
                       
                        if($page == "index"){
                            include "tampilan/dashboard/index.php";
                        }
                        elseif($page == "bahan"){
                            include "tampilan/bahan/index.php";
                        }
                        elseif($page == "supplier"){
                            include "tampilan/supplier/index.php";
                        }
                        elseif($page == "persediaan-masuk"){
                            include "tampilan/persediaan-masuk/index.php";
                        }
                        elseif($page == "persediaan-keluar"){
                            include "tampilan/persediaan-keluar/index.php";
                        }
                        elseif($page == "add-persediaan-keluar"){
                            include "tampilan/persediaan-keluar/index-insert.php";
                        }
                        elseif($page == "edit-persediaan-keluar"){
                            include "tampilan/persediaan-keluar/index-edit.php";
                        }
                        elseif($page == "laporan"){
                            include "tampilan/laporan/index.php";
                        }
                        elseif($page == "user"){
                            include "tampilan/user/index.php";
                        }
                        elseif($page == "system"){
                            include "tampilan/system/index.php";
                        }else {
                            include "tampilan/404.php";
                        }
                        
                    ?>
                    </div>
                </div> 
            </div>
            <?php 
                include 'tampilan/template/footer.php';
            ?>
        </div>
    </body>
</html>
