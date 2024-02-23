<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardsReorderUpdateRequest;
use App\Models\Card;
use Illuminate\Http\RedirectResponse;

class CardsReorderUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CardsReorderUpdateRequest $request): RedirectResponse
    {
        $data = collect($request->columns)
            ->map(function ($column) {
                return collect($column['cards'])->map(function ($card) use ($column) {
                    return ['id' => $card['id'], 'position' => $card['position'], 'column_id' => $column['id']];
                });
            })
            ->flatten(1)
            ->toArray();

        Card::query()->upsert($data, ['id'], ['position', 'column_id']);

        return back();
    }
}
