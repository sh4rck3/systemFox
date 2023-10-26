<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SendsmsRequest;
use Illuminate\Http\Resources\Json\JsonResourceCollection;
use Illuminate\Suporte\Facedes\Log;




class SendsmsapiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @retunr AnonymousResourceResource
     */
    public function index()
    {
        Log::info("function index");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info("function store ");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Log::info("function show");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info("fucntion update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Log::info("function destroy");
    }
}
