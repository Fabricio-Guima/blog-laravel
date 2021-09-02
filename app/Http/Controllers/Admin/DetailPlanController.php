<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPlan;
use App\Models\Plan;
use App\Http\Requests\StoreUpdateDetailPlan;

class DetailPlanController extends Controller
{

    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;

        $this->middleware('can:plans');
    }

    public function index($url){       

       $plan = $this->plan->where('url', $url)->first();

       if (!$plan){
           return redirect()->back();
       }
 
       $details = $plan->details()->paginate();
      

       return view('admin.pages.plans.details.index', ['plan'=> $plan, 'details'=> $details]);

    }

     public function create($url){       

       $plan = $this->plan->where('url', $url)->first();
     

       if (!$plan){
           return redirect()->back();
        }      

       return view('admin.pages.plans.details.create', ['plan'=> $plan]);

    }

    public function store(StoreUpdateDetailPlan $request, $url)
    {       

        // dd($request->all());
       $plan = $this->plan->where('url', $url)->first();      

       if (!$plan){
           return redirect()->back();
        }    
        
        $plan->details()->create($request->except('_token'));

     return redirect()->route('details.plan.index', $plan->url);

    }

    public function show($urlPlan,$idDetail){
         $plan = $this->plan->where('url', $urlPlan)->first();
         $detail = $this->repository->find($idDetail);

           if (!$plan || !$detail) {
            return redirect()->back();
        }

         return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail,
        ]);


    }

    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }

     public function update(StoreUpdateDetailPlan $request,$urlPlan, $idDetail){       
      
       $plan = $this->plan->where('url', $urlPlan)->first();
       $detail = $this->repository->find($idDetail);
    //   dd($request->all());

        

       if (!$plan || !$detail){
           return redirect()->back();
        } 

        $detail->update($request->all());
        

        return redirect()->route('details.plan.index', $plan->url);

    }

    public function destroy($urlPlan, $idDetail) {

        $plan = $this->plan->where('url', $urlPlan)->first();
         $detail = $this->repository->find($idDetail);

          if (!$plan || !$detail){
            return redirect()->back();
           
        } 

        $detail->delete();

        return redirect()
                 ->route('details.plan.index', $plan->url)
                 ->with('message','Detalhe deletado com sucesso');
    }


}
