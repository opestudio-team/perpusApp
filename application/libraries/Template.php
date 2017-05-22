<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Template
{
	var $template_data = '';

	protected $template = 'template/template';

	/*
	set template utama
	------------------
	Gunakan fungsi main ini untuk set template utama jika template yang kamu Gunakan
	dipecah menjadi beberapa bagian. Jika hanya menggunakan 1 template utuh, cukup
	panggil template menggunakan render()
	*/
	function main($main){
		$this->template = $main;
	}

	function set($dataset){
		$this->template_data = $dataset;
	}

	/*
	Gunakan fungsi ini untuk menambah Assets javascript di halaman yg berbeda
	*/
	function set_js($js_url){
		$this->template_data['javascript'] = base_url().$js_url;
	}

	/*
	Gunakan fungsi ini untuk menambah Assets CSS di halaman yg berbeda
	*/
	function set_css($css_url){
		$this->template_data['css'] = base_url().$css_url;
	}

	/*
	fungsi render() ini harus dipanggil diurutan terakhir ketika hendak load view
	menggunakan library ini.

	$view = nama 'contents' view.
	Harap sesuaikan di mana letak view yang akan dipanggil
	*/
	function render($view='', $return=FALSE){
		$this->CI =& get_instance();

		$this->set(
			$this->template_data += array(
				'contents'=> $this->CI->load->view($view, $this->template_data, TRUE)
			)
		);

		if ($this->template == '' || $this->template == NULL) {
			return $this->CI->load->view(
				$view,
				$this->template_data,
				$return
			);
		} else {
			return $this->CI->load->view(
				$this->template,
				$this->template_data,
				$return
			);
		}
	}
}
?>
