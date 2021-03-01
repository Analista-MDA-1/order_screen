<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\header_receipt; 
use App\Models\body_receipt; 

use Illuminate\Support\Facades\Http;
 
class main extends Controller {

	public function show() { 
		$headers_id = header_receipt::select('id')->where('status',3)->take(12)->get();
		$headers = header_receipt::where('status',3)->take(12)->get();
		$array_id = [];
		foreach ($headers_id as $key => $id) {
			$array_id[$key] = $id['id'];
		}
		$body = body_receipt::wherein('ref_id_header',$array_id)->get(); 
		$module = ceil((count($headers)/3));
		$max = count($headers);
		$datos = [
			'headers' => $headers,
			'body' => $body,
			'modulo' => $module,
			'max' => $max,
			'arrays' => $array_id
		];
		return view('main')->with('data',$datos);
	}
}
