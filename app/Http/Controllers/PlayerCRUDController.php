<?php

namespace App\Http\Controllers;

use App\Helpers\FormBuilder;
use App\Models\Player;

use App\Repositories\DatabaseRepositoryInterface;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
//use App\Http\Requests\DeletePlayerRequest;
use Illuminate\Http\JsonResponse;

class PlayerCRUDController extends Controller
{
    protected $repository;

    public function __construct(DatabaseRepositoryInterface $repository, FormBuilder $formBuilder)
    {
        $this->repository = $repository->setModel(new Player());
        $this->formBuilder = $formBuilder->setModel(new Player());

    }


    public function index()
    {
        $players = $this->repository->getAll();
        return view('CRUD.players.index', ['players' => $players]);
    }


    public function show($id)
    {
        $player = $this->repository->find($id);

        if (!$player) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        return response()->json(['data' => $player], 200);
    }


    public function store(StorePlayerRequest $request)
    {
        $data = $request->validated();
        $this->repository->create($data);

        return response()->json(['message' => 'Resource created successfully'], 201);
    }

    public function create()
    {

        $formData = $this->formBuilder->generateFieldsFromModel('players', 'Update','POST');


        return view('CRUD.players.create', ['form' => $formData]);

//        return response()->json(['message' => 'Resource updated successfully'], 200);
    }
    public function edit($id)
    {
        $player = $this->repository->find($id);

        if (!$player) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        $formData = $this->formBuilder->generateFieldsFromModel('players', 'Update','PUT');


        return view('CRUD.players.edit', ['data' => $player,'form' => $formData,'id'=>$id]);

//        return response()->json(['message' => 'Resource updated successfully'], 200);
    }

    public function update(UpdatePlayerRequest $request, $id)
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
}
