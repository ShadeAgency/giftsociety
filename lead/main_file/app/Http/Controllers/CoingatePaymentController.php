<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Plan;
use App\Models\UserCoupon;
use App\Models\Utility;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CoinGate\CoinGate;
use App\Models\InvoicePayment;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;

class CoingatePaymentController extends Controller
{
    //


    public $mode;
    public $coingate_auth_token;
    public $is_enabled;
    public $currancy;
    
    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function invoicePayWithCoingate(Request $request){
       

        $validatorArray = [
            'amount' => 'required',
            'invoice_id' => 'required'
        ];
        $validator      = Validator::make(
            $request->all(), $validatorArray
        )->setAttributeNames(
            ['invoice_id' => 'Invoice']
        );
        if($validator->fails())
        {
            return Utility::error_res($validator->errors()->first());
        }
        $invoice = Invoice::find($request->invoice_id);
        if(\Auth::check())
        {
             $user = Auth::user();
        }
        else
        {
           $user=User::where('id',$invoice->created_by)->first();
        }
         if(\Auth::check())
            {
                 $user = Auth::user();
                 $this->paymentSetting();
            }else{

                $admin_payment_setting = Utility::non_auth_payment_settings($user->id);
                $this->currancy =isset($admin_payment_setting['currency'])?$admin_payment_setting['currency']:'';
                $this->coingate_auth_token = isset($admin_payment_setting['coingate_auth_token'])?$admin_payment_setting['coingate_auth_token']:'';
                $this->mode = isset($admin_payment_setting['coingate_mode'])?$admin_payment_setting['coingate_mode']:'off';
                $this->is_enabled = isset($admin_payment_setting['is_coingate_enabled'])?$admin_payment_setting['is_coingate_enabled']:'off';
                
            }
        if($invoice->getDue() < $request->amount){
            return Utility::error_res('not correct amount');
        }

        CoinGate::config(
            array(
                'environment' => $this->mode,
                'auth_token' => $this->coingate_auth_token,
                'curlopt_ssl_verifypeer' => FALSE
            )
        );

        $post_params = array(
            'order_id' => time(),
            'price_amount' => $request->amount,
            'price_currency' => $this->currancy,
            'receive_currency' => $this->currancy,
            'callback_url' => route('invoice.coingate',encrypt([$request->invoice_id])),
            'cancel_url' => route('invoice.coingate',encrypt([$request->invoice_id])),
            'success_url' => route('invoice.coingate',encrypt([$request->invoice_id])),
            'title' => 'Invoice #' . time(),
        );

        $order = \CoinGate\Merchant\Order::create($post_params);
        if($order)
        {
            $data = [
                'amount' => $request->amount
            ];
            session()->put('coingate_data', $data);
            return redirect($order->payment_url);
        }
        else
        {
            return redirect()->back()->with('error', __('opps something wren wrong.'));
        }
    }

    public function getInvociePaymentStatus(Request $request,$invoice_id){
        if(!empty($invoice_id))
        {
            $invoice_id = decrypt($invoice_id);
            $invoice    = Invoice::find($invoice_id);
            $invoices=Invoice::where('id',$invoice_id)->first();
             if(\Auth::check())
            {
                 $user = Auth::user();
            }
            else
            {
               $user=User::where('id',$invoices->created_by)->first();

            }

            if($invoices)
            {
                try
                {
                    if(session()->has('coingate_data'))
                    {
                        $get_data =  $request->session()->get('invoice_data') ;
                      
                        $invoice_payment                 = new InvoicePayment();
                        $invoice_payment->transaction_id = app('App\Http\Controllers\InvoiceController')->transactionNumber($user);
                        $invoice_payment->invoice_id     = $invoices->invoice_id;
                        $invoice_payment->amount         =  isset($get_data['total_price'])?$get_data['total_price']:0;
                      
                        $invoice_payment->date           = date('Y-m-d');
                        $invoice_payment->payment_id     = 0;
                        $invoice_payment->payment_type   = __('CoinGate');
                        $invoice_payment->client_id      =  $user->id;
                        $invoice_payment->notes          = '';
                        $invoice_payment->save();

                        

                        if(($invoices->getDue() - $invoice_payment->amount) == 0)
                        {
                            $invoices->status = 'paid';
                            $invoices->save();
                        }

                        $settings  = Utility::settings($invoices->created_by);
                        
                        if(isset($settings['payment_notification']) && $settings['payment_notification'] ==1){
                            $msg = ucfirst($user->name) .' paid '.$invoice_payment->amount.'.'; 
                           
                            Utility::send_slack_msg($msg);
                        }
                        if(isset($settings['telegram_payment_notification']) && $settings['telegram_payment_notification'] ==1){
                            $resp =ucfirst($user->name) .' paid '.$invoice_payment->amount.'.';  
                            \Utility::send_telegram_msg($resp);    
                        }

                        if(\Auth::check())
                        {
                            return redirect()->route('invoices.show', $invoice_id)->with('success', __('Payment added Successfully'));
                        }
                        else
                        {
                             return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('success', __('Payment added Successfully'));
                        }
                        
                    }else{

                        if(\Auth::check())
                        {
                             return redirect()->route('invoices.show',$invoice_id)->with('error', __('Transaction has been failed! '));
                        }
                        else
                        {
                            return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Transaction has been failed! '));
                        }
                       
                    }
                }
                catch(\Exception $e)
                {
                    if(\Auth::check())
                    {
                         return redirect()->route('invoices.index')->with('error', __('Invoice not found.'));
                    }
                    else
                    {
                        return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Invoice not found.'));
                    }
                   
                }
            }else{
                 if(\Auth::check())
                    {
                       return redirect()->route('invoices.show',$invoice_id)->with('error', __('Invoice not found.'));
                    }
                    else
                    {
                        return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Invoice not found.'));
                    }
                
            }
        }else{
            if(\Auth::check())
            {
               return redirect()->route('invoices.index')->with('error', __('Invoice not found.'));
            }
            else
            {
                return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Invoice not found.'));
            }
            
        }
    }


    public function paymentSetting()
    {
        $admin_payment_setting = Utility::payment_settings();
        $this->currancy =isset($admin_payment_setting['currency'])?$admin_payment_setting['currency']:'';
        $this->coingate_auth_token = isset($admin_payment_setting['coingate_auth_token'])?$admin_payment_setting['coingate_auth_token']:'';
        $this->mode = isset($admin_payment_setting['coingate_mode'])?$admin_payment_setting['coingate_mode']:'off';
        $this->is_enabled = isset($admin_payment_setting['is_coingate_enabled'])?$admin_payment_setting['is_coingate_enabled']:'off';

        return;
    }
}
