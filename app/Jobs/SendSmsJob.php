<?php

namespace App\Jobs;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $from;
    private Client $twilioClient;
    private Transaction $transaction;

    /**
     * Create a new job instance.
     *
     * @return void
     * @throws ConfigurationException
    */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $sid =  getenv("TWILIO_SID");
        $token =  getenv("TWILIO_AUTH_TOKEN");
        $this->from = getenv("TWILIO_NUMBER");
        $this->twilioClient = new Client($sid, $token);
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws TwilioException
     */
    public function handle()
    {
        $template = "Transaction Success # %s";
        $body = sprintf($template, $this->transaction->id);
        $message = $this->twilioClient->messages->create(
            $this->transaction->phone,
            [
                'from' => $this->from,
                'body' => $body
            ]
        );
        Log::info($message->sid);
    }
}
