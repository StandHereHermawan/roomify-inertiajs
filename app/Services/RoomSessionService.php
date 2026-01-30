<?php

namespace App\Services;

use App\Models\RoomSession;

class RoomSessionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $input)
    {
        $record = RoomSession::create($input);
        return $record;
    }

    public function update(RoomSession $model, array $input)
    {
        $model->update($input);
        return $model;
    }

    public function delete(RoomSession $model)
    {
        $model->delete();
        return $model;
    }

    public function roomSessionPages($perPage, $name, $onPage = 0)
    {
        $pages = RoomSession::orderBy(RoomSession::SESSION_START)->paginate(
            $perPage,
            ['*'],
            $name,
        );
        return $pages;
    }
}
