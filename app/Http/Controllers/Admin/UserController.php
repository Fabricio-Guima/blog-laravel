<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
      protected $repository;


    public function __construct(User $user)
    {
        $this->repository = $user;

        $this->middleware('can:users');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser  $request)
    {
      
        //pega o user logado e seu tenant_id        
        //$tenant =  auth()->user()->tenant;
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);
               
             
        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->tenantUser()->find($id);

       

        if(!$user) {
            return redirect()->back();
        }

         return view('admin.pages.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->tenantUser()->find($id);

        
        if(!$user) {
            return redirect()->back();
        }
        
      
        return view('admin.pages.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        //->tenantUser() significa que esse usuario tem que está vinculado ao user pai
        $user = $this->repository->tenantUser()->find($id);

        if(!$user) {
            return redirect()->back();
        }

        $data = $request->only(['name', 'email']);

        if($request->password) {
            $data['password'] = bcrypt($request->password);

        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->repository->tenantUser()->find($id);

        if(!$profile) {
            return redirect()->back();
        }
         $profile->delete();

        return redirect()->route('users.index');
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
         $users = $this->repository->where(function($query) use ($request){
            if($request->search) {
                $query->orWhere('name', 'LIKE', "%{$request->search}%")->orWhere('email', "{$request->search}");
                //uso o like para ver se a informação está contida na cadeia de caracteres
            }           

         })->latest()->tenantUser()->paginate();

         //passo esse search para a paginação funcionar
        return view('admin.pages.users.index', ['users' => $users,'searchs' => $searchs]); 

        }
}
