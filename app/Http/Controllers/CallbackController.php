<?php

namespace App\Http\Controllers;

use App\Models\SmsStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    public function receiveCallback(Request $request)
    {
        // Highly recommend you verify the webhook signature before executing any logic below
        // https://www.twilio.com/docs/usage/webhooks/webhooks-security?code-sample=code-validate-signature-of-request&code-language=PHP&code-sdk-version=6.x
        $callbackStatus = $request->toArray();
//        {
//            "ErrorCode": "30002",
//          "SmsSid": "SM2e9f913244434d63b7bca5064142acea",
//          "SmsStatus": "failed",
//          "MessageStatus": "failed",
//          "To": "+16126551428",
//          "MessageSid": "SM2e9f913244434d63b7bca5064142acea",
//          "AccountSid": "ACda2df570c083ae33c5676fcfd94f2353",
//          "From": "+16122481105",
//          "ApiVersion": "2010-04-01"
//        }

        Log::info('Message Sid:', [$callbackStatus['MessageSid']]);
        Log::info('Message Status:', [$callbackStatus['MessageStatus']]);

        // Fetch a match on the message_sid, if no match, create one with additional values
        $currentStatus = SmsStatus::firstOrNew(
            ['message_sid' => $callbackStatus['MessageSid']],
            [
                'to_number' => $callbackStatus['To'],
                'from_number' => $callbackStatus['From'],
            ]
        );

        $currentStatus->status = $callbackStatus['MessageStatus'];
        $currentStatus->save();

        // https://support.twilio.com/hc/en-us/articles/223134347-What-are-the-Possible-SMS-and-MMS-Message-Statuses-and-What-do-They-Mean-
        if ($callbackStatus['MessageStatus'] === 'failed' || $callbackStatus['MessageStatus'] === 'undelivered' ) {
            // Do some additional logic, maybe a resend?
            // Also not sure if Undelivered provides an error code as it is coming from the carrier at this point
            Log::error('Message Send Unsuccessful', $callbackStatus);
            $currentStatus->error_code = $callbackStatus['ErrorCode'];
            $currentStatus->save();
        }

        return response()->json(['success'=>'true']);
    }
}
