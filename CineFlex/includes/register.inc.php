<?php
$msg_err = "";
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-5 mx-auto">
            <div class="card my-5 card-login">
                <div class="card-body p-5">
                    <!--<h5 class="card-title text-center"><img class="" src="" height="80" alt="logo"></h5>-->
                    <h5 class="card-title text-center">Register</h5>
                    <span class="help-block" style="color: red;"><?php echo $msg_err ?></span>
                    <br>
                    <form method="post" action="php/register.php">
                        <div class="form-label-group">
                            <label for="inputEmail">Email address:</label>
                            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                        </div>
                        <br>
                        <div class="form-label-group">
                            <label for="inputPass">Wachtwoord:</label>
                            <input type="password" name="password" class="form-control" placeholder="Wachtwoord" required>
                        </div>
                        <br>
                        <div class="form-label-group">
                            <label for="inputPass">Wachtwoord herhalen:</label>
                            <input type="password" name="password-repeat" class="form-control" placeholder="Wachtwoord" required>
                        </div>
                        <br>
                        <button class="btn btn-danger btn-block text-uppercase" type="submit" name="submit">Register</button>
                        </br>
                        <div class="row mb-4 px-3"> <span>Hebt u al een account? <a class="primary" href="index.php?page=login">Inloggen</a></span> </div>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

