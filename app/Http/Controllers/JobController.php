<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function enqueue(Request $request)
    {
        $details = ['email' => 'client@example.com'];
        SendEmail::dispatch($details);
    }
}
