<?php foreach ($invoice as $invoice): ?>

    <h2><?php echo $invoice['invoiceNumber'] ?></h2>
    <div id="main">
        <?php echo $invoice['invoiceComment'] ?>
    </div>
    <p><a href="<?php echo $invoice['invoiceNumber'] ?>">View Invoice</a></p>

<?php endforeach ?>