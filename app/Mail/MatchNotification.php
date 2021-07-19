<?php

namespace App\Mail;

use App\Models\Match;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MatchNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $match;
    public $matchTime;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
        $this->matchTime = Carbon::create($match->match_time)->format('jS F \a\t h:i A');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.matches.match_notification');
    }
}
