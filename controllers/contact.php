<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/*

	Usage:
	Edit the protected variables at start of class.
	If headerView/footerView is null it won't 
	load those views. Assuming you keep your header
	and footer in /views/template/ it will work
	with the defaults.

	There is no ip logging, no captcha. 

	Just a simple form :)

	Just go to site_url("contact") and it should
	work out of the box. 



 */
class Contact extends CI_Controller {


	// settings
	protected 	$sendEmailTo 		= 	'sendto@example.com';
	protected	$subjectLine 		= 	""; // actually set on line 39.
	
	// views
	protected 	$formView			= 	'contact';
	protected	$successView		= 	'contact_success';
	protected 	$headerView 		= 	'template/header'; //null to disable
	protected 	$footerView 		= 	'template/footer'; //null to disable

	// spam protection
	protected	$spam_protection	= 	true; // true or false
	protected 	$spam_question		=	'What color is a blue snake';
	protected	$spam_answer		= 	'blue';

	// other
	public 		$data 				= 	array(); // used for the views




	public function index() {

		$this->data['show_spam_protection'] = $this->spam_protection; // used in the view
		$this->data['spam_question'] = $this->spam_question; // used in the view

		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->subjectLine = "Contact form response from " . $_SERVER['HTTP_HOST'];
		$this->form_validation->set_rules('name', 'Your name', 'trim|required');
		$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

		if ($this->spam_protection) {
			$this->form_validation->set_rules('spam_protection', 'Spam Protection', 'callback_spam_protection');
		}

		if($this->form_validation->run() == FALSE) {
			// show the form
			
			if ($this->headerView) { $this->load->view($this->headerView,$this->data); }
			$this->load->view($this->formView,$this->data);
			if ($this->footerView) { $this->load->view($this->footerView,$this->data); }

		} else {
			// success! email it, assume it sent, then show contact success view.
			
			$this->load->library('email');
			$this->email->from($this->input->post('email'), $this->input->post('name'));
			$this->email->to($this->sendEmailTo);
			$this->email->subject($this->subjectLine);
			$this->email->message($this->input->post('message'));
			$this->email->send();

			if ($this->headerView) { $this->load->view($this->headerView,$this->data); }
			$this->load->view($this->successView,$this->data);
			if ($this->footerView) { $this->load->view($this->footerView,$this->data); }

		}
	}




	// the callback for checking the spam protection. Only one question/one answer, very basic.
	protected function spam_protection($str)
	{
		// we will assume the user is lazy with their caps lock
		if (strtolower(trim($str)) == strtolower(trim($this->spam_answer)))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('spam_protection', 'The %s field did not match the correct answer');
			return FALSE;
		}
	}




}

