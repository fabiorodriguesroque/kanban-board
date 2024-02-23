<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\RedirectResponse;

class ColumnDestoryController extends Controller
{   
    /**
     * Handle the incoming request.
     */
    public function __invoke(Column $column): RedirectResponse
    {
        $column->delete();

        return back();
    }
}
