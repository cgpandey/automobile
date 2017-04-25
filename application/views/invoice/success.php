<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.calculation.min.js" ></script>

<?=$title?> Invoice Number: <?php echo $invoice['invoiceNumber']; ?> Order Number: <?php echo $invoice['orderNumber']; ?><br>
Custome Name: <Strong><?=$invoice['customerName']; ?></Strong>
<table>
<tr><th>Sr No.</th><th>Product No.</th><th>Particulars</th><th>Type</th><th>Price</th><th>Qty</th><th>Dis %</th><th>Amount</th></tr>
<?php echo form_open('invoice/printinvoice');
 $i=1; $gross_amount =0; $temporder = $order;
foreach($order as $order):
$msrp = array(
              'name'        => "MSRP[$order->productCode]",
              'id'          => 'MSRP'.$order->productCode,
              'value'       => $order->priceEach,
              );
$productCode = array(
              'name'        => "productCode[$order->productCode]",
              'id'          => 'productCode'.$order->productCode,
              'value'       => $order->productCode,
              );
$productName = array(
              'name'        => "productName[$order->productCode]",
              'id'          => 'productName'.$order->productCode,
              'value'       => $order->productName,
              );
$productType = array(
              'name'        => "productType[$order->productCode]",
              'id'          => 'productType'.$order->productCode,
              'value'       => $order->productType,
              );

$quantityOrdered = array(
              'name'        => "quantityOrdered[$order->productCode]",
              'id'          => 'quantityOrdered'.$order->productCode,
              'value'       => $order->quantityOrdered,
              );
$discount = array(
              'name'        => "discount[$order->productCode]",
              'id'          => 'discount'.$order->productCode,
              'value'       => $order->discount,
              );

$gross_amount_discount = array(
              'name'        => 'gross_amount_discount',
              'id'          => 'gross_amount_discount',
              'value'       => $invoice['totalDiscount'],
              );

$amount_paid = array(
              'name'        => 'amount_paid',
              'id'          => 'amount_paid',
              'value'       => $invoice['amount_paid'],
              );

$amount = $order->quantityOrdered * $order->priceEach; 
$total_amount = array(
              'name'        => "amount[$order->productCode]",
              'id'          => 'amount'.$order->productCode,
              'value'       => $amount,
              );?>
<tr><td><?=$i?></td><td><?php echo $order->productCode;?></td><td><?php echo form_input($productName);?></td><td><?php echo form_input($productType);?></td>
<td><?php echo form_input($msrp);?></td><td><?php echo form_input($quantityOrdered);?></td><td><?php echo form_input($discount);?></td><td><?php echo form_input($total_amount);?></tr>
	<?php $i++; ?>
	<?php $gross_amount_text = $gross_amount + $amount; ?>

<?php endforeach; 
$gross_amount = array(
              'name'        => 'gross_amount',
              'id'          => 'gross_amount',
              'value'       => $gross_amount_text,
              );
$amount_due_text = $gross_amount_text - $invoice['amount_paid'];
$amount_due = array(
              'name'        => 'amount_due',
              'id'          => 'amount_due',
              'value'       => $amount_due_text,
              );
              ?>

<tr><th colspan="6" align="right">Gross Amount</th><th><?php echo form_input($gross_amount_discount);?></th><th><?php echo form_input($gross_amount);?></th></tr>
<tr><th colspan="8" align="right">Amount Paid</th><th><?php echo form_input($amount_paid);?></th></tr>
<tr><th colspan="8" align="right">Amount Due</th><th><?php echo form_input($amount_due);?></th></tr>

<tr><td colspan="8"><?php echo form_hidden('orderNumber', $invoice['orderNumber']); ?><?php echo form_hidden('invoiceNumber', $invoice['invoiceNumber']); ?><?php echo form_submit('mysubmit', 'Update and Print Invoice!');?></td></tr>
 
 <?php form_close(); ?>
</table>
<div id="updateqty<?=$order->productCode?>"></div>
<script type="text/javascript">
function compute() {
  var gross_amount =0;
  <?php  foreach($temporder as $order): ?>
  var msrp<?=$order->productCode?> = parseFloat($('#MSRP<?=$order->productCode?>').val()); // number of individuals
  var qty<?=$order->productCode?> = parseInt($('#quantityOrdered<?=$order->productCode?>').val());    // number of couples
  var discount<?=$order->productCode?> = parseFloat($('#discount<?=$order->productCode?>').val());
  var gross_amount_discount = parseFloat($('#gross_amount_discount').val());
  var total<?=$order->productCode?> = msrp<?=$order->productCode?> * qty<?=$order->productCode?>;   
  var discount<?=$order->productCode?> = total<?=$order->productCode?> * (discount<?=$order->productCode?>/parseFloat("100")); //15000 * .1   
  var total<?=$order->productCode?> = total<?=$order->productCode?> - discount<?=$order->productCode?>;
  var displaydiscount<?=$order->productCode?> =  parseFloat($('#discount<?=$order->productCode?>').val());
  $('#amount<?=$order->productCode?>').val(total<?=$order->productCode?>);
  var gross_amount = total<?=$order->productCode?> + gross_amount;
   $.post('<?php echo base_url();?>index.php/ajax/username_taken/<?=$order->productCode?>',
      { 'quantityOrdered':qty<?=$order->productCode?>,
        'discount':displaydiscount<?=$order->productCode?>,
        'msrp':msrp<?=$order->productCode?>,
        'total':total<?=$order->productCode?>,
        'orderNumber':<?=$invoice['orderNumber']?> },

      // when the Web server responds to the request
      function(result) {
        // clear any message that may have already been written
        $('#updateqty<?=$order->productCode?>').replaceWith('Database updated');
        
        // if the result is TRUE write a message to the page
        if (!result) {
          $('#quantityOrdered<?=$order->productCode?>').after('<div id="updateqty<?=$order->productCode?>" style="color:red;">' +
            '<p>(Not able to update Quantity in Stock please try again)</p></div>');
        }
      }
    );
  <?php endforeach; ?>
  var gross_amount_discount = gross_amount * (gross_amount_discount/parseFloat("100"));
  var gross_amount = gross_amount - gross_amount_discount; 
   $('#gross_amount').val(gross_amount); 

}
<?php  foreach($temporder as $order): ?>
$("#MSRP<?=$order->productCode?>, #quantityOrdered<?=$order->productCode?>, #discount<?=$order->productCode?>" ).change(function() {
 compute();
 computeamountdue();
});
 <?php endforeach; ?>

$("#gross_amount_discount" ).change(function() {
 compute();
 computeamountdue();
});
function computeamountdue() {
  var amount_paid = parseFloat($('#amount_paid').val()); 
  var gross_amount =  parseFloat($('#gross_amount').val());
  var amount_due = gross_amount - amount_paid;
  $("#amount_due").val(amount_due);
  }
  $("#amount_paid" ).change(function() {
 computeamountdue();
});
</script>
