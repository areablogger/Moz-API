<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  Class Moz extends CI_Controller{
  
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
  
	protected function ambil_data ($url){
		$accessID = 'xxxxx'; // xxxx ganti dengan accesID Mozscape kamu
		$secretKey = 'xxxxx'; // xxxx ganti dengan secretKey Mozscape kamu
		$expires = time() + 300; // waktu expired
		$stringToSign = $accessID."\n".$expires;  
		$binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
		$urlSafeSignature = urlencode(base64_encode($binarySignature));
		/*-------------------------------------------------------- 
		* nilai 103616137253 pada variable $cols ini adalah
		* gabungan Bit Flag yang tersedia untuk MozScape API gratis, 
		* terkecuali fitur Time last crawled (144115188075855872)
		* jika mau include Time last crawled, maka 
		* tambahkan saja 103616137253 + 144115188075855872
		* hasil totalnya: 144115291691993125
		*---------------------------------------------------------*/
		$cols = "103616137253"; // atau 144115291691993125 untuk sertakan request Time last crawled
		$requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
		$batchedDomains = array($url);
		$encodedDomains = json_encode($batchedDomains);
		$options = array(
     		CURLOPT_RETURNTRANSFER => true,
      		CURLOPT_POSTFIELDS     => $encodedDomains
     		 );
		$ch = curl_init($requestUrl);
		curl_setopt_array($ch, $options);
		$content = curl_exec($ch);
		curl_close( $ch );
		$contents = json_decode($content);
		print_r($contents); // hasil
	}
	  
	public function grabdata(){
		$data['datamoz']  = "";
		
		if($this->input->post('submit') !== ""){	
			$url = $this->input->post('url');
			$data['datamoz'] = $this->ambil_data($url);
		}
		
		$this->load->view('main', $data);
		 
		   
	}
    
}

