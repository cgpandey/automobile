<html>
<head>
<title>My Form</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('form'); ?>
<table>
<tr><th>Item Name</th><th>Item Quantity</th><th>Item Price</th><th>Total</th>
<tr><td><input type="text" name="options[]" value="" size="50" /></td></tr>
<tr><td><input type="text" name="options[]" value="" size="50" /></td></tr>
<tr><td><input type="text" name="options[]" value="" size="50" /></td></tr>
<tr><td><input type="text" name="options[]" value="" size="50" /></td></tr>
<tr><td><input type="text" name="options[]" value="" size="50" /></td></tr>
<tr><td><input type="text" name="options[]" value="" size="50" /></td></tr>

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>
