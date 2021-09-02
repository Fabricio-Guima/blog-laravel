<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Profile;

class PermissionProfileController extends Controller
{

    protected $profile, $permission;


    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;

        $this->middleware('can:profiles');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //pega todas as permissoes vinculadas a um profile (perfil)
    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if(!$profile) {
            return redirect()->back();
        }

         $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', ['profile' => $profile,'permissions' => $permissions]);

    }

      public function profiles($idPermission)
    {
       
        $permission = $this->permission->find($idPermission);

        
        
        if(!$permission) {
            return redirect()->back();
        }
        
        $profiles = $permission->profiles()->paginate();
    //    dd($profiles);

        return view('admin.pages.permissions.profiles.profiles', ['profiles' => $profiles,'permission' => $permission]);

    }


    public function permissionsAvailable(Request $request, $idProfile){

               

        $profile = $this->profile->find($idProfile);

        if(!$profile) {
            return redirect()->back();
        }

        $searchs = $request->except('_token');
        

        //to pegando todas as permissoes que nao estão vinculadas(ainda) ao profile 
        $permissions = $profile->permissionsAvailable($request->search);

         return view('admin.pages.profiles.permissions.available', ['profile' => $profile,'permissions' => $permissions]);

    }

     public function attachPermissionsProfile(Request $request, $idProfile){
       

        $profile = $this->profile->find($idProfile);

        if(!$profile) {
            return redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) === 0) {
              return redirect()->back()->with('danger', 'Precisa escolher ao menos uma permissão');

        }

       

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);

    }

    public function detachPermissionsProfile($idProfile,$idPermission) {

        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$profile || !$permission) {
            return redirect()->back();
        }

         $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id);

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
