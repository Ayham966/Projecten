<?php

include("../includes/header.inc.php");
?>
                    <form action="" method="post" style="width: 100%; text-align: center">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this?</p>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" name="action" value="Yes">
                                    <input type="submit" class="btn btn-secondary" data-dismiss="modal" name="action" value="Cancel">
                                </div>
                            </div>
                        </div>
                    </form>



