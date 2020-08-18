<?php
//if already logged => redirect to index.php
session_start();
require_once 'php/functions.php';
if (check_user() !== false){
    header("location:index.php"); 
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
        <title>Products manager - Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="h1 font-weight-bold text-primary text-center my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <label class="mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" placeholder="Enter email address" />
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" />
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login"/>
                                                <div id="error" class="invalid-feedback"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/login.js"></script>
    </body>
</html>
