<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index(Request $request)
    {
        $items = $this->itemService->all();

        if ($request->filled('category_id')) {

            $items = $items->where(
                'category_id',
                $request->category_id
            );

        }

        return $this->success(
            $items->values(),
            'Data item berhasil diambil'
        );
    }

    public function store(StoreItemRequest $request)
    {
        $item = $this->itemService->create(
            $request->validated()
        );

        return $this->success(
            $item,
            'Item berhasil dibuat',
            201
        );
    }

    public function show($id)
    {
        $item = $this->itemService->find($id);

        return $this->success(
            $item,
            'Detail item berhasil diambil'
        );
    }

    public function update(UpdateItemRequest $request, $id)
    {
        $item = $this->itemService->update(
            $id,
            $request->validated()
        );

        return $this->success(
            $item,
            'Item berhasil diupdate'
        );
    }

    public function destroy($id)
    {
        $this->itemService->delete($id);

        return $this->success(
            null,
            'Item berhasil dihapus'
        );
    }
}