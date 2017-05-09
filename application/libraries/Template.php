<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Template
{
		var $template_data = array();

		/*
			set path Template utama.
			------------------------
			Bisa diset ketika proses $this->template->render('path template utama','path konten','data view (optional)', return(bool));

			Jika ingin memanggil template yg berbeda, set parameter $view sama dengan path template utama
			ie: $this->template->render('login','login');
		*/
		protected $template = 'template/template';
		protected $js_url = '';
		protected $css_url 	= '';

		function set($name, $value){
			$this->template_data[$name] = $value;
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
			$template 	= lokasi template utama, isi NULL jika sudah dikonfigurasi di bagian atas script ini 
			$view 			= lokasi 'contents' view
		*/
    function render($template='', $view='', $view_data = array(), $return=FALSE){
    	$this->CI =& get_instance();
    	$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
    	if ($template == '' || $template == NULL) {
    	  	return $this->CI->load->view($this->template, $this->template_data, $return);
	  	} else {
	  		return $this->CI->load->view($template, $this->template_data, $return);
	  	}
    }
}
?>
