<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\type;
use App\Models\producer;
use App\Models\distributor;
use DB;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller {
	
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()	{
        //$data = product::all();
        $data = DB::table('products')->orderBy('id','desc')->paginate(5);

        
    	return view('admin.product.index',['data'=>$data]);
    }

    public function getAddProduct(){
    	
    	$types = type::all();
        $producers = producer::all();
        $distributors = distributor::all();

    	return view('admin.product.getadd',['types'=>$types,'producers'=>$producers,'distributors'=>$distributors]);
    }

    public function postAddProduct(Request $request) {
        
        if ($request->hasFile('images')){
            $this->addImg($request->images);
        }
        $insert = $request;
        $insert['image'] = json_encode($this->nameImgs);
        $insert['color'] = json_encode($request->colors);
        $insert['size'] = json_encode($request->size);
        $insert['code'] = Str::random(5);
        if (isset($request->nam)){
            $insert['nam'] = 1;
        } else 
            $insert['nam'] = 0;

        if (isset($request->nu)){
            $insert['nu'] = 1;
        } else 
            $insert['nu'] = 0;

    	$config = [
    		'model' => new product(),
    	];
    	$this->config($config);

    	$data = $this->model->web_insert($insert);
    	return back()->with('success','Thêm thanh công!!');
    }

    // detail
    public function detail(Request $request) {

        $id = $request->id;

        $product = product::find($id);
        $types = type::all();
        $producers = producer::all();
        $distributors = distributor::all();
        
        $colorOrigins = collect(['Black','White','Blue','Green','Red','Pink']);

        $diff = $colorOrigins->diff(json_decode($product->color));

        $sizeOrigins = collect(['36','37','38','39','40','41','42']);

        $sizeDiff = $sizeOrigins->diff(json_decode($product->size));
        //return $diff->all();
        //$colorDiff = $diff;

        return view('admin.product.detail',['data'=>$product,'colors'=>json_decode($product->color),'colorDiff'=>$diff->all(),'types'=>$types,'distributors'=>$distributors,'producers'=>$producers,'sizeDiff'=>$sizeDiff,'sizes'=>json_decode($product->size)]);
    }

    public function deleteProduct(Request $request) {
        $id = $request->id;
        $product = product::find($id);
        $product->delete();

        $data = product::all();
        return view('admin.product.dataUpdateContent',['data'=>$data,'mess'=>'Xoa Thanh Cong!']);
    }

    // Function edit
    public function editProduct(Request $request) {
        
        if ($request->hasFile('images')){
            $this->addImg($request->file('images'));
            $imageNews = $this->nameImgs;
        } 
        
        $ProductId = $request->id;

        // array color delete and add

        $colorDels = $request->colorDels;
        $colorAdds = $request->colorAdds;

        $product = product::find($ProductId);

        // array color Origin
        $colorOrigins = json_decode($product->color);

        // delete element duplicate
        if (!empty($colorDels)){
            // only 1 color of colorDels
            if (count($colorDels) == count($colorOrigins)){
                //return count($colorDels);
                $colors = [];

            } else {
                foreach ($colorDels as $colorDel)
                    foreach ($colorOrigins as $index => $colorOrigin)
                        if ($colorDel == $colorOrigin)
                            unset($colorOrigins[$index]);
                $colors = $colorOrigins;
            }
        }
        // merge 2 array color
        if (!empty($colorAdds))
            $colors = collect($colorAdds)->merge($colorOrigins);
        
        //{ $name, $code } = $request;
        $product->code = $request->code ? $request->code : $product->code;
        $product->name = $request->name ? $request->name : $product->name;
        $product->type_code = $request->type_code ? $request->type_code : $product->type_code;

        $product->price = $request->price ? $request->price : $product->price;
        $product->amount = $request->amount ? $request->amount : $product->amount;
        $product->description = $request->description ? $request->description : $product->description;
        $product->color = isset($colors) ? $colors : $product->color;

        // edit image
        $imageDels = json_decode(Storage::get('public/imageDels.txt'));
        if (!empty($imageDels)){
            foreach ($imageDels as $img){
               File::delete(public_path('img/products').'/'.$img);
            }
            Storage::put('public/imageDels.txt','');
            $imageRemain = Storage::get('public/imageRemain.txt');
            $product->image = $imageRemain;
            Storage::put('public/imageRemain.txt','');
    
        }
        // add new image
        if (!empty($imageNews)){
            $images = json_decode($product->image);
            foreach ($imageNews as $img){
                $images[] = $img;
            }
            $product->image = $images;
        }                
        $product->save();
        return back()->with('success','Sửa thành công!');
    }

    //edit image detail
    public function editImage(Request $request) {
        $idProduct = $request->id;
        $image = $request->Image;
        $product = product::find($idProduct);
        $imageOrigins = json_decode($product->image);
        // xu ly nut huy
        if ($image == 'null'){
            if (Storage::exists('public/imageDels.txt')) {
                //Storage::delete('public/imageDels.txt');
                Storage::put('public/imageDels.txt','');
                Storage::put('public/imageRemain.txt','');
            }
            $newImages = json_decode($product->image);
            // $newImages = collect(json_decode($CarDetail->image))->map(function($img){
            //     return asset('/img/cardetail').'/'.$img;
            // });

            return view('admin.product.dataImage',['data'=>$product,'Images'=>$newImages]);
        }
        // end xu ly nut huy

        // array image delete
        $imageDels = json_decode(Storage::get('public/imageDels.txt'));
        $imageDels[] = $image;
        Storage::put('public/imageDels.txt',json_encode($imageDels));

        //array image remain
        $imageRemain=[];
        $collection = collect($imageOrigins)->diff($imageDels)->toArray();

        foreach($collection as $collect){
            $imageRemain[] = $collect;
        }
        Storage::put('public/imageRemain.txt',json_encode($imageRemain));

        // array remain only 1 image
        if (count($imageDels)==count($imageOrigins)){
            Storage::put('public/imageRemain.txt','');
        }

        $imageRemain = json_decode(Storage::get('public/imageRemain.txt'));
        
        return view('admin.product.dataImage',['data'=>$product,'Images'=>$imageRemain]);

        // return $imageOrigins;
    }

     // Function reset Image Delete
    public function resetImageDel(){
        if (Storage::exists('public/imageDels.txt')) {
            //Storage::deleteDirectory('public/imageDels.txt');
            //Storage::delete('public/imageDels.txt');
            Storage::put('public/imageDels.txt','');
            Storage::put('public/imageRemain.txt','');
            return true;
        } 
        
    }
}
