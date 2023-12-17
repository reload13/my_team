<?php


namespace App\Http\Controllers;

use App\Models\Game;
use App\Repositories\DatabaseRepositoryInterface;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use Illuminate\Http\JsonResponse;

class GameCRUDController extends Controller
{
    protected $repository;

    public function __construct(DatabaseRepositoryInterface $repository)
    {
        $this->repository = $repository->setModel(new Game()); // Replace with your actual model
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $matches = $this->repository->getAll();
        return response()->json(['matches' => $matches], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $match = $this->repository->find($id);

        if (!$match) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        return response()->json(['data' => $match], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMatchRequest $request
     * @return JsonResponse
     */
    public function store(StoreMatchRequest $request)
    {
        $data = $request->validated();
        $createdGame = $this->repository->create($data);

        return response()->json(['message' => 'Resource created successfully', 'data' => $createdGame], 201);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMatchRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateMatchRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $this->repository->update($id, $data);

        return response()->json(['message' => 'Resource updated successfully', 'data' => $this->repository->find($id)], 200);    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
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
