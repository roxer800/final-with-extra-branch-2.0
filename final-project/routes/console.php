<?php

use App\Console\Commands\check_or_stale_orders;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;



Schedule::command('app:check_or_stale_orders')->everyTwoSeconds();
