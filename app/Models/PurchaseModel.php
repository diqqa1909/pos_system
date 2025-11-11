<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class PurchaseModel extends Model
{
    use HasFactory;

    protected $table = 'purchase';

    static public function getRecords(){
    $return = self::select('purchase.*', 'suppliers.supplier_name')
        // Try these common variations:
        ->join('suppliers', 'purchase.supplier_id', '=', 'suppliers.id') 
        ->orderBy('purchase.id', 'asc');

        if (!empty(Request::get('id'))) {
            $return = $return->where('purchase.id','=',Request::get('id'));
        }
        if (!empty(Request::get('supplier_name'))) {
    $return = $return->where('suppliers.supplier_name','like', '%'.Request::get('supplier_name').'%');
}
        if (!empty(Request::get('total_item'))) {
            $return = $return->where('purchase.total_item', 'like', Request::get('total_item').'%');
        }
        if (!empty(Request::get('total_price'))) {
            $return = $return->where('purchase.total_price', Request::get('total_price'));
        }
        if (!empty(Request::get('discount'))) {
            $return = $return->where('purchase.discount', 'like', Request::get('discount').'%');
        }

    $return = $return->paginate(20);
    return $return;
}
}
