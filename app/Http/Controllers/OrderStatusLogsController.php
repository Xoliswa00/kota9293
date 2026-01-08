<?php

namespace App\Http\Controllers;

use App\Models\order_status_logs;
use App\Http\Requests\Storeorder_status_logsRequest;
use App\Http\Requests\Updateorder_status_logsRequest;

class OrderStatusLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeorder_status_logsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(order_status_logs $order_status_logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order_status_logs $order_status_logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateorder_status_logsRequest $request, order_status_logs $order_status_logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order_status_logs $order_status_logs)
    {
        //
    }
}
