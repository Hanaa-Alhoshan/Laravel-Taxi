<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cab_Ride;
use App\Models\User;
use App\Models\Account;
use App\Models\Pay_Action;

class PayController extends Controller
{
   public function pay(Request $request ){
      $cab_ride=Cab_Ride::find($request->id);
      $cab_ride->pay_type="elctronic";
      $cab_ride->save();
      $user= Auth::user();
      $account=Account::where('account_number', $request->account_number)->where('password', $request->password)->first();
      $pay_action=Pay_Action::create(['account_id'=>$account->account_id]);
      $pay_action->save();
      $cab_ride->account_number=$account->account_number;
      $cab_ride->password=$account->password;
      $cab_ride->balance=$account->balance;
      $cab_ride->stat=$account->stat;
      $cab_ride->date=$pay_action->date;
      $cab_ride->amount=$pay_action->amount;
      $m=json_encode(['data1'=>json_decode( $cab_ride)]);
      return $m;
  }
  
}
            


    
    
    
  
  
  

