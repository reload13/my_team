<?php


namespace App\Http\Controllers;

use App\Helpers\FormBuilder;
use App\Models\Game;
use App\Repositories\DatabaseRepositoryInterface;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
//use Illuminate\Http\JsonResponse;

class GameCRUDController extends Controller
{
    protected $repository;
    protected $formBuilder;

    public function __construct(DatabaseRepositoryInterface $repository, FormBuilder $formBuilder)
    {
        $this->repository = $repository->setModel(new Game()); // Replace with your actual model
        $this->formBuilder = $formBuilder->setModel(new Game());
    }


    public function index()
    {
        $formData = $this->formBuilder->generateFieldsFromModel('/update-route', 'Update');
//        dd($formData);
        $matches = $this->repository->getAll();
        return view('CRUD.games.index', ['matches' => $matches]);    }


    public function show($id)
    {
        $match = $this->repository->find($id);

        if (!$match) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        return response()->json(['data' => $match], 200);
    }


    public function store(StoreMatchRequest $request)
    {
        $data = $request->validated();
//        dd($data);
        $data['time'] = "now";
        $createdGame = $this->repository->create($data);
//        toastr()->success('Data has been saved successfully!', 'Congrats');
//        $notification = new \Illuminate\Notifications\Notification;
//        $notification->success('Resource created successfully.');
        return response()->json(['message' => 'Resource created successfully', 'data' => $createdGame], 201);
    }

    public function create()
    {

        $formData = $this->formBuilder->generateFieldsFromModel('matches', 'Update','POST');


        return view('CRUD.games.create', ['form' => $formData]);

//        return response()->json(['message' => 'Resource updated successfully'], 200);
    }

    public function edit($id)
    {
        $game = $this->repository->find($id);

        if (!$game) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        $formData = $this->formBuilder->generateFieldsFromModel('matches', 'Update','PUT');


        return view('CRUD.games.edit', ['data' => $game,'form' => $formData,'id'=>$id]);

//        return response()->json(['message' => 'Resource updated successfully'], 200);
    }

    public function update(UpdateMatchRequest $request, $id)
    {
        $data = $request->validated();
        $this->repository->update($id, $data);

        return response()->json(['message' => 'Resource updated successfully', 'data' => $this->repository->find($id)], 200);    }


    public function destroy($id)
    {
        $match = $this->repository->find($id);

        if (!$match) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        try {
            $this->repository->delete($id);
            return response()->json(['message' => 'Resource deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete resource'], 500);
        }
    }
}
