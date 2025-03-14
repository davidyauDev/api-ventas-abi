<?php

namespace App\helper;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Helpers
{
    public static function paginator(LengthAwarePaginator $paginator)
    {
        return [
            "current_page" => $paginator->currentPage(),
            "data" => $paginator->items(),
            "from" => $paginator->firstItem(),
            "last_page" => $paginator->lastPage(),
            "per_page" => $paginator->perPage(),
            "to" => $paginator->lastItem(),
            "total" => $paginator->total()
        ];
    }
}
