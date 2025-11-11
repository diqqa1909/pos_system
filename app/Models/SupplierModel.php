<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Request;

    class SupplierModel extends Model{
        use HasFactory;

        protected $table = 'suppliers';

        static public function getRecord(){
            $return = self::select('suppliers.*');

            //search
            if(!empty(Request::get('id'))){
                $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('supplier_name'))){
                $return = $return->where('supplier_name', 'like', '%'.Request::get('supplier_name').'%');
            }
            if(!empty(Request::get('supplier_telephone'))){
                $return = $return->where('supplier_telephone', 'like', '%'.Request::get('supplier_telephone').'%');
            }
            if(!empty(Request::get('supplier_address'))){
                $return = $return->where('supplier_address', 'like', '%'.Request::get('supplier_address').'%');
            }
            if(!empty(Request::get('created_at'))){
                $return = $return->where('created_at', 'like', '%'.Request::get('created_at').'%');
            }
            if(!empty(Request::get('updated_at'))){
                $return = $return->where('updated_at', 'like', '%'.Request::get('updated_at').'%');
            }

            $return = $return->orderBy('id', 'asc')->paginate(2);
                return $return;
        }
    }
