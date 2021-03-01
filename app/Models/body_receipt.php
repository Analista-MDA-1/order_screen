<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class body_receipt extends Model {
    use HasFactory;
    protected $fillable = [
  	  'id',
      'ref_id_header',
      'id_line_item',
      'item_id',
      'item_name',
      'quantity',
      'price',
      'line_note',
  	];
}