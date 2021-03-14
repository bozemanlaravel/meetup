<?php

namespace App\Tasks;

use App\Reminder;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RemindUser;

class SendReminders {
    public function __invoke() {
        $reminders = Reminder::where('sent', false)->where('send_time', '<=', now()->toDateTimeString())->get();

        foreach ($reminders as $rem) {
            $rem->notify(new RemindUser);
            $rem->sent = true;
            $rem->save();
        }
    }
}
