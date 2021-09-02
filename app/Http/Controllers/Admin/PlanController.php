<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePlan;


class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;

        // $this->middleware('can:plans');
    }

    public function index(){
        $plans = $this->repository->paginate();

        return view('admin.pages.plans.index',['plans' => $plans]);
    }

    public function show($url){
        // uso where prq find só pesquisa pelo id       
        $plan = $this->repository->where('url',$url)->first();

        if(!$plan) {
            //vou retornar para a página anterior com o back()
            return redirect()->back();
        }

        return view('admin.pages.plans.show',['plan' => $plan]);

    }

    public function create() {
       

        return view('admin.pages.plans.create');
    }

     public function store(StoreUpdatePlan $request) {

      
       $this->repository->create($request->all());

       return redirect()->route('plans.index');
       
    }

    public function edit($url){

         $plan = $this->repository->where('url',$url)->first();

          if(!$plan) {
            //vou retornar para a página anterior com o back()
            return redirect()->back();
        }


        return view('admin.pages.plans.edit', ['plan' => $plan]);

    }

    public function update(StoreUpdatePlan $request, $url){


         $plan = $this->repository->where('url',$url)->first();

          if(!$plan) {
            //vou retornar para a página anterior com o back()
            return redirect()->back();
        }

       $plan->update($request->all());

       return redirect()->route('plans.index');
       
    }

    public function destroy($url) {
       
          // uso where prq find só pesquisa pelo id       
          //with details significa que eu irei buscar todos os detalhes que estão relacionados a este plano e uma única requisição
        $plan = $this->repository->with('details')->where('url',$url)->first();
        
        if(!$plan) {
            //vou retornar para a página anterior com o back()
            return redirect()->back();
        }
        if($plan->details->count() > 0) {
            return redirect()->back()->with('error', 'Exsitem detalhes vinculados a esse plano, portanto não é possível deletar este plano. Delete primeiro todos detalhes para depois deletar o plano');
        }

        $plan->delete();

        return redirect()->route('plans.index');


    }

    public function search(Request $request){

        //vai mandar tudo de request, menos o token
        $searchs = $request->except('_token');

        $plans = $this->repository->search($request->search);

        return view('admin.pages.plans.index',['plans' => $plans, 'searchs' => $searchs]);

    }
}
