<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class header_receipt extends Model {
    use HasFactory;
    protected $fillable = [
  	  'id',
      'receipt_number',
      'receipt_type',
      'receipt_date',
      'employee_id',
      'customer_id',
      'total_tax',
      'total_money',
      'total_discount',
      'note',
      'store_id',
      'pos_device_id',
      'status'
  	];
}