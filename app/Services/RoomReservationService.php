<?php

namespace App\Services;

use App\Models\RoomReservation;

class RoomReservationService
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
        $record = RoomReservation::create($input);
        return $record;
    }

    public function update(RoomReservation $model, array $input)
    {
        $model->update($input);
        return $model;
    }

    public function delete(RoomReservation $model)
    {
        $model->delete();
        return $model;
    }

    public function roomSessionPages($perPage, $name, $onPage = 0)
    {
        $pages = RoomReservation::orderBy(RoomReservation::RESERVATION_DATE)->paginate(
            $perPage,
            ['*'],
            $name,
        );
        return $pages;
    }
}
