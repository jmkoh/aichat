<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Customer;
use App\Models\PurchaseTransaction;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use DB; 
use Redirect;
class VoucherController extends Controller
{
    
    public function index() {
        return view('vouchers.index', [
            'vouchers' => Voucher::where(
                'customer_id', '=', null
            )
            ->orWhere(
                'status', '=', 'Active'
            )
            ->first()
        ]);
    } 
    public function redmn(Request $request, Voucher $voucher) {
        if($request->hasFile('image')){ 
            $voucher = Voucher::where('status', '=', 'Locked')
            ->where('customer_id', '=', $voucher->id)
            ->where('updated_at', '<', now()->addMinutes(10));
            $voucher->status = 'Closed';
            $voucher->save();

         }
    }
    public function check(Request $request, Voucher $voucher) {
        $formFields = $request->validate([         
            'email' => ['required', 'email'],
        ]);
        $id = Customer::where('email', $formFields['email'])->first(['id']);
        if(!$id) 
        {
            return Redirect::back()->withErrors(['msg' => 'Email does not match']);
        }
        //dd(Customer::find(1)->purchasetransactions);
        $purchasetransactionsCount = Customer::find($id->id)->purchasetransactions
        ->where('transaction_at', '>=', now()->subMonth())
        ->count();
        $purchasetransactionsTotal = Customer::find($id->id)->purchasetransactions
        ->where('transaction_at', '>=', now()->subMonth())
        ->sum('total_spent');

        $data = array(
            'id'=> $id
            );   
        if ($purchasetransactionsCount > 3 && $purchasetransactionsTotal > 100) 
        {
            $voucher = Voucher::where('status', '=', 'Active')->first();
            $voucher->customer_id = $id->id;
            $voucher->status = 'Locked';
            $voucher->save();
            return view('vouchers.show')->with($data);
        }
        else {
            return Redirect::back()->withErrors(['msg' => 'Not Eligible']);
            
        }
    } 
}
