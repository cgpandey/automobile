<div id="templatemo_main">
             <div class="col_w900 col_w900_last"> 
<h2>Generate Invoice</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('invoice/generate') ?>

	<label for="orderNumber">Order No</label><br>
	<select name="orderNumber" id="" >
    <?php
               foreach($orders as $orders){

    ?>
    <option value="<?=$orders->orderNumber?>"><?=$orders->orderNumber?></option>
    <?php
          
        }
    ?>
</select><br>
	<label for="invoiceComment">Invoice Comment</label><br>
	<input type="text" name="invoiceComment" />
	<input type="submit" name="submit" value="Generate Invoice" />

</form>
			</div>
<div class="cleaner"></div>

 </div> <!-- end of main -->     