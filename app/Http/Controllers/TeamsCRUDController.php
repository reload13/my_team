<?php

namespace App\Http\Controllers;

use App\Models\Team;

use App\Repositories\DatabaseRepositoryInterface;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
//use App\Http\Requests\DeleteTeamRequest;
use Illuminate\Http\JsonResponse;

class TeamsCrudController extends Controller
{
    protected $repository;

    public function __construct(DatabaseRepositoryInterface $repository)
    {
        $this->repository = $repository->setModel(new Team()); // Replace with your actual model
    }

    public function index()
    {
        $teams = $this->repository->getAll();
        return response()->json(['teams' => $teams], 200);
    }

    public function show($id)
    {
        $team = $this->repository->find($id);
        return response()->json(['team' => $team], 200);
    }

    public function store(StoreTeamRequest $request)
    {
        $data = $request->validated();
        $this->repository->create($data);

        return response()->json(['message' => 'Resource created successfully'], 201);
    }

    public function update(UpdateTeamRequest $request, $id)
    {
        $data = $request->validated();
        $this->repository->update($id, $data);

        return response()->json(['message' => 'Resource updated successfully'], 200);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json(['message' => 'Resource deleted successfully'], 200);
    }

    // Other controller methods
}
