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
                            <th scope="col">Action</th>
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
                                        <button type="button" data-id="<?= $row['id_transaction'] ?>" class="badge bg-primary trans_details" data-bs-toggle="modal" data-bs-target="#exampleModal">Details</button>
                                        <a style="text-decoration:none;" href="<?= BASEULR; ?>/transactions/delete/<?= $row['id_transaction'] ?>" class="badge bg-danger" onclick="return confirm('delete?')">Delete</a>
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

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Table Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" style="text-align: center;">Quantity</th>
                                <th scope="col" style="text-align: center;">Price</th>
                                <th scope="col">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="list_transaction">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>