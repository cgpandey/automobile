<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('invoice_model');
	}
  public function username_taken($productCode)
  {
  	$this->db->select('quantityOrdered')->from('orderdetails')->where('productCode', $productCode);
	$query = $this->db->get();
	foreach ($query->result() as $row)
	{
    $quantityOrdered =  $row->quantityOrdered;
	}
	$this->db->select('quantityInStock')->from('products')->where('productCode', $productCode);
	$query = $this->db->get();
	foreach ($query->result() as $row)
	{
    $quantityInStock =  $row->quantityInStock;
	}
	$post_quantityOrdered = $this->input->post('quantityOrdered');
	$post_discount = $this->input->post('discount');
	$post_amount = $this->input->post('total');
	$post_priceEach = $this->input->post('msrp');
	$orderNumber = $this->input->post('orderNumber');
	$change_in_quantity = $post_quantityOrdered - $quantityOrdered;
	
	$updatedQuantityInStock = $quantityInStock - $change_in_quantity;
	$user_logs_update = array(
        "productCode" => $productCode,
        "quantityInStock" => $updatedQuantityInStock
    );
 	$orderdetails_logs_update = array(
        "productCode" => $productCode,
        "quantityOrdered" => $post_quantityOrdered,
        "priceEach" => $post_priceEach,
        "amount" => $post_amount,
        "discount" => $post_discount,
        "orderNumber" => $orderNumber
    );
    $this->db->update('products',$user_logs_update,array('productCode' => $productCode));
 
    $this->db->update('orderdetails',$orderdetails_logs_update,array('productCode' => $productCode,'orderNumber' => $orderNumber ));
   echo '1';
    
}
}
