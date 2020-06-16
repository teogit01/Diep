<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Http\Request;

class product extends BaseModel
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    protected $fillable = [
      	'id',
        'code',
        'name',
        'color',
        'price',
        'size',
        'nam',
        'nu',
        'amount', 
        'image',
        'description',
        'rate',

        'producer_code',
        'distributor_code',
        'type_code',
        
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

    public function type(){
        return $this->belongsTo('App\Models\type','type_code','code');
    }
    public function producer(){
        return $this->belongsTo('App\Models\producer','producer_code','code');
    }
    // public function cart(){
    //     return $this->belongsTo('App\Models\type','type_code','code');
    // }
}
