<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    public function __construct(private Client $model)
    {
    }

    public function index()
    {
        return response()->json($this->model->all());
    }

    public function show($id)
    {
        $client = $this->model->find($id);

        return response()->json($client);
    }

    public function store(ClientRequest $request)
    {
        $client = $this->model->create($request->all());

        return response()->json([
            'message' => 'Client created successfully', 
            'data' => $client
        ], 201);
    }

    public function update($id, Request $request)
    {
        $client = $this->model->find($id);

        $client->update($request->all());

        return response()->json([
            'message' => 'Client updated successfully', 
            'data' => $client
        ], 200);
    }

    public function destroy($id, Request $request)
    {
        $client = $this->model->find($id);

        $client->delete();

        return response()->json([
            'message' => 'Client deleted successfully'
        ], 200);
    }
}
