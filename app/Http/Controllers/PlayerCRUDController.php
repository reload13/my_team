<?php

namespace App\Http\Controllers;

use App\Models\Player;

use App\Repositories\DatabaseRepositoryInterface;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
//use App\Http\Requests\DeletePlayerRequest;
use Illuminate\Http\JsonResponse;

class PlayerCRUDController extends Controller
{
    protected $repository;

    public function __construct(DatabaseRepositoryInterface $repository)
    {
        $this->repository = $repository->setModel(new Player()); // Replace with your actual model
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $players = $this->repository->getAll();
        return response()->json(['players' => $players], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $player = $this->repository->find($id);

        if (!$player) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        return response()->json(['data' => $player], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePlayerRequest  $request
     * @return JsonResponse
     */
    public function store(StorePlayerRequest $request)
    {
        $data = $request->validated();
        $this->repository->create($data);

        return response()->json(['message' => 'Resource created successfully'], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePlayerRequest  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdatePlayerRequest $request, $id)
    {
        $data = $request->validated();
        $this->repository->update($id, $data);

        return response()->json(['message' => 'Resource updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeletePlayerRequest  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {

        $this->repository->delete($id);

        return response()->json(['message' => 'Resource deleted successfully'], 200);
    }
}
