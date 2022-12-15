<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command;

class DeleteRecords extends Command
{
    protected $signature = 'delete-records';

    public function handle()
    {
        DB::table('comments')->where('created_at', '<=', Carbon::now()->subDay())->delete();
    }
}
