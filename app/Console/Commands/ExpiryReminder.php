<?php

namespace App\Console\Commands;

use App\Mail\ExpiryReminderMail;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\User;
use Illuminate\Support\Carbon;

class ExpiryReminder extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'reminder:expiry';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Artisan command to send Expiry reminder';

  /**
   * Check each users borrowed book's expiry date 
   * is equal to todays date
   * if true send the user a Reminder email
   * This was taken from a youtube video by code with Dary here:
   * https://www.youtube.com/watch?v=vZYRDRF4yF4&t=543s
   *
   */
  public function handle()
  {
    $users = User::all();
    foreach ($users as $user) {
      foreach ($user->booksBorrowed as $book) {
        $date = $user->getExpiryDate($book->id);
        $today = Carbon::now();
        $today = Carbon::parse($today)->toDateString();
        if ($date <= $today) {
          $mailData = [
            'username' => $user->name,
            'book_name' => $book->title,
            'expiry_date' => $date
          ];
          Mail::to($user->email)->send(new ExpiryReminderMail($mailData));
        }
      }
    }
  }
}
