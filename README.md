codeigniter-contact-form
========================

Basic contact form controller and views (contact form and success message) for CodeIgniter. 



	Usage:
	Edit the protected variables at start of class.
	If headerView/footerView is null it won't 
	load those views. Assuming you keep your header
	and footer in /views/template/ it will work
	with the defaults.

	There is no ip logging, basic spam protection 
	(in form of question/answer - easiest for humans
	but also easiest for spammers!). 

	Just a simple form :)

	Just go to site_url("contact") (i.e. http://domain.com/index.php/contact
	 and it should	work out of the box. 


	$this->data is used for any data sent to the views.
 	It isn't used here, but I tend to use that pattern
	with my template files so just included it here.
