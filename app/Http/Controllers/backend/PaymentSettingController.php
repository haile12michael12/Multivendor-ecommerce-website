<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use App\Models\Chapa;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypalSetting = PaypalSetting::first();
        $Chapa = Chapa::first();




        return view('admin.payment-settings.index', compact('paypalSetting','Chapa'));
    }
}
