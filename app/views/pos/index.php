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
                <div class="card-body" id="content">
                    <div class="row">
                        <?php if (!empty($data['product'])) : ?>
                            <?php
                                foreach ($data['product'] as $row) :
                                    ?>
                                <div class="card text-center mb-3" style="width: 17rem;">
                                    <img class="card-img-top mt-2" src="uploads/<?= $row['image']; ?>" style="object-fit: content; width:100%; height:130px" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold"><?= $row['name']; ?></h5>
                                        <h6 class="font-weight-bold" style="color: red;"><?= number_format($row['price'], 2, ',', '.')  ?></h6>
                                        <a href="<?= BASEULR ?>/pos/cart/<?= $row['idproduct'] ?>" class="btn btn-primary">Add To Cart <i class="fas fa-cart-plus"></i> </a>
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
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($_SESSION['cart'])) : ?>
                                    <?php
                                        $subtotal = 0;
                                        $total = 0;
                                        $pricetotal = 0;
                                        $no = 1;
                                        foreach ($_SESSION['cart'] as $key) :
                                            $subtotal = (int) $subtotal + $key['value'] * $key[0]['price'];
                                            $tax = 0.05 * $subtotal;
                                            $total = $subtotal + $tax;
                                            $pricetotal = $key['value'] * $key[0]['price'];
                                            ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td>
                                                <?= $key[0]['name'] ?>
                                                <br>
                                                <span class="qty"> Quantity : <?= $key['value'] ?></span>
                                                <br>
                                                <span>Price : <?= $key[0]['price'] ?></span>
                                            </td>
                                            <td>
                                                <a class="btn-danger btn-sm delete" data-id="<?= $key[0]['idproduct']; ?>">
                                                    <i class="fas fa-trash" style='font-size:12px'></i>
                                                </a>
                                                <a class="btn-warning btn-sm reduce" data-id="<?= $key[0]['idproduct']; ?>">
                                                    <i class="fas fa-minus text-white" style='font-size:12px'></i>
                                                </a>
                                            </td>
                                            <td>Rp<?= number_format($pricetotal, 2, ',', '.')  ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <form method="post" action="<?= BASEULR; ?>/pos/payment">
                        <h5 class="card-title">Card Summary</h5>
                        <p class="card-text"> Sub Total : <span id="subTotal"> <?= ($subtotal)  ?></span> </p>
                        <p class="card-text">Tax : <span><?= number_format($tax, 2, ',', '.')  ?></span> </p>
                        <!-- <p class="card-text"> Tax : <span id="tax">Rp. 0</span></p> -->
                        <p class="card-text">Total : <span id="totalAll"><?= number_format($total, 2, ',', '.')  ?></span> </p>
                        <div>
                            <!-- <button class="btn btn-primary col-12 addtax">Add Tax</button>
                            <button class="btn btn-danger col-12 mt-2 removetax">Remove Tax</button> -->
                            <button class="btn btn-success col-12 mt-2" id="btnSave" disabled><i class="fas fa-save "></i> Save </button>
                        </div>
                        <div class="form-group mt-3">
                            <input type="number" name="payment" class="form-control mb-3" id="payment" placeholder="Input Customer Payment Amount" min=1>
                            <input type="hidden" id="total" value="<?= $total ?>">
                            <span>Payment : </span>
                            <h4 class="font-weight-bold mb-3 text-warning" id="paymentText">Rp. 0</h4>
                            <span>Receipt : </span>
                            <h4 class="font-weight-bold text-info" id="receipt"> Rp. 0 </h4>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>