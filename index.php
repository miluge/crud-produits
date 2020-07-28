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
        <!-- Button trigger modal -->
        <button style="margin-top: 156px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
        Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header mb-2">
                        <!-- form title -->
                        <h5 class="modal-title">{{ mode }} product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form method="post" action="" novalidate>

                                <div class="form-row mb-3">
                                    <!-- name input -->
                                    <div class="col-6 form-group">
                                        <label class="small mb-1" for="nameInput">Product name</label>
                                        <input class="form-control py-4" id="nameInput" name="name" type="text" placeholder="Enter product name" value="{{ name }}" required/>
                                        <div class="invalid-feedback">Please enter the product name</div>
                                    </div>
    
                                    <!-- category select -->
                                    <div class="col-4 form-group">
                                        <label class="small mb-1" for="categorySelect">Category</label>
                                        <select class="form-control custom" name="category" id="categorySelect" required>
                                            <option value="{{ category[1] }}">{{ category[1] }}</option>
                                            <option value="{{ category[2] }}">{{ category[2] }}</option>
                                        </select>
                                        <div class="invalid-feedback">Please choose a category</div>
                                    </div>
                                    
                                    <!-- reference input -->
                                    <div class="col-2 form-group">
                                        <label class="small mb-1" for="reference_numberInput">Reference number</label>
                                        <input class="form-control py-4" id="reference_numberInput" name="reference_number" type="text" placeholder="Enter product reference" value="{{ reference_number }}" required/>
                                        <div class="invalid-feedback">Please enter the product reference</div>
                                    </div>
                                </div>
    
                                <div class="form-row mb-3">
                                    <!-- buy date input -->
                                    <div class="col-3 form-group">
                                        <label class="small mb-1" for="buy_dateInput">Buy date</label>
                                        <input class="form-control py-4" id="buy_dateInput" name="buy_date" type="text"  placeholder="Enter buy date" value="{{ buy-date }}" onfocus="(this.type='date')" onblur="(this.type='text')" required/>
                                        <div class="invalid-feedback">Please enter the buy date</div>
                                    </div>

                                    <!-- price input -->
                                    <div class="col-2 form-group">
                                        <label class="small mb-1" for="priceInput">Price</label>
                                        <input class="form-control py-4" id="priceInput" name="price" type="number" placeholder="Enter price" value="{{ price }}" required/>
                                        <div class="invalid-feedback">Please enter the price</div>
                                    </div>

                                    <!-- source type input -->
                                    <div class="col-2 form-group">
                                    <label class="small mb-1" for="source_typeSelect">Purchase type</label>
                                        <select class="form-control custom" name="source_type" id="source_typeSelect" required>
                                            <option value="offline">Offline</option>
                                            <option value="online">Online</option>
                                        </select>
                                        <div class="invalid-feedback">Please choose the purchase type</div>
                                    </div>

                                    <!-- source input -->
                                    <div class="col-5 form-group">
                                        <label class="small mb-1" for="sourceInput">Purchase location</label>
                                        <input class="form-control py-4" id="sourceInput" name="source" type="text" placeholder="Enter source" value="{{ source }}" required/>
                                        <div class="invalid-feedback">Please enter the purchase location</div>
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <!-- end warranty input -->
                                    <div class="col-3 form-group">
                                        <label class="small mb-1" for="end_warrantyInput">End warranty date</label>
                                        <input class="form-control py-4" id="end_warrantyInput" name="end_warranty" type="text"  placeholder="Enter buy date" value="{{ end_warranty }}" onfocus="(this.type='date')" onblur="(this.type='text')" required/>
                                        <div class="invalid-feedback">Please enter the end of warranty date</div>
                                    </div>

                                    <!-- care products input -->
                                    <div class="col-9 form-group">
                                        <label class="small mb-1" for="care_productsInput">Product maintenance advice</label>
                                        <textarea class="form-control" id="care_productsInput" name="care_products" type="text" placeholder="Enter product care_products" required>{{ care_products }}</textarea>
                                        <div class="invalid-feedback">Please enter maintenance advice</div>
                                    </div>
                                </div>

                                <div class="form-row mb-">
                                    <!-- edit image -->
                                    <div class="col-4">
                                        {{ image_product }}
                                    </div>


                                    <!-- edit manual -->
                                    <div class="col-4 offset-2">
                                        {{ manual_product }}
                                    </div>
                                </div>

                                <div class="form-row mb-2">

                                    <!-- receipt image upload -->
                                    <div class="col-4 form-group custom-file">
                                        <input type="file" class="custom-file-input" id="image_productInput" name="image_product" required/>
                                        <label class="small custom-file-label" for="image_productInput">Upload receipt</label>
                                        <div class="invalid-feedback">Please upload the receipt</div>
                                    </div>


                                    <!-- manual upload -->
                                    <div class="col-4 offset-2 form-group custom-file">
                                        <input type="file" class="custom-file-input" id="manual_productInput" name="manual_product"/>
                                        <label class="small custom-file-label" for="manual_productInput">Upload manual</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- submit button -->
                        <button type="button" class="btn btn-primary">{{ mode }}</button>
                    </div>
                </div>
            </div>
        </div>
    
        <header>
            <!-- top bar -->
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between">
    
                <!-- top bar title -->
                <a class="navbar-brand" href="index.php">Home</a>
                
                <?php
                    //load user template
                    echo $twig->render( 'user.html.twig' , ['user' => 'Guillaume']);
                ?>
            </nav>
        </header>

        <main>
            <div class="container">

                <!-- table -->
                <div id="product-list" class="card mb-4">
                    <!-- table title -->
                    <div class="card-header mb-2">
                        <em class="fas fa-table mr-1"></em>
                        Products
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

                                <!-- table entries -->
                                <tbody>

                                    <?php
                                        //load entry template
                                        echo $twig->render( 'entry.html.twig' , ['reference_number' => 'AAA','name' => 'computer', 'category' => 'informatic', 'price' => '599€', 'buy_date' => '28/07/20', 'action' => 'delete']);
                                    ?>

                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                    </tr>
                                    <tr>
                                        <td>Cedric Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2012/03/29</td>
                                        <td>$433,060</td>
                                    </tr>
                                    <tr>
                                        <td>Airi Satou</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>33</td>
                                        <td>2008/11/28</td>
                                        <td>$162,700</td>
                                    </tr>
                                    <tr>
                                        <td>Brielle Williamson</td>
                                        <td>Integration Specialist</td>
                                        <td>New York</td>
                                        <td>61</td>
                                        <td>2012/12/02</td>
                                        <td>$372,000</td>
                                    </tr>
                                    <tr>
                                        <td>Herrod Chandler</td>
                                        <td>Sales Assistant</td>
                                        <td>San Francisco</td>
                                        <td>59</td>
                                        <td>2012/08/06</td>
                                        <td>$137,500</td>
                                    </tr>
                                    <tr>
                                        <td>Rhona Davidson</td>
                                        <td>Integration Specialist</td>
                                        <td>Tokyo</td>
                                        <td>55</td>
                                        <td>2010/10/14</td>
                                        <td>$327,900</td>
                                    </tr>
                                    <tr>
                                        <td>Colleen Hurst</td>
                                        <td>Javascript Developer</td>
                                        <td>San Francisco</td>
                                        <td>39</td>
                                        <td>2009/09/15</td>
                                        <td>$205,500</td>
                                    </tr>
                                    <tr>
                                        <td>Sonya Frost</td>
                                        <td>Software Engineer</td>
                                        <td>Edinburgh</td>
                                        <td>23</td>
                                        <td>2008/12/13</td>
                                        <td>$103,600</td>
                                    </tr>
                                    <tr>
                                        <td>Jena Gaines</td>
                                        <td>Office Manager</td>
                                        <td>London</td>
                                        <td>30</td>
                                        <td>2008/12/19</td>
                                        <td>$90,560</td>
                                    </tr>
                                    <tr>
                                        <td>Quinn Flynn</td>
                                        <td>Support Lead</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2013/03/03</td>
                                        <td>$342,000</td>
                                    </tr>
                                    <tr>
                                        <td>Charde Marshall</td>
                                        <td>Regional Director</td>
                                        <td>San Francisco</td>
                                        <td>36</td>
                                        <td>2008/10/16</td>
                                        <td>$470,600</td>
                                    </tr>
                                    <tr>
                                        <td>Haley Kennedy</td>
                                        <td>Senior Marketing Designer</td>
                                        <td>London</td>
                                        <td>43</td>
                                        <td>2012/12/18</td>
                                        <td>$313,500</td>
                                    </tr>
                                    <tr>
                                        <td>Tatyana Fitzpatrick</td>
                                        <td>Regional Director</td>
                                        <td>London</td>
                                        <td>19</td>
                                        <td>2010/03/17</td>
                                        <td>$385,750</td>
                                    </tr>
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
    </body>
</html>
