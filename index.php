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
    <body class="sb-nav-fixed">
        <?php
        // load twig
        require_once 'vendor/autoload.php';
        $loader = new \Twig\Loader\FilesystemLoader('templates/');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        ?>

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
                <?php //load details template
                    echo $twig->render( 'details.html.twig' , ['products_id' => '1' , 'name' => 'test' , 'reference_number' => '1234' , 'category' => 'informatic' ,  'buy_date' => '22-08-2016' , 'price' => '365€' , 'source_type' => 'Online' , 'source' => 'ebazaar' , 'end_warranty' => '14-11-2022' , 'care_products' => 'phezoyezoyvznpoeyvpoz', 'image_product' => 'receipt.jpg' , 'manual_product' => 'manual.pdf']);
                ?>
                </div>
            </div>
        </div>

        <!-- delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <?php //load delete template
                    echo $twig->render( 'delete.html.twig', ['id_products' => '1', 'name' => 'nom produit']);
                ?>
                </div>
            </div>
        </div>
    
        <header>
            <!-- top bar -->
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between">
    
                <!-- top bar nav -->
                <a class="navbar-brand" href="index.php">Home</a>
                
                <?php //load user template
                    echo $twig->render( 'user.html.twig' , ['user' => 'Guillaume']);
                ?>
            </nav>
        </header>

        <main>
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
                                        require_once('php/view-product.php');
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- footer -->
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">

                    <!-- copyright -->
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>

                    <!-- terms -->
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>
