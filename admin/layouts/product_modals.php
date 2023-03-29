<!-- Add Modal -->
<div class="modal fade" id="addProduct" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addProductForm" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="container-fluid pt-4 px-4">
                        <div class="row g-4">
                            <div class="col-sm-12">
                                <input type="hidden" name="ll_product_id" value="<?php echo $GLOBALS['product_']; ?>">
                                <div class="rounded h-100 p-4 row">
                                  <div class="col-12">

                                    <div class="alert alert-danger d-none" id="addFormError" role="alert"></div>

                                  </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="title" class="form-label">Product Title</label>
                                        <input type="text" name="product_name" class="form-control" id="title" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="product_price" class="form-control" id="price" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="title" class="form-label">Product HeadLine</label>
                                        <input type="text" name="product_headline" class="form-control" id="title">
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="image" class="form-label">Product Image</label>
                                        <input type="file" name="image[]" class="form-control" id="image" multiple required>
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" columns="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                </div>

            </form>

        </div>
    </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="editProduct" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProductForm" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="container-fluid pt-4 px-4">
                        <input type="hidden" name="id" />
                        <div class="row g-4">
                            <div class="col-sm-12">
                                <input type="hidden" name="ll_product_id" value="">
                                <div class="rounded h-100 p-4 row">
                                  <div class="col-12">

                                    <div class="alert alert-danger d-none" id="editFormError" role="alert"></div>

                                  </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="title" class="form-label">Product Title</label>
                                        <input type="text" name="product_name" class="form-control" id="title" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="product_price" class="form-control" id="price" required>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="title" class="form-label">Product HeadLine</label>
                                        <input type="text" name="product_headline" class="form-control" id="title">
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="image" class="form-label">Product Image</label>
                                        <input type="file" name="image[]" class="form-control" id="image" multiple id="image">
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" columns="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                </div>

            </form>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="delProduct" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delProductLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this product?
                <div class="col-12">

                    <div class="alert alert-danger d-none" id="delFormError" role="alert"></div>

                </div>
            </div>
            <form id="deleteProduct">
                <input type="hidden" value="" name="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>