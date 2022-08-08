<?php

namespace Eliasmpjunior\Caravela\Services\Config;

use Illuminate\Support\Facades\Config;


class DatabaseConnection
{
	public static function default()
	{
        return is_null(config('empj-caravela.connection')) ? config('database.default') : config('empj-caravela.connection');
    }
}
