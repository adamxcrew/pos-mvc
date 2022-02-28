<div class="container-md mt-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Transaction List</h3>
            <div class="table-responsive-md table-sm mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Invoice Number</th>
                            <th scope="col">Total</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><?= $row['invoice_number'] ?></td>
                                    <td><?= $row['total'] ?></td>
                                    <td><?= $row['payment'] ?></td>
                                    <td>
                                        <a style="text-decoration:none;" href="<?= BASEULR ?>/transaction/delete/<?= $row['invoice_number'] ?>">Detail</a>
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