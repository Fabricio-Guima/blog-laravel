<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    private $repository;

     public function __construct(Product $product)
      {
          $this->repository = $product;
          $this->middleware('can:products');
          
      }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();

        return view('admin.pages.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
        //['products' => $products]
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $this->repository->create($data);

        return redirect()->route('products.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        
         return view('admin.pages.products.show',['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.products.edit',['product' => $product]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
         if(!$product = $this->repository->find($id)){
             dd('to aqui');
            return redirect()->back();
        }


        $data = $request->all();
        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {

            if(Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }
        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }

      
        if(Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
      
    }

     /**
     * Search
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $searchs = $request->only('search');
        // usei use para eu consegui acessar $request dentro da função e sem isso não vai funcionar
         $products = $this->repository->where(function($query) use ($request){
            if($request->search) {
                $query->orWhere('description', 'LIKE', "%{$request->search}%")->orWhere('name', "{$request->search}");
                //uso o like para ver se a informação está contida na cadeia de caracteres
            }           

         })->latest()->paginate();

         //passo esse search para a paginação funcionar
        return view('admin.pages.products.index', ['products' => $products,'searchs' => $searchs]); 

        }
}
