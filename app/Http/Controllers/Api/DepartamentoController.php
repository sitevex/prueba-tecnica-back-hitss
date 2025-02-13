<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DepartamentoListRequest;
use App\Models\Departamento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function departmentsList(DepartamentoListRequest $request): JsonResponse
    {
        try {
            $paginate = filter_var($request->input('paginate'), FILTER_VALIDATE_BOOLEAN);
            $perPage = $request->input('perPage', 15);
            $sortBy = $request->input('sortBy') ?: 'id'; // Por defecto, ordena por 'id'
            $sortDirection = $request->input('sortDirection') ?: 'desc'; // Por defecto, ordena de forma descendente

            $departmentQuery = Departamento::orderBy($sortBy, $sortDirection);

            if ($request->filled('search')) {
                $search = $request->input('search');
                $departmentQuery->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('codigo', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status') && $request->input('status') !== 'all') {
                $departmentQuery->where('status', $request->input('status'));
            }

            if ($paginate) {
                
                $departments = $departmentQuery->paginate($perPage);
            } else {
                $departments = $departmentQuery->get();
            }

            $mappedDepartments = $departments instanceof \Illuminate\Pagination\AbstractPaginator
                ? $departments->getCollection()->map(function ($department) {
                    return $this->transformDepartment($department);
                })
                : $departments->map(function ($department) {
                    return $this->transformDepartment($department);
                });

            $response = [
                'code' => 200,
                'success' => true,
                'message' => $departments->isEmpty() ? 'No departments' : 'Department found',
                'data' => [
                    'departments' => $mappedDepartments,
                ],
            ];

            if ($paginate) {
                $response['pagination'] = [
                    'total' => $departments->total(),
                    'per_page' => $departments->perPage(),
                    'current_page' => $departments->currentPage(),
                    'last_page' => $departments->lastPage(),
                    'first_page_url' => $departments->url(1),
                    'last_page_url' => $departments->url($departments->lastPage()),
                    'next_page_url' => $departments->nextPageUrl(),
                    'prev_page_url' => $departments->previousPageUrl(),
                    'from' => $departments->firstItem(),
                    'to' => $departments->lastItem(),
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
     * Transforma un objeto department en el formato deseado.
     */
    private function transformDepartment($department): array
    {
        return [
            'idDepartment' => $department->id,
            'name' => $department->nombre,
            'code' => $department->codigo,
            'activo' => $department->activo,
            'created_at' => $department->created_at,
        ];
    }
}
