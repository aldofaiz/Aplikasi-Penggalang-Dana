<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Midtrans\Config;
use \Midtrans\Snap;
use \Midtrans\Notification;

class DonationController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function create(Program $program)
    {
        if($program->program_status == "published")
        {
            $category = $program->category;
            $donor = Donor::where('user_id', '=', Auth::user()->id)->first();
            return view('web.content.donation',compact('program', 'donor','category'));
        }else{
            return abort(404);
        }   
    }

    public function store(Request $request)
    {
        \DB::transaction(function() use($request) {
            $donation = Donation::create([
                'donor_id' => $request->donor_id,
                'program_id' => $request->program_id,
                'donation_code' => 'SANDBOX-' . uniqid(),
                'amount' => floatval($request->amount),
                'note' => $request->note,
                'alias' => $request->alias,
            ]);

            $program = $donation->program;
            $donor = $donation->donor;
            $user = $donor->user;

            $payload = [
                'transaction_details' => [
                    'order_id'      => $donation->donation_code,
                    'gross_amount'  => $donation->amount,
                ],
                'customer_details' => [
                    'first_name'    => $user->name,
                    'email'         => $user->email,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => $program->program_title,
                        'price'    => $donation->amount,
                        'quantity' => 1,
                        'name'     => ucwords(str_replace('_', ' ', $program->program_title))
                    ]
                ]
            ];
            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $donation->snap_token = $snapToken;
            $donation->save();

            $this->response['snap_token'] = $snapToken;
        });

        return response()->json($this->response);
        
    }

    public function notification(Request $request)
    {
        $notif = new \Midtrans\Notification();
        \DB::transaction(function() use($notif) {

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status;
            $donation = Donation::where('donation_code', $orderId)->first();

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {

                if($fraud == 'challenge') {
                    $donation->setStatusPending();
                } else {
                    $donation->setStatusSuccess();
                }

                }
            } elseif ($transaction == 'settlement') {
                    $donation->setStatusSuccess();
            } elseif($transaction == 'pending'){
                $donation->setStatusPending();
            } elseif ($transaction == 'deny') {
                $donation->setStatusFailed();
            } elseif ($transaction == 'expire') {
                $donation->setStatusExpired();
            } elseif ($transaction == 'cancel') {
                $donation->setStatusFailed();
            }
        });

        return;
    }
}
