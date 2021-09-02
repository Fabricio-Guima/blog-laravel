<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Requests\StoreUpdatePermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    protected $repository;


    public function __construct(Permission $permission)
    {
        $this->repository = $permission;

        $this->middleware('can:permissions');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->repository->paginate();

        return view('admin.pages.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->except('_token'));

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->repository->find($id);

        if(!$permission) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.show', ['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->repository->find($id);

        if(!$permission) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePermission $request, $id)
    {
        $permission = $this->repository->find($id);

        if(!$permission) {
            return redirect()->back();
        }

        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->repository->find($id);

        if(!$permission) {
            return redirect()->back();
        }
         $permission->delete();

        return redirect()->route('permissions.index');
    }

     public function search(Request $request)
    {

        $searchs = $request->only('search');
        // usei use para eu consegui acessar $request dentro da função e sem isso não vai funcionar
         $permissions = $this->repository->where(function($query) use ($request){
            if($request->search) {
                $query->where('name', 'LIKE', "%{$request->search}%")->orWhere('description', 'LIKE', "%{$request->search}%");
                //uso o like para ver se a informação está contida na cadeia de caracteres
            }           

         })->paginate();

         //passo esse search para a paginação funcionar
        return view('admin.pages.permissions.index', ['permissions' => $permissions,'searchs' => $searchs]); 

        }
}
