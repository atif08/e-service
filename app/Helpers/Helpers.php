<?php

namespace App\Helpers;

use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Helpers
{
    public static function mapEnum($enumClass): Collection
    {
        return collect($enumClass)->map(function ($item) {
//            $data = preg_split('/(?=[A-Z])/', $item->name);

            return ['name' => Str::replace('_', ' ', $item->name), 'value' => $item->value, 'label' => Str::replace('_', ' ', $item->name)];
        });

    }
}
