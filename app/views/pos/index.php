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
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($_SESSION['cart'])) : ?>
                                    <?php
                                        $subtotal = 0;
                                        $total = 0;
                                        $no = 1;
                                        foreach ($_SESSION['cart'] as $key) :
                                            $subtotal = (int) $subtotal + $key['value'] * $key[0]['price'];
                                            $tax = 0.05 * $subtotal;
                                            $total = $total + $subtotal + $tax;
                                            ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td>
                                                <?= $key[0]['name'] ?>
                                                <br>
                                                <span class="qty"> Quantity : <?= $key['value'] ?></span>
                                            </td>
                                            <td>
                                                <a class="btn-danger btn-sm delete" data-id="<?= $key[0]['idproduct']; ?>">
                                                    <i class="fas fa-trash" style='font-size:12px'></i>
                                                </a>
                                                <a class="btn-warning btn-sm reduce" data-id="<?= $key[0]['idproduct']; ?>">
                                                    <i class="fas fa-minus text-white" style='font-size:12px'></i>
                                                </a>
                                            </td>
                                            <td><?= $key[0]['price'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <h5 class="card-title">Card Summary</h5>
                    <p class="card-text">Sub Total : <?= $subtotal ?> </p>
                    <p class="card-text">Tax : <span><?= $tax ?></span> </p>
                    <p class="card-text">Total : <span><?= $total ?></span> </p>
                    <div>
                        <!-- <button class="btn btn-primary col-12">Add Tax</button>
                        <button class="btn btn-danger col-12 mt-2">Remove Tax</button> -->
                        <button class="btn btn-success col-12 mt-2">Save</button>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>