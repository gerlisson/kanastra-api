<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use App\Http\Requests\RaceRequest;

class RaceController extends Controller
{
    public function __construct(private Race $model)
    {
    }

    public function index()
    {
        return response()->json($this->model->all());
    }

    public function show($id)
    {
        $race = $this->model->find($id);

        return response()->json($race);
    }

    public function store(RaceRequest $request)
    {
        $race = $this->model->create($request->all());

        return response()->json([
            'message' => 'Racec created successfully', 
            'data' => $race
        ], 201);
    }

    public function update($id, Request $request)
    {
        $race = $this->model->find($id);

        $race->update($request->all());

        return response()->json([
            'message' => 'Race updated successfully', 
            'data' => $race
        ], 200);
    }

    public function destroy($id, Request $request)
    {
        $race = $this->model->find($id);

        $race->delete();

        return response()->json([
            'message' => 'Race deleted successfully'
        ], 200);
    }
}
