<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserIndexRequest;
use App\Models\AuthenticationSession;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserSessionController extends Controller
{
    public function showUserSessionPagination(UserIndexRequest $request)
    {
        $page = AuthenticationSession::paginate(
            $request->validated()[UserIndexRequest::PER_PAGE],
            ['*'],
            UserIndexRequest::PAGE,
            $request->validated()[UserIndexRequest::PAGE]
        )->withQueryString();

        Log::debug($page);

        return Inertia::render('users/session', [UserIndexRequest::PAGE => $page]);
    }

    public function userSessionJson(UserIndexRequest $request)
    {
        $page = AuthenticationSession::with('user')->paginate(
                $request->validated()[UserIndexRequest::PER_PAGE],
                ['*'],
                UserIndexRequest::PAGE,
                $request->validated()[UserIndexRequest::PAGE]
            )->withQueryString();

        Log::debug($page);

        return $page;
    }
}
