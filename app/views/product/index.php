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
                            <input type="text" class="form-control" id="productname" name="productname" id="productname">
                        </div>
                        <div class="form-group">
                            <div class="form-group mt-3">
                                <label for="exampleFormControlFile1">Product Image</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="productimage">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" id="qty">
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