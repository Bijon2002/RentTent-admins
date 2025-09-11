<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, $menu_id)
    {
        $menu = FoodMenu::findOrFail($menu_id);

        // 1️⃣ Validate payment form
        $request->validate([
            'cardholder' => 'required|string|max:255',
            'card_number' => 'required|string|min:12|max:19',
            'expiry' => 'required|string',
            'cvc' => 'required|string|min:3|max:4'
        ]);

        // 2️⃣ Prepare payment info JSON
        $card_number = preg_replace('/\D/', '', $request->card_number);
        $card_type = 'Unknown';
        if (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $card_number)) $card_type = 'Visa';
        elseif (preg_match('/^5[1-5][0-9]{14}$/', $card_number)) $card_type = 'MasterCard';
        elseif (preg_match('/^3[47][0-9]{13}$/', $card_number)) $card_type = 'Amex';

        $paymentInfo = json_encode([
            'cardholder' => $request->cardholder,
            'card_number' => $card_number,
            'card_type' => $card_type,
            'expiry' => $request->expiry,
        ]);

        // 3️⃣ Store subscription (correct foreign key!)
        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'vendor_id' => $menu->menu_id, // ✅ point to menu_id
            'amount' => $menu->monthly_fee,
            'status' => 'active',
            'payment_info' => $paymentInfo,
        ]);

        // 4️⃣ Generate QR code
        $qr_data = json_encode([
            'vendor' => $menu->user->name,
            'food' => $menu->name,
            'amount' => $menu->monthly_fee,
            'description' => $menu->description,
            'start_date' => $menu->start_date,
            'end_date' => $menu->end_date,
        ]);

        $qr_image = QrCode::size(300)->generate($qr_data);

        // 5️⃣ Send email with QR code
        Mail::send([], [], function ($message) use ($qr_image) {
            $message->to(Auth::user()->email)
                ->subject('Subscription Successful!')
                ->setBody('<h3>Thank you for subscribing!</h3><br>
                           <p>Scan this QR for your subscription details:</p>
                           <div>'.$qr_image.'</div>', 'text/html');
        });

        // 6️⃣ Return success view
        return view('pages.subscription-success', [
            'menu' => $menu,
            'qr_image' => $qr_image,
            'subscription' => $subscription,
        ]);
    }
}
