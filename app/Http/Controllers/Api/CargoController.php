<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CargoListRequest;
use App\Models\Cargo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function cargosList(CargoListRequest $request): JsonResponse
    {
        try {
            $paginate = filter_var($request->input('paginate'), FILTER_VALIDATE_BOOLEAN);
            $perPage = $request->input('perPage', 15);
            $sortBy = $request->input('sortBy') ?: 'id'; // Por defecto, ordena por 'id'
            $sortDirection = $request->input('sortDirection') ?: 'desc'; // Por defecto, ordena de forma descendente

            $cargoQuery = Cargo::orderBy($sortBy, $sortDirection);

            if ($request->filled('search')) {
                $search = $request->input('search');
                $cargoQuery->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('codigo', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status') && $request->input('status') !== 'all') {
                $cargoQuery->where('status', $request->input('status'));
            }

            if ($paginate) {
                $cargos = $cargoQuery->paginate($perPage);
            } else {
                $cargos = $cargoQuery->get();
            }

            $mappedCargos = $cargos instanceof \Illuminate\Pagination\AbstractPaginator
                ? $cargos->getCollection()->map(function ($cargo) {
                    return $this->transformCargo($cargo);
                })
                : $cargos->map(function ($cargo) {
                    return $this->transformCargo($cargo);
                });

            $response = [
                'code' => 200,
                'success' => true,
                'message' => $cargos->isEmpty() ? 'No cargos' : 'Cargo found',
                'data' => [
                    'cargos' => $mappedCargos,
                ],
            ];

            if ($paginate) {
                $response['pagination'] = [
                    'total' => $cargos->total(),
                    'per_page' => $cargos->perPage(),
                    'current_page' => $cargos->currentPage(),
                    'last_page' => $cargos->lastPage(),
                    'first_page_url' => $cargos->url(1),
                    'last_page_url' => $cargos->url($cargos->lastPage()),
                    'next_page_url' => $cargos->nextPageUrl(),
                    'prev_page_url' => $cargos->previousPageUrl(),
                    'from' => $cargos->firstItem(),
                    'to' => $cargos->lastItem(),
                ];
            }

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => 'Error interno del servidor' . $e->getMessage(),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Transforma un objeto cargo en el formato deseado.
     */
    private function transformCargo($cargo): array
    {
        return [
            'idCargo' => $cargo->id,
            'name' => $cargo->nombre,
            'code' => $cargo->codigo,
            'activo' => $cargo->activo,
            'created_at' => $cargo->created_at,
        ];
    }
}
