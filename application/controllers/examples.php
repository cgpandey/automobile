<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('grocery_CRUD');	
	}

	public function _example_output($output = null)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id'] = $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('templates/header.php',$output);
			$this->load->view('templates/mainpage.php',$output);
			$this->load->view('templates/footer.php',$output);
		 }	
	}
	public function _dbpage_output($output = null)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id'] = $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('templates/header.php',$output);
			$this->load->view('templates/dbpage.php',$output);
			$this->load->view('templates/footer.php',$output);
		 }	
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
			
			$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
				
	}
	public function vehicles_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','customerName');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('vehicles');
			$crud->set_subject('Vehicle');
			$crud->required_fields('regn_no');
			$output = $crud->render();
			$this->_dbpage_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
public function invoices_management()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_table('invoices');
			$crud->set_subject('Invoice');
			$crud->required_fields('customerNumber');
			$output = $crud->render();
			$this->_dbpage_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function employees_management()
	{
			$crud = new grocery_CRUD();
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');
			$crud->required_fields('firstName');
			$crud->set_field_upload('file_url','assets/uploads/files');
			$output = $crud->render();

			$this->_dbpage_output($output);
	}

	public function customers_management()
	{
			$crud = new grocery_CRUD();
			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','Salesman')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

			$output = $crud->render();

			$this->_dbpage_output($output);
	}

	public function vendors_management()
	{
			$crud = new grocery_CRUD();
			$crud->set_table('vendors');
			$crud->set_subject('Vendor');
			$output = $crud->render();
			$this->_dbpage_output($output);
	}
	public function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('orderNumber','job_order','Order:{orderNumber}, Date:{job_date}');
			$crud->display_as('orderNumber','Order');
			$crud->set_relation('productCode','products','{productCode}, {productName}, Rs.{MSRP}, Avail.{quantityInStock}');
			$crud->display_as('productCode','Product');
			$crud->set_table('orderdetails');
			$crud->set_subject('Service');
			$crud->required_fields('productCode','orderNumber','quantityOrdered');
			$crud->fields('productCode','orderNumber','quantityOrdered');
			$crud->callback_after_insert(array($this, 'edit_stock_after_insert'));
			$output = $crud->render();
			$this->_dbpage_output($output);
	}
public function purchase_management()
	{
			$crud = new grocery_CRUD();
			$crud->display_as('orderNumber','Order');
			$crud->set_relation('productCode','products','{productCode} {productName} Rs.{MSRP}');
			$crud->display_as('productCode','Product');
			$crud->set_table('purchasedetails');
			$crud->set_subject('Purchase');
			$crud->required_fields('productCode','PurchaseNumber','quantityPurchased');
			$crud->callback_after_insert(array($this, 'add_stock_after_purchase'));
			$output = $crud->render();
			$this->_dbpage_output($output);
	}
 
  function edit_stock_after_insert($post_array,$primary_key)
{	
	$productCode = $post_array['productCode'];
	$query = $this->db->get_where('products', array('productCode' => $productCode));
	foreach ($query->result() as $row)
	{
    $quantityInStock =  $row->quantityInStock;
    $priceEach =  $row->MSRP;
	}
	$amount = $post_array['quantityOrdered'] * $priceEach;
	$updatedQuantityInStock = $quantityInStock - $post_array['quantityOrdered'];
	$user_logs_update = array(
        "productCode" => $post_array['productCode'],
        "quantityInStock" => $updatedQuantityInStock
    );
 	$order_add_price = array(
        "productCode" => $post_array['productCode'],
        "priceEach" => $priceEach,
        "amount" => $amount
    );
    $this->db->update('products',$user_logs_update,array('productCode' => $post_array['productCode']));
 	$this->db->update('orderdetails',$order_add_price,array('productCode' => $post_array['productCode']));
 
    return true;
}
  function add_stock_after_purchase($post_array,$primary_key)
{	
	$productCode = $post_array['productCode'];
	$this->db->select('quantityInStock')->from('products')->where('productCode', $productCode);
	$query = $this->db->get();
	foreach ($query->result() as $row)
	{
    $quantityInStock =  $row->quantityInStock;
	}
	$updatedQuantityInStock = $quantityInStock + $post_array['quantityPurchased'];
	$user_logs_update = array(
        "productCode" => $post_array['productCode'],
        "quantityInStock" => $updatedQuantityInStock
    );
 
    $this->db->update('products',$user_logs_update,array('productCode' => $post_array['productCode']));
 
    return true;
}
	public function products_management()
	{
			$crud = new grocery_CRUD();
			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));
			$crud->callback_column('MSRP',array($this,'valueToEuro'));
			$crud->set_relation('vendorNumber','vendors','vendorName');
			$crud->display_as('vendorNumber','Vendor');			
			$output = $crud->render();

			$this->_dbpage_output($output);
	}

	public function valueToEuro($value, $row)
	{
		return 'Rs. '.$value;
	}

	public function jobs_management()
	{		
			$crud = new grocery_CRUD();
			$crud->set_relation('customerNumber','customers','customerName');
			$crud->set_subject('Job Card');
			$crud->set_relation('employeeNumber','employees','{firstName} {lastName}');
			$crud->set_relation('id','users','username');
			$crud->set_relation('vehicle_id','vehicles','regn_no');
			$crud->display_as('regn_no','Vehicle Number');
			$crud->display_as('id','Supervisor Name');
			$crud->display_as('customerNumber','Customer');
			$crud->display_as('vehicle_id','Vehicle Regn. No.');
			$crud->display_as('employeeNumber','Mechanic');
	    	$crud->set_table('job_order');
			$crud->unset_columns('supervisor_comment','fuel_condition','hhpp');
			$output = $crud->render();
			$this->_dbpage_output($output);
	}

}