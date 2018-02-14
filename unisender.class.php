<?php
class Unisender
{
	protected $apikey = '';
	protected $apiurl = 'https://api.unisender.com/ru/api/';
	protected $lastrequest = 'No result';
	function __construct($key) {
		$this->apikey=$key;
	}
	function request($r) {
		$this->lastrequest=$r;
		if($curl = curl_init()) {
			curl_setopt($curl, CURLOPT_URL, $r);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 6);
			curl_setopt($curl, CURLOPT_ENCODING, 'utf8');
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLINFO_HEADER_OUT, false);
			$a = curl_exec($curl);
			curl_close($curl);
			return $a;
		} else {
			return ['error' => 'cant find curl on your system'];
		}
	}
	function getlast() {
		return $this->lastrequest;
	}
	function r_quest($m, $pams = []) {
		$r=$this->apiurl.$m."?format=json&request_compression=bzip2&api_key=".$this->apikey;
		if(!empty($pams)) {
			foreach ($pams as $key => $value) {
				$r.='&'.$key.'='.urlencode($value);
			}
		}
		return json_decode($this->request($r));
	}
	function getLists() {
		return $this->r_quest('getLists');
	}
	function subscribe($list_ids, $pams = []) {
		foreach ($pams as $key => $value) {
			$pams['fields['.$key.']'] = $value;
			unset($pams[$key]);
		}
		$pams['list_ids']=$list_ids;
		return $this->r_quest('subscribe',$pams);
	}
	function import($listids,$pams) {
		if(count($pams) > 3) return false;

		if(count($pams) == 2) {
			foreach ($pams as $key => $value) {
				$pams['data[0]['.$key.']'] = $value;
				unset($pams[$key]);
			}
			$pams['field_names[0]'] = 'Name';
			$pams['field_names[1]'] = 'email';
			$pams['field_names[2]'] = 'email_list_ids';
			$pams['data[0][2]'] = $listids;
			return $this->r_quest('importContacts',$pams);
		}
		
		foreach ($pams as $key => $value) {
			$pams['data[0]['.$key.']'] = $value;
			unset($pams[$key]);
		}
		$pams['field_names[0]'] = 'Name';
		$pams['field_names[1]'] = 'email';
		$pams['field_names[2]'] = 'phone';
		$pams['field_names[3]'] = 'email_list_ids';
		$pams['data[0][3]'] = $listids;
		return $this->r_quest('importContacts',$pams);
	}
}