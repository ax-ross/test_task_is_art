<?php

namespace App\Http\Controllers;


use App\Http\Requests\Advertisement\FilterAdvertisementRequest;
use App\Http\Requests\Advertisement\StoreAdvertisementRequest;
use App\Http\Resources\AdvertisementResoruce;
use App\Models\Advertisement;
use App\Models\User;
use App\Services\AdvertisementService;

class AdvertisementController extends Controller
{
    private $service;

    public function __construct(AdvertisementService $service)
    {
        $this->service = $service;
    }

    public function index(FilterAdvertisementRequest $request)
    {
        $data = $request->validated();
        $advertisements = $this->service->filter($data);
        $advertisements = $this->service->sort($data, $advertisements);
        return AdvertisementResoruce::collection($advertisements->get());
    }

    public function userAdvertisements(FilterAdvertisementRequest $request, User $user)
    {
        $data = $request->validated();
        $advertisements = $this->service->filter($data)->where('user_id', $user->id);
        $advertisements = $this->service->sort($data, $advertisements);
        return AdvertisementResoruce::collection($advertisements->get());
    }

    public function store(StoreAdvertisementRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        return new AdvertisementResoruce(Advertisement::create($data));
    }
}
