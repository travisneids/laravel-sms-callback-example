<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function sendSMS(Request $request)
    {
        $accountSid = getenv('TWILIO_ACCOUNT_SID');
        $authToken = getenv('TWILIO_AUTH_TOKEN');
        $twilioFromNumber = getenv('TWILIO_NUMBER');
        $twilioCallbackUri = getenv('TWILIO_CALLBACK_URL');

        $validatedData = $request->validate([
            'toNumber' => 'required',
            'body' => 'required',
        ]);

        $client = new Client($accountSid, $authToken);
        $client->messages->create($request->get('toNumber'), [
            'body' => $request->get('body'),
            'from' => $twilioFromNumber,
            'statusCallback' => $twilioCallbackUri . '/api/sms-callback'
        ]);

        return back()->with(['success' => "Messages on their way!"]);
    }
}
