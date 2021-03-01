<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\header_receipt; 
use App\Models\body_receipt; 

use Illuminate\Support\Facades\Http;
 
class webhook extends Controller {

	public function store(request $data) { 
		$name_employeer = Http::withHeaders([
  			'Authorization' => config('app.tkn_lovyverse'),
		])->get(config('app.tkn_url').'/employees/'.$data['employee_id']); 
		$name_customers = Http::withHeaders([
  			'Authorization' => config('app.tkn_lovyverse'),
		])->get(config('app.tkn_url').'/customers/'.$data['customer_id']); 
		/*$items = []; 
		
		return $items;*/
		$data = $data['receipts'];
		$header = header_receipt::create($data->only('receipt_number','receipt_type','receipt_date','store_id','total_tax','total_money','total_discount','note','pos_device_id')); 
		$id_header  = $header->id;
		$header = header_receipt::find($header->id)->update(
		[
			'employee_id' => $name_employeer['name'],
			'customer_id' => $name_customers['name']
		]);
		foreach ($data['line_items'] as $key => $item) {
			$body = body_receipt::create([
				'ref_id_header' => $id_header,
				'item_id' => $item['item_id'],
				'item_name' => $item['item_name'],
				'quantity' => $item['quantity'],
				'price' => $item['price'],
				'line_note' => $item['line_note'],
			]);
		}
		return count($data['line_items']);
		//$receipt = header_receipt::create($data->only('receipt_number','receipt_type','receipt_date','employee_id','customer_id','total_tax','total_money','total_discount','note','store_id','pos_device_id'));*/
	}
}
