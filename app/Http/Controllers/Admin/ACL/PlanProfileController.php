<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlanProfileController extends Controller
{

    protected $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;

        $this->middleware('can:plans');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //pega todas as permissoes vinculadas a um plan (perfil)
    public function permissions($idProfile)
    {
        $plan = $this->plan->find($idProfile);

        if(!$plan) {
            return redirect()->back();
        }

         $permissions = $plan->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', ['plan' => $plan,'permissions' => $permissions]);

    }

      public function profiles($idPlan)
    {
       
        $plan = $this->plan->find($idPlan);

        
        
        if(!$plan) {
            return redirect()->back();
        }
        
        $profiles = $plan->profiles()->paginate();
    //    dd($profiles);

        return view('admin.pages.plans.profiles.profiles', ['profiles' => $profiles,'plan' => $plan]);

    }

     public function plans($idProfile)
    {
       
        $profile = $this->profile->find($idProfile);
        
        
        if(!$profile) {
            return redirect()->back();
        }
        
        $plans = $profile->plans()->paginate();
    //    dd($profiles);

        return view('admin.pages.profiles.plans.plans', ['plans' => $plans,'profile' => $profile]);

    }


    public function profilesAvailable(Request $request, $idPlan){
               

        $plan = $this->plan->find($idPlan);

        if(!$plan) {
            return redirect()->back();
        }

        $searchs = $request->except('_token');
        

        //to pegando todas as permissoes que nao estão vinculadas(ainda) ao plan 
        $profiles = $plan->profilesAvailable($request->filter);

         return view('admin.pages.plans.profiles.available', ['plan' => $plan,'profiles' => $profiles, 'searchs' => $searchs]);

    }

    public function attachProfilesPlan(Request $request, $idPlan){
       

        $plan = $this->plan->find($idPlan);

        if(!$plan) {
            return redirect()->back();
        }

        if(!$request->profiles || count($request->profiles) === 0) {
              return redirect()->back()->with('danger', 'Precisa escolher ao menos um perfil');

        }

       

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles', $plan->id);

    }

    public function detachProfilePlan ($idProfile,$idPlan) {

        $plan = $this->plan->find($idProfile);
        $profile = $this->profile->find($idPlan);

        if(!$plan || !$profile) {
            return redirect()->back();
        }

         $plan->profiles()->detach($profile);

        return redirect()->route('plans.profiles', $plan->id);

    } 

    
}
