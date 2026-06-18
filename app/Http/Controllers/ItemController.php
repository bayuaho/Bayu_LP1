<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->filled('category_id')) {

            $query->where(
                'category_id',
                $request->category_id
            );

        }

        return $this->success(
            $query->get(),
            'Data item berhasil diambil'
        );
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create(
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
        $item = Item::find($id);

        if (!$item) {
            return $this->error(
                'Item tidak ditemukan',
                404
            );
        }

        return $this->success(
            $item,
            'Detail item berhasil diambil'
        );
    }

    public function update(UpdateItemRequest $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {

            return $this->error(
                'Item tidak ditemukan',
                404
            );

        }

        $item->update(
            $request->validated()
        );

        return $this->success(
            $item,
            'Item berhasil diupdate'
        );
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return $this->error(
                'Item tidak ditemukan',
                404
            );
        }

        $item->delete();

        return $this->success(
            null,
            'Item berhasil dihapus'
        );
    }
}