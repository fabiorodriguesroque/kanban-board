<?php

namespace App\Observers;
use App\Models\Card;

class CardObserver
{
    public function creating(Card $card): void
    {
        $card->position = Card::where('column_id', $card->column_id)->max('position') + 1000;
    }
}
