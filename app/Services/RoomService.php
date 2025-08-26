<?php

namespace App\Services;

use App\Models\Room;

class RoomService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    public function create(array $input)
    {
        $record = Room::create($input);
        return $record;
    }

    public function update(Room $model, array $input)
    {
        $model->update($input);
        return $model;
    }

    public function delete(Room $model)
    {
        $model->delete();
        return $model;
    }

    public function roomPages($perPage, $name, $onPage = 1)
    {
        $pages = Room::orderBy(Room::CODE)->paginate(
            $perPage,
            ['*'],
            $name,
            $onPage
        );
        return $pages;
    }
}
