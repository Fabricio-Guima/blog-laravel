<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $profile, $permission;


    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;

        $this->middleware('can:products');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //pega todas as permissoes vinculadas a um profile (perfil)
    public function categories($idProduct)
    {
        $product = $this->product->find($idProduct);

        if(!$product) {
            return redirect()->back();
        }

         $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', ['product' => $product,'categories' => $categories]);

    }

      public function products($idCategory)
    {
       
        $category = $this->category->find($idCategory);

        
        
        if(!$category) {
            return redirect()->back();
        }
        
        $products = $category->products()->paginate();
    //    dd($profiles);

        return view('admin.pages.permissions.profiles.profiles', ['category' => $category,'products' => $products]);

    }


    public function categoriesAvailable(Request $request, $idProduct){      
        

        $product = $this->product->find($idProduct);

        if(!$product) {
            return redirect()->back();
        }

        $searchs = $request->except('_token');
        

        //to pegando todas as permissoes que nao estão vinculadas(ainda) ao profile 
        $categories = $product->categoriesAvailable($request->search);

         return view('admin.pages.products.categories.available', ['product' => $product,'categories' => $categories, 'searchs' => 'searchs']);

    }

     public function attachCategoriesProduct(Request $request, $idProduct){

        $product = $this->product->find($idProduct);

        if(!$product) {
            return redirect()->back();
        }

        if(!$request->category || count($request->category) === 0) {
              return redirect()->back()->with('danger', 'Precisa escolher ao menos uma permissão');

        }
       

        $product->categories()->attach($request->category);

        return redirect()->route('products.categories', $product->id);

    }

    public function detachCategoryProduct($idProduct,$idCategory) {

        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if(!$product || !$category) {
            return redirect()->back();
        }

        $product->categories()->detach($category);

        return redirect()->route('products.categories', $product->id);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
