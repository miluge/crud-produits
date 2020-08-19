<?php
session_start();
require_once('php/functions.php');
$user = check_user();
if($user === false) {//if not connected: redirect to login
    header('location:login.php');
}else{
    //load twig
    require_once 'vendor/autoload.php';
    $loader = new \Twig\Loader\FilesystemLoader('templates/');
    $twig = new \Twig\Environment($loader, [
        'cache' => false,
    ]);
    //connect to db
    $pdo = pdo_connect_mysql();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Products manager - Home</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed h-auto">

        <!-- form modal -->
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div id="form-modal-content" class="modal-content">
                    <!-- include form template -->
                </div>
            </div>
        </div>

        <!-- details modal -->
        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div id="details-modal-content" class="modal-content">
                    <!-- include details template -->
                </div>
            </div>
        </div>

        <!-- delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div id="delete-modal-content" class="modal-content">
                    <!-- include delete template -->
                </div>
            </div>
        </div>
    
        <header>
            <!-- top bar -->
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between">
    
                <!-- top bar nav -->
                <a class="navbar-brand" href="index.php">Home</a>
                
                <?php //load user template
                    echo $twig->render( 'user.html.twig' , $user);
                ?>
            </nav>
        </header>

        <main class="pb-5">
            <div class="container">

                <!-- table -->
                <div id="product-list" class="card mb-4">
                    <div class="card-header mb-2 p-4 d-flex justify-content-between">
                        <!-- table title -->
                        <p><em class="fas fa-table mr-1"></em>Products</p>

                        <!-- add modal button -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#formModal">
                            Add product
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mt-2" id="dataTable">
                                <!-- table bottom title -->
                                <caption>Products</caption>
                                <!-- table top legend -->
                                <thead>
                                    <tr>
                                        <th scope="reference_number">Reference</th>
                                        <th scope="name">Name</th>
                                        <th scope="category">Category</th>
                                        <th scope="price">Price</th>
                                        <th scope="buy_date">Buy date</th>
                                        <th scope="action">Action</th>
                                    </tr>
                                </thead>

                                <!-- table bottom legend -->
                                <tfoot>
                                    <tr>
                                        <th scope="reference_number">Reference</th>
                                        <th scope="name">Name</th>
                                        <th scope="category">Category</th>
                                        <th scope="price">Price</th>
                                        <th scope="buy_date">Buy date</th>
                                        <th scope="action">Action</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php  //load table entries template
                                        require_once('php/view.php');
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- footer -->
        <footer class="py-4 bg-light fixed-bottom">
            <div class="container-fluid">
                <div class="d-flex justify-content-between small">
                    <div class="text-muted">ACS Besançon promo 2020</div>
                    <div class="text-muted">Guillaume Perbet (Front) et Guillaume Blondel (Back)</div>
                </div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>
        <script src="js/script.js"></script>

    </body>
</html>
