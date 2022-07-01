<?php

namespace App\Services;

use App\Http\Filters\AdvertisementFilter;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Builder;

class AdvertisementService
{
    public function filter($data)
    {
        $filter = app()->make(AdvertisementFilter::class, ['queryParams' => $data]);
        $advertisements = Advertisement::filter($filter);
        return $advertisements;
    }

    public function sort($data, $advertisements)
    {
        if (isset($data['orderBy'])) {
            if (isset($data['sortDirection'])) {
                $advertisements = $advertisements->orderBy($data['orderBy'], $data['sortDirection']);
            } else {
                $advertisements = $advertisements->orderBy($data['orderBy'], 'asc');
            }
        }
        return $advertisements;
    }
}
