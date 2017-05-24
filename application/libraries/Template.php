<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Template
{
	var $template_data = '';

	public $template = 'template/template';

	/* set true jika ingin memakai breadcrumb */
	protected $breadcrumb = true;

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
		set breadcrumb:
			setelah '$this->template->set()' dan sebelum '$this->template->render()'
	*/
	function breadcrumb(){
		if ($this->breadcrumb) {
			$uri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$uri = htmlspecialchars( $uri, ENT_QUOTES, 'UTF-8' );
			$uri = explode('//', $uri);
			$uri = explode('/', $uri[1]);

			$str = "Dashboard ";
			for ($i=3; $i < count($uri); $i++) {
				$str .= "&rsaquo; ".ucwords($uri[$i])." ";
			}
			$this->set(
				$this->template_data += array(
					'breadcrumb' => $str
				)
			);
		}
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

		if ($this->breadcrumb) {
			$this->breadcrumb();
		}

		$this->set(
			$this->template_data += array(
				'contents' => $this->CI->load->view($view, $this->template_data, TRUE),
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
