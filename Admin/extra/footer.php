            </div>
            </main>
            <div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Product Details</h5>
                            <button type="button" class="close bg-transparent border-0" data-dismiss="modal" aria-label="Close" onclick='$("#add-product").modal("hide");'>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Modal Body -->
                        <form action='../extra/add.php' method='POST' enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="addimage" class="col-sm-5 col-form-label"><b>Product Image : </b></label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" name="image" id="addimage">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="addname" class="col-sm-5 col-form-label"><b>Product Name : </b></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="addname" name='name' required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="adddesc" class="col-sm-5 col-form-label"><b>Product Description : </b></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="adddesc" name="Description" rows="3"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="addbrand" class="col-sm-5 col-form-label"><b>Product Brand : </b></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" required id="addbrand" name="brand">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="addno" class="col-sm-5 col-form-label"><b>Product Quantity: </b></label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" required id="addno" name="no">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="addcost" class="col-sm-5 col-form-label"><b>Unit Cost : </b></label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" required id="addcost" name="cost">
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal" onclick='$("#add-product").modal("hide");'> Close </button>
                                <button type="submit" class="btn btn-outline-primary"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('.submit_on_enter').keydown(function(event) {
                        // enter has keyCode = 13, change it if you want to use another button
                        if (event.keyCode == 13) {
                            this.form.submit();
                            return false;
                        }
                    });
                });
            </script>
            </body>

            </html>