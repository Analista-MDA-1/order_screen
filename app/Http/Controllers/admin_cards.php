<?php

namespace App\Http\Controllers;
 
use App\Clases\websockets;
use Illuminate\Http\Request;
use App\Models\header_receipt; 
use App\Models\body_receipt; 

class admin_cards extends Controller  {

	private $id;private $header;private $body;
	public function admin(request $data) { 
		$this->id = $data['id'];
		$this->get_data();
		if ( isset($data['show']) ) {
			return $this->to_pdf();
		}
		else if ( isset($data['check']) ) {
			return $this->check();
		}
	}
	private function get_data() {
		$this->header = header_receipt::where('id',$this->id)->first();
		$this->body = body_receipt::where('ref_id_header',$this->id)->get(); 
	}
	private function to_pdf() { 
		$datos  = [
			'header' => $this->header,
			'body' => $this->body,
		];
		$pdf_generar_cuenta = \PDF::loadView('invoice', compact('datos'));
		$datos_pdf_cuenta = [
			'factura' => $pdf_generar_cuenta,
			'nombre' => 'Factura No. ' . $this->header->receipt_number . '.pdf',
		];
		return $datos_pdf_cuenta['factura']->setPaper('letter', 'landscape')->stream($datos_pdf_cuenta['nombre'], array("Attachment" => false));
	}
	private function check() { 
		$temp = header_receipt::where('id',$this->header->id)->update([
			'status' => 2
		]);
		if ($temp) {
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors('No se Checkear');
		}
	}
}
