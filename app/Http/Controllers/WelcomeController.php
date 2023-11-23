<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ExpiryReminderMail;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\User;
use Illuminate\Support\Carbon;

class WelcomeController extends Controller
{

  /**
   * Show the Welcome page when a user visits 
   * website url
   * 
   */
  public function index()
  {

    return view('welcome');
  }
}
