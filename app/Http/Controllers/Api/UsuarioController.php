<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserListRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UsuarioController extends Controller
{
    public function userList(UserListRequest $request): JsonResponse
    {
        try {
            $paginate = filter_var($request->input('paginate'), FILTER_VALIDATE_BOOLEAN);
            $perPage = $request->input('perPage') ?: 15;
            $page = $request->input('page') ?: 1;
            $sortBy = $request->input('sortBy') ?: 'id';
            $sortDirection = $request->input('sortDirection') ?: 'desc';

            $userQuery = Usuario::with(['departamento', 'cargo'])->orderBy($sortBy, $sortDirection);

            if ($request->filled('search')) {
                $search = $request->input('search');
                $userQuery->where(function ($q) use ($search) {
                    $q->where('usuario', 'like', "%{$search}%")
                        ->orWhere('primerNombre', 'like', "%{$search}%")
                        ->orWhere('primerApellido', 'like', "%{$search}%");
                });
            }

            if ($request->filled('queryDate')) {
                $dates = explode(',', $request->input('queryDate'));
                if (count($dates) == 2) {
                    $startDate = Carbon::createFromFormat('d/m/y', trim($dates[0]))->startOfDay()->format('Y-m-d H:i:s');
                    $endDate = Carbon::createFromFormat('d/m/y', trim($dates[1]))->endOfDay()->format('Y-m-d H:i:s');
                } else {
                    $startDate = Carbon::createFromFormat('d/m/y', trim($request->input('queryDate')))->startOfDay()->format('Y-m-d H:i:s');
                    $endDate = Carbon::createFromFormat('d/m/y', trim($request->input('queryDate')))->endOfDay()->format('Y-m-d H:i:s');
                }
                $userQuery->whereBetween('created_at', [$startDate, $endDate]);
            }

            if ($request->filled('departmentCode') && $request->input('departmentCode') !== '0' && $request->input('departmentCode') !== 'all') {
                $departmentId = $request->query('departmentCode');
                $userQuery->whereHas('departamento', function ($q) use ($departmentId) {
                    $q->where('departamentos.id', $departmentId);
                });
            }

            if ($request->filled('positionCode') && $request->input('positionCode') !== '0' && $request->input('positionCode') !== 'all') {
                $positionId = $request->query('positionCode');
                $userQuery->whereHas('cargo', function ($q) use ($positionId) {
                    $q->where('cargos.id', $positionId);
                });
            }

            if ($paginate) {
                $users = $userQuery->paginate($perPage, ['*'], 'page', $page);
            } else {
                $users = $userQuery->get();
            }
            
            $mappedUsers = $users instanceof \Illuminate\Pagination\AbstractPaginator
                ? $users->getCollection()->map(function ($user) {
                    return $this->transformUser($user);
                })
                : $users->map(function ($user) {
                    return $this->transformUser($user);
                });

            $response = [
                'code' => 200,
                'success' => true,
                'message' => $users->isEmpty() ? 'No users' : 'User found',
                'data' => [
                    'users' => $mappedUsers,
                ],
            ];

            if ($paginate) {
                $response['pagination'] = [
                    'total' => $users->total(),
                    'per_page' => $users->perPage(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'first_page_url' => $users->url(1),
                    'last_page_url' => $users->url($users->lastPage()),
                    'next_page_url' => $users->nextPageUrl(),
                    'prev_page_url' => $users->previousPageUrl(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
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
     * Transforma un objeto Employee en el formato deseado.
     */
    private function transformUser($user): array
    {
        return [
            'idUser' => $user->id,
            'usuario' => $user->usuario,
            'primerNombre' => $user->primerNombre,
            'segundoNombre' => $user->segundoNombre,
            'primerApellido' => $user->primerApellido,
            'segundoApellido' => $user->segundoApellido,
            'idDepartamento' => $user->idDepartamento,
            'departamento' => $user->departamento->nombre,
            'idCargo' => $user->idCargo,
            'cargo' => $user->cargo->nombre,
            'email' => $user->email,
        ];
    }

    public function updateUsuario(UserUpdateRequest $request) : JsonResponse {
        try {
            $idUsuario = $request->input('idUser');
            $usuario = Usuario::find($idUsuario);

            if (!$usuario) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado.',
                ], 404);
            }

            $usuario->update([
                'usuario' => $request->input('usuario'),
                'primerNombre' => $request->input('primerNombre'),
                'segundoNombre' => $request->input('segundoNombre'),
                'primerApellido' => $request->input('primerApellido'),
                'segundoApellido' => $request->input('segundoApellido'),
                'idDepartamento' => $request->input('idDepartamento'),
                'idCargo' => $request->input('idCargo'),
                'email' => $request->input('email'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario actaulizado existosamente.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => 'Error interno del servidor: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function storeUsuario(Request $request) : JsonResponse {
        try {
            $usuario = Usuario::create([
                'usuario' => $request->input('usuario'),
                'primerNombre' => $request->input('primerNombre'),
                'segundoNombre' => $request->input('segundoNombre'),
                'primerApellido' => $request->input('primerApellido'),
                'segundoApellido' => $request->input('segundoApellido'),
                'idDepartamento' => $request->input('idDepartamento'),
                'idCargo' => $request->input('idCargo'),
                'email' => $request->input('email'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Miembro de la familia registrado existosamente.',
                'data' => $usuario,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => 'Error interno del servidor' . $e->getMessage(),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
