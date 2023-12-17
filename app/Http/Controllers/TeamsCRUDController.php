<?php

namespace App\Http\Controllers;

use App\Helpers\FormBuilder;
use App\Models\Team;

use App\Repositories\DatabaseRepositoryInterface;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
//use App\Http\Requests\DeleteTeamRequest;
use Illuminate\Http\JsonResponse;

class TeamsCRUDController extends Controller
{
    protected $repository;
    protected $formBuilder;

    public function __construct(DatabaseRepositoryInterface $repository, FormBuilder $formBuilder)
    {
        $this->repository = $repository->setModel(new Team()); // Replace with your actual model
        $this->formBuilder = $formBuilder->setModel(new Team()); // Replace with your actual model
    }

    public function index()
    {
        $teams = $this->repository->getAll();
        return view('CRUD.teams.index', ['teams' => $teams]);

//        return response()->json(['teams' => $teams], 200);
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

    public function create()
    {


        $formData = $this->formBuilder->generateFieldsFromModel('teams', 'Update','POST');


        return view('CRUD.teams.create', [ 'form' => $formData]);
    }
    public function edit($id)
    {
        $team = $this->repository->find($id);

        if (!$team) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        $formData = $this->formBuilder->generateFieldsFromModel('teams', 'Update','PUT');


        return view('CRUD.teams.edit', ['data' => $team, 'form' => $formData,'id'=>$id]);
    }

//

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
