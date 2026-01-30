<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserIndexRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function showUserPagination(UserIndexRequest $request)
    {
        $page = User::paginate(
            $request->validated()[UserIndexRequest::PER_PAGE],
            ['*'],
            UserIndexRequest::PAGE,
            $request->validated()[UserIndexRequest::PAGE]
        )->withQueryString();

        return Inertia::render('users/page', [UserIndexRequest::PAGE => $page]);
    }
}
