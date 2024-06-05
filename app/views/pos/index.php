<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Product List</h3>
                        </div>
                        <div class="col-md-8">
                            <!-- method="post" action="<?= BASEULR; ?>/pos/search" -->
                            <form>
                                <div class="form-group d-flex flex-row">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search" autocomplete="off">
                                    <button class="btn btn-outline-primary" type="submit">Search</button>
                                    <a href="<?= BASEULR ?>/pos" class="btn btn-outline-danger">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" id="content">
                        <?php if (!empty($data['product'])) : ?>
                            <?php
                            foreach ($data['product'] as $row) :
                            ?>
                                <div class="card text-center mb-3" style="width: 17rem;">
                                    <img class="card-img-top mt-2" src="uploads/<?= $row['image']; ?>" style="object-fit: content; width:100%; height:130px" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold"><?= $row['name']; ?></h5>
                                        <h6 class="font-weight-bold" style="color: red;"><?= number_format($row['price'], 2, ',', '.')  ?></h6>
                                        <a href="<?= BASEULR ?>/pos/cart/<?= $row['idproduct'] ?>" class="btn btn-primary">Add To Cart <i class="fa fa-plus"></i> </a>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            Flasher::Message();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($_SESSION['cart'])) : ?>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $key) :
                                        $subTotal = (int) $key['qty'] * $key['item']['product_price'];
                                        $total = $total + (int) $key['qty'] * (int) $key['item']['product_price'];

                                    ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td>
                                                <?= $key['item']['product_name'] ?>
                                                <br>
                                                <span class="qty"> Quantity : <?= $key['qty'] ?> </span>
                                                <br>
                                                <span>Price: <?= number_format($key['item']['product_price'], 2, ',', '.') ?></span>
                                            </td>
                                            <td>
                                                <a class="btn-danger btn-sm delete" style="text-decoration: none; cursor: pointer;" data-id="<?= $key['item']['id_product'] ?>">
                                                    <i class="fa fa-trash" style='font-size:12px;'></i>
                                                </a>
                                                <a class="btn-warning btn-sm reduce" style="text-decoration: none; cursor: pointer;" data-id="<?= $key['item']['id_product'] ?>">
                                                    <i class="fa fa-minus" style='font-size:12px;'></i>
                                                </a>
                                            </td>
                                            <td>Rp<?= number_format($subTotal, 2, ',', '.')  ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <form method="post" action="<?= BASEULR; ?>/pos/payment">
                        <h5 class="card-title">Card Summary</h5>
                        <?php if (!empty($_SESSION['cart'])) : ?>
                            <p class="card-text">Total :<?= number_format($total, 2, ',', '.')  ?> <span id="totalAll"></span> </p>
                        <?php elseif (empty($_SESSION['cart'])) : ?>
                            <p class="card-text">Total :<span id="totalAll"></span> </p>
                        <?php endif; ?>
                        <div>
                            <button class="btn btn-success col-12 mt-2" id="btnSave" disabled><i class="fa fa-save "></i> Save </button>
                        </div>
                        <div class="form-group mt-3">
                            <input type="number" name="payment" class="form-control mb-3" id="payment" placeholder="Input Customer Payment Amount" min=1>
                            <input type="hidden" id="total" name="total" value="<?= $total ?>">
                            <span>Payment : </span>
                            <h4 class="font-weight-bold mb-3 text-warning" id="paymentText">Rp. 0</h4>
                            <span>Receipt : </span>
                            <h4 class="font-weight-bold text-info" id="receipt"> Rp. 0 </h4>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>