<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            Transaction::where("created_at", ">",  now()->subDays(1)->endOfDay())
                ->process()->get()->map(function ($item) {
                    if ($item->status == "process") {
                        $item->status = "reject";
                        $item->save();
                    }
                });
        } catch (\Exception $exception) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
