<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->run_check('Temp/index()');
        $this->test();
	}

    public function _remap($method)
    {
        $this->load->view('header_admin');
        $this->load->view('leftmenu_admin');
        if ( method_exists($this, $method) )
        {
            $this->{"{$method}"}();
        }
        $this->load->view('footer_admin');
    }

    public function test()
    {
        $data   = array();
        $this->load->view('main_v', $data);
    }

}
