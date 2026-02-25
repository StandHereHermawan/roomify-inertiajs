<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserIndexRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function rolePagination(UserIndexRequest $request)
    {
        $page = Role::paginate(
            $request->validated()[UserIndexRequest::PER_PAGE],
            ['*'],
            UserIndexRequest::PAGE,
            $request->validated()[UserIndexRequest::PAGE]
        )->withQueryString();

        Log::debug($page);

        return Inertia::render('users/role', [UserIndexRequest::PAGE => $page]);
    }

    public function addRole()
    {
        return Inertia::render('users/add-role');
    }
}
