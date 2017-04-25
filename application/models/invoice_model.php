<?php
class invoice_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function get_invoice($invoiceNumber = FALSE)
{
	if ($invoiceNumber === FALSE)
	{
		$query = $this->db->get('invoices');
		return $query->result_array();
	}
	$this->db->select('*'); 
	$this->db->from('invoices');
	$this->db->join('customers', 'invoices.customerNumber = customers.customerNumber');
	$this->db->where('invoices.invoiceNumber', $invoiceNumber);
	$query = $this->db->get();
	return $query->row_array();;
}
public function get_order_details($orderNumber)
{
	
	$this->db->select('*'); 
	$this->db->from('orderdetails');
	$this->db->join('products', 'orderdetails.productCode = products.productCode');
	$this->db->where('orderdetails.orderNumber', $orderNumber);
$query = $this->db->get();
	return $query->result();
}
public function set_invoice()
{
	$this->load->helper('url');
	$query = $this->db->get_where('invoices', array('orderNumber' =>  $this->input->post('orderNumber'))); 
           
            $count= $query->num_rows();    //counting result from query

        if ($count === 0)
        {  $query = $this->db->get_where('orderdetails', array('orderNumber' => $this->input->post('orderNumber')));
    $totalAmount = 0;
    foreach($query->result() as $row) {
    	$productCode = $row->productCode;
    	$quantityOrdered = $row->quantityOrdered;
    	$priceEach = $row->priceEach;
    	$totalAmount = $totalAmount + $quantityOrdered * $priceEach;
     } 
	$query = $this->db->get_where('job_order', array('orderNumber' => $this->input->post('orderNumber')));
    foreach($query->result() as $row) {
    	$customerNumber = $row->customerNumber;
     } 
	$data = array(
		'orderNumber' => $this->input->post('orderNumber'),
		'customerNumber' => $customerNumber,
		'invoiceDate' => date('Y-m-d H:i:s'),
		'initiatedBy' => '2',
		'totalAmount' => $totalAmount,
		'invoiceComment' => $this->input->post('invoiceComment')
	);

	return $this->db->insert('invoices', $data);
            
            }
	else {
	  echo"Invoice Already exist in database";
	}
}
public function get_invoice_number($orderNumber) {
$sql = "SELECT invoiceNumber FROM invoices WHERE orderNumber = $orderNumber"; 
	return $this->db->query($sql)->row()->invoiceNumber;
}
public function update_invoice($invoiceNumber)
{
	$data['totalAmount'] = $this->input->post('gross_amount');	
	$data['amount_paid'] = $this->input->post('amount_paid');
	$data['amount_due'] = $this->input->post('amount_due');
	$data['totalDiscount'] = $this->input->post('gross_amount_discount');
	$this->db->where('invoiceNumber', $this->input->post('invoiceNumber'));
	$query = $this->db->update('invoices', $data); 
	$order_details = $this->get_order_details($this->input->post('orderNumber'));
	$postproductname = $this->input->post('productName');
	$postproductquantity = $this->input->post('quantityOrdered');
	$postproductdiscount = $this->input->post('discount');
	$postproductamount = $this->input->post('amount');
	$postproductpriceeach = $this->input->post('MSRP');
	$postordernumber = $this->input->post('orderNumber');
	foreach ($this->input->post('productName') as $key=>$v) {
	$sql =	"UPDATE  `automobile`.`orderdetails` SET  `quantityOrdered` =  '$postproductquantity[$key]',
`priceEach` =  '$postproductpriceeach[$key]',
`discount` =  '$postproductdiscount[$key]',
`amount` =  '$postproductamount[$key]'
 WHERE  `orderdetails`.`orderNumber` = $postordernumber AND  `orderdetails`.`productCode` =  '$key';";
	$success = $this->db->query($sql);	
	
	}	
}
function loadorders()
{       
    $this->db->select('orderNumber'); 
	$this->db->from('job_order');
	$query = $this->db->get();
	return $query->result();
}
}