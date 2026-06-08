<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends BaseController
{
    public function index()
    {
        return $this->success(
            Item::all(),
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