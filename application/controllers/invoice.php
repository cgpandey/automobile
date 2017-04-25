<?php
class Invoice extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('invoice_model');
	}

	public function index()
	{
		$data['invoice'] = $this->invoice_model->get_invoice();
		$data['title'] = 'Invoices';

	$this->load->view('invoice/header', $data);
	$this->load->view('invoice/index', $data);
	$this->load->view('invoice/footer');
	}

	public function view($invoiceNumber)
	{
	$data['invoice'] = $this->invoice_model->get_invoice($invoiceNumber);

	if (empty($data['invoice']))
	{
		show_404();
	}

	$data['title'] = $data['invoice']['invoiceComment'];

	$this->load->view('templates/header', $data);
	$this->load->view('invoice/view', $data);
	$this->load->view('templates/footer');
}
public function generate()
{
	$this->load->helper('form');
	$this->load->library('form_validation');

	$data['title'] = 'Generate Invoice';
	$data['orders'] = $this->invoice_model->loadorders();
	$this->form_validation->set_rules('orderNumber', 'Order Number', 'required');
	
	if ($this->form_validation->run() === FALSE)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('invoice/generate');
		$this->load->view('templates/footer');

	}
	else
	{
		$this->invoice_model->set_invoice();
		$invoiceNumber = $this->invoice_model->get_invoice_number($this->input->post('orderNumber'));
		$data['invoice'] = $this->invoice_model->get_invoice($invoiceNumber);
		$orderNumber = $data['invoice']['orderNumber'];
		$data['order'] = $this->invoice_model->get_order_details($orderNumber);

	if (empty($data['invoice']))
	{
		show_404();
	}

	$data['title'] = 'Service Center';
	$this->load->view('templates/header', $data);
	$this->load->view('invoice/success', $data);
	$this->load->view('templates/footer');
	}
}
public function printinvoice()
	{
		$this->invoice_model->update_invoice($this->input->post('invoiceNumber'));
		$data['invoice'] = $this->invoice_model->get_invoice($this->input->post('invoiceNumber'));
		$orderNumber = $data['invoice']['orderNumber'];
		$data['order'] = $this->invoice_model->get_order_details($orderNumber);

	if (empty($data['invoice']))
	{
		show_404();
	}

	$data['title'] = 'Service Center';
	$this->load->view('templates/header', $data);
	$this->load->view('invoice/print', $data);
	$this->load->view('templates/footer');
	}

}