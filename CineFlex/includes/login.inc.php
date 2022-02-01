<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-5 mx-auto">
            <div class="card my-5 card-login">
                <div class="card-body p-5">
<!--                    <h5 class="card-title text-center"><img class="" src="" height="80" alt="logo"></h5>-->
                    <h5 class="card-title text-center">Inloggen</h5>
                    <span class="help-block" style="color: red;"><?php ?></span>
                    <br>
                    <form class="" method="post" action="php/login.php">
                        <div class="form-label-group">
                            <label for="inputEmail">Email address:</label>

                            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                        </div>
                        <br>
                        <div class="form-label-group">
                            <label for="inputPass">Wachtwoord:</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <br>
                        <button class="btn btn-danger btn-block text-uppercase" type="submit" name="submit">Login</button>
                        </br>
<!--                        <div class="row mb-4 px-3"> <span>Hebt u geen account? <a class="primary" href="index.php?page=register">Register</a></span> </div>-->
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

