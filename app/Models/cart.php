<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Http\Request;

class cart extends BaseModel
{
    protected $table = 'carts';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
        'id',
        
        'product_code',
        'user_code',
        
        'amount',
        'size',
        'color',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function __construct()
    {
        $this->fillable_list = $this->fillable;         // trường fillable sẽ truyền vào biến fillable_list
    }

    public function base_update(Request $request)
    {
        // $filter_param = $request->only($this->$fillable);
        $this->update_conditions = [
            'id' => 1
        ];
        return parent::base_update($this->request);
    }
    public function product(){
        return $this->hasMany('App\Models\product','code','product_code');
    }
}
