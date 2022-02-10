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
                    <div class="row">
                        <?php if (!empty($data['product'])) : ?>
                            <?php
                                $no = 1;
                                foreach ($data['product'] as $row) :
                                    ?>
                                <div class="card text-center mb-3" style="width: 17rem;">
                                    <img class="card-img-top" src="uploads/<?= $row['image']; ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row['name']; ?></h5>
                                        <a href="<?= BASEULR ?>/pos/cart/<?= $row['idproduct'] ?>" class="btn btn-primary">Add To Cart</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Cart Product</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <h5 class="card-title">Card Summary</h5>
                    <p class="card-text">Sub Total : 250000 </p>
                    <p class="card-text">Tax : 0 </p>
                    <p class="card-text">Total : 0 </p>
                </div>
            </div>
        </div>
    </div>

</div>
</div>