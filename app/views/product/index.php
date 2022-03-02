<div class="container-md mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Product List</h3>
                </div>
                <div class="col-sm-12">
                    <?php
                    Flasher::Message();
                    ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive-md">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data['product'])) : ?>
                                    <?php
                                        $no = 1;
                                        foreach ($data['product'] as $row) :
                                            ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['name']; ?></td>
                                            <td><img width="30%" src="uploads/<?= $row['image']; ?>" class="img-fluid" alt="Product Image"></td>
                                            <td><?= $row['description']; ?></td>
                                            <td><?= $row['quantity']; ?></td>
                                            <td><?= $row['price']; ?></td>
                                            <td>
                                                <button type="button" data-id="<?= $row['idproduct'] ?>" class="badge bg-primary edit_data" data-bs-toggle="modal" data-bs-target="#editData">Edit</button>
                                                <a style="text-decoration:none;" href="<?= BASEULR; ?>/product/delete/<?= $row['idproduct'] ?>" class="badge bg-danger" onclick="return confirm('delete?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Create Product</h3>
                </div>
                <div class="card-body">
                    <form action="<?= BASEULR; ?>/product/create" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-3">
                            <label for="productname">Product Name</label>
                            <input type="text" class="form-control" id="productname" name="productname" id="productname" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="form-group mt-3">
                                <label for="imagemodal">Product Image</label>
                                <input type="file" id="files" class="form-control-file" id="imagemodal" name="productimage">
                                <img width="50%" src="" alt="" id="image" class="mt-2">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="descmodal">Description</label>
                            <textarea class="form-control" id="descmodal" rows="3" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" id="qty" min=1>
                        </div>
                        <div class="form-group mt-3">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" id="price">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" id="save">Submit Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data  -->

<!-- Modal -->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group mt-3">
                        <label for="productname">Product Name</label>
                        <input type="text" class="form-control" name="productnamemodal" id="productnamemodal" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <img id="imgmodal" class="card-img-top mt-2" src="" style="object-fit: content; width:100%; height:130px" alt="Card image cap">
                    </div>
                    <!-- <div class="form-group">
                        <div class="form-group mt-3">
                            <label for="imagemodal">Product Image</label>
                            <input type="file" id="files" class="form-control-file" id="imagemodal" name="productimage">
                            <img width="50%" src="" alt="" id="image" class="mt-2">
                        </div>
                    </div> -->
                    <div class="form-group mt-3">
                        <label for="descriptionmodal">Description</label>
                        <textarea class="form-control" rows="3" name="descriptionmodal" id="descriptionmodal"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="qtymodal">Quantity</label>
                        <input type="number" class="form-control" name="quantitymodal" id="qtymodal" min=1>
                    </div>
                    <div class="form-group mt-3">
                        <label for="pricemodal">Price</label>
                        <input type="number" class="form-control" name="pricemodal" id="pricemodal">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('files').onchange = function(e) {
        let src = URL.createObjectURL(this.files[0]);
        document.getElementById('image').src = src;
    }
</script>