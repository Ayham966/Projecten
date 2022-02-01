
<footer class="page-footer font-small unique-color-dark pt-4 fcos">
    <div class="container f1">
        <ul class="list-unstyled list-inline text-center py-2">
            <?php
            if  (isset($_SESSION['klant'])) {
                echo '<li class="list-inline-item">
                <h5 class="mb-1">Welcome Klant!</h5>
            </li>';
                }

            else if  (  isset($_SESSION['admin']) )  {
                echo '<li class="list-inline-item">
                <h5 class="mb-1">Welcome Admin!</h5>
            </li>';
            }
            else {
                    echo '
            
            <li class="list-inline-item">
                <h5 class="mb-1">Register for free</h5>
            </li>
            <li class="list-inline-item">
                <a href="index.php?page=SignUp">
                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                Sign up!
                </button>
                </a>
            </li>
            ';
            }
             ?>
        </ul>
    </div>
    <div class="footer-copyright text-center py-3" id="copy">© 2020 Copyright: Book on Shelf </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="js/custom.js"></script>
</footer>
</body>
</html>