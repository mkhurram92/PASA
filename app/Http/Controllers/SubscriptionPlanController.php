<?php

namespace App\Http\Controllers;

use App\DataTables\SubscriptionPlanDataTable;
use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscriptionPlanDataTable $request)
    {
        $data = SubscriptionPlan::all();

        return $request->render('page.subscription-plan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.subscription-plan-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionPlanRequest $request)
    {
        SubscriptionPlan::create($request->validated());
        return response()->json(["status" => true, "message" => "Subscription Plan created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionPlan  $subscription_plan
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionPlan $subscription_plan)
    {
        $html = view("models.subscription-plan-view", compact('subscription_plan'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionPlan  $subscription_plan
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionPlan $subscription_plan)
    {
        $html = view("models.subscription-plan-update", compact('subscription_plan'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatesRequest  $request
     * @param  \App\Models\States  $states
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionPlanRequest $request, $subscription_plan)
    {
        $state = SubscriptionPlan::find($subscription_plan);
        $state->update($request->validated());

        return response()->json(["status" => true, "message" => "Subscription Plan updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\States  $states
     * @return \Illuminate\Http\Response
     */
    public function destroy($states)
    {
        $state = SubscriptionPlan::find($states);
        $state->delete();
        return response()->json(["status" => true, "message" => "Subscription Plan Deleted Successfully"]);
    }
}
