<div id="printableArea">

<?=$title?> Invoice Number: <?php echo $invoice['invoiceNumber']; ?><br> Order Number: <?php echo $invoice['orderNumber']; ?><br>
Customer Name: <Strong><?=$invoice['customerName']; ?></Strong>
<table>
<tr><th>Sr No.</th><th>Product No.</th><th>Particulars</th><th>Type</th><th>Price</th><th>Qty</th><th>Dis %</th><th>Amount</th></tr>
<?php $i=1; foreach($order as $order): ?>
<tr><td align="center"><?=$i?></td><td align="center"><?=$order->productCode?></td><td align="center"><?=$order->productName;?></td><td align="center"><?=$order->productType?></td>
<td align="center"><?=$order->priceEach?></td><td align="center"><?=$order->quantityOrdered?></td><td align="center"><?=$order->discount?></td><td align="center"><?=$order->amount?></td></tr>
<?php $i++; endforeach; ?>
<tr><th colspan="6" align="right">Gross Amount</th><th><?=$invoice['totalDiscount'];?></th><th><?=$invoice['totalAmount'];?></th></tr>
<tr><th colspan="8" align="right">Amount Paid</th><th><?=$invoice['amount_paid'];?></th></tr>
<tr><th colspan="8" align="right">Amount Due</th><th><?=$invoice['amount_due'];?></th></tr> 
</table>
<input type="button" onclick="printDiv('printableArea')" value="Print Invoice" />
</div>
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>