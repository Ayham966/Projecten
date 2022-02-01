<div class="row">
        <div class="col-12" id="home-photo" >
            <div class="overlay"></div>
            <div class="head-text">
                <?php
                if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
                    echo '
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal">
                    Inloggen!
                </button>
                    ';
                }
                ?>
            </div>
        </div>
</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <div class="avatar">
                    <img src="../images/logo.png" alt="Logo">
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="php/login.php" method="post">
                    <div class="form-group">
                        <span>Email:</span>
                        <input type="text" class="form-control" name="email" placeholder="Email"  required="required">
                    </div>
                    <div class="form-group">
                        <span>Password:</span>
                        <input type="password" class="form-control" name="password" placeholder="Wachtwoord" required="required">

                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block login-btn" id="submit-in">Inloggen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
