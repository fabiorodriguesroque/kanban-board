<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Column;

class ColumnCardDestroyController extends Controller
{
    public function __invoke(Column $column, Card $card)
    {
        $card->delete();

        return back();
    }
}
