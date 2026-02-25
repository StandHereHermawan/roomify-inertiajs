<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserIndexRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasRole;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserWithRoleController extends Controller
{
    public function showUserWithRolePagination(UserIndexRequest $request)
    {
        // Ambil data dari request yang sudah divalidasi
        $validated = $request->validated();
        $perPage = $validated[UserIndexRequest::PER_PAGE];
        $currentPage = $validated[UserIndexRequest::PAGE];

        $page = User::query()
                // Join ke tabel perantara
                // ->join('sipr_user_has_roles', 'users.id', '=', 'sipr_user_has_roles.user_id')
                ->join(UserHasRole::TABLE_NAME, 'users.id', '=', 'sipr_user_has_roles.user_id')
                // Join ke tabel roles
                // ->join('sipr_roles', 'sipr_user_has_roles.role_id', '=', 'sipr_roles.id')
                ->join(Role::TABLE_NAME, 'sipr_user_has_roles.role_id', '=', 'sipr_roles.id')

                // Seleksi kolom dengan alias untuk menghindari tabrakan
                ->select([
                    'users.*', // Semua kolom dari tabel users
                    'sipr_roles.role as role_name', // Ambil nama role
                    'sipr_user_has_roles.created_at as role_assigned_at' // created_at dari tabel pivot
                ])

                // Jika tabel sipr_user_has_roles menggunakan SoftDeletes, 
                // kita perlu menambah kondisi ini secara manual saat menggunakan JOIN
                ->whereNull('sipr_user_has_roles.deleted_at')
                ->whereNull('sipr_roles.deleted_at')
                ->paginate(
                    $perPage,
                    ['*'], // Parameter ini biasanya tetap ['*'] karena kita sudah mendefinisikan select() di atas
                    UserIndexRequest::PAGE,
                    $currentPage
                )
                ->withQueryString();

        if (false) {
            $page = User::with('roles') // Load relasi roles
                ->paginate(
                    $request->validated()[UserIndexRequest::PER_PAGE],
                    ['*'],
                    UserIndexRequest::PAGE,
                    $request->validated()[UserIndexRequest::PAGE]
                )
                ->withQueryString();
        }

        Log::debug($page);

        return Inertia::render('users/user-has-role', [UserIndexRequest::PAGE => $page]);
    }
}
