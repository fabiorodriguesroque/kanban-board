<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColumnRequest;
use App\Models\Board;
use App\Models\Column;
use Illuminate\Http\RedirectResponse;

class BoardColumnCreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreColumnRequest $request, Board $board): RedirectResponse
    {
        $board->addColumn(Column::create($request->all()));

        return back();
    }
}
