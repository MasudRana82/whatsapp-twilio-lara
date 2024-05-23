<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Exception;

class WhatsAppController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('sendmessage');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
        $recipientNumber = "whatsapp:".$request->phone;
        $message = $request->message;

        try {
            $twilio = new Client($twilioSid, $twilioToken);
            $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => "whatsapp:+" . $twilioWhatsAppNumber,
                    "body" => $message,
                ]
            );

            return back()->with(['success' => 'WhatsApp message sent successfully!']);
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
            // dd($e);
        }
    }
}
