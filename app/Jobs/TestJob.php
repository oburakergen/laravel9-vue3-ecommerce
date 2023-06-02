<?php

namespace App\Jobs;

use App\Models\CronTest;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private CronTest $crons;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CronTest $crons)
    {
        $this->crons = $crons;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        CronTest::create([
            "test_case" => 1
        ]);
    }
}
