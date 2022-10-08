<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Models\InvoicePayment;
use App\Models\Utility;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PaypalController extends Controller
{
    private $_api_context;

    public $paypal_client_id;
    public $paypal_mode;
    public $paypal_secret_key;
    public $currancy_symbol;
    public $currancy;

    public function setApiContext($user)
    {
        if(\Auth::check())
        {
             $user = Auth::user();
             $this->paymentSetting();
        }else{

            $admin_payment_setting = Utility::non_auth_payment_settings($user->id);
            $this->currancy_symbol = isset($admin_payment_setting['currency_symbol'])?$admin_payment_setting['currency_symbol']:'';
        $this->currancy = isset($admin_payment_setting['currency'])?$admin_payment_setting['currency']:'';
        $this->paypal_client_id = isset($admin_payment_setting['paypal_client_id'])?$admin_payment_setting['paypal_client_id']:'';
        $this->paypal_mode = isset($admin_payment_setting['paypal_mode'])?$admin_payment_setting['paypal_mode']:'';
        $this->paypal_secret_key = isset($admin_payment_setting['paypal_secret_key'])?$admin_payment_setting['paypal_secret_key']:'';
        }
       


       

        $settings = Utility::settings();

        //$this->paymentSetting();

        $paypal_conf = config('paypal');

        if($user->type == 'Client')
        {
            $paypal_conf['settings']['mode'] = $this->paypal_mode;
            $paypal_conf['client_id']        = $this->paypal_client_id;
            $paypal_conf['secret_key']       = $this->paypal_secret_key;
        }
        else
        {
           $paypal_conf['settings']['mode'] = $this->paypal_mode;
            $paypal_conf['client_id']        = $this->paypal_client_id;
            $paypal_conf['secret_key']       = $this->paypal_secret_key; 
        }

        $this->_api_context = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['client_id'], $paypal_conf['secret_key']
            )
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function clientPayWithPaypal(Request $request, $invoice_id)
    {

       
//$this->paymentSetting();


        $settings = Utility::settings();

        $get_amount = $request->amount;

        $request->validate(['amount' => 'required|numeric|min:0']);

        $invoice = Invoice::find($invoice_id);

      

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
            $this->currancy_symbol = isset($admin_payment_setting['currency_symbol'])?$admin_payment_setting['currency_symbol']:'';
        $this->currancy = isset($admin_payment_setting['currency'])?$admin_payment_setting['currency']:'';
        $this->paypal_client_id = isset($admin_payment_setting['paypal_client_id'])?$admin_payment_setting['paypal_client_id']:'';
        $this->paypal_mode = isset($admin_payment_setting['paypal_mode'])?$admin_payment_setting['paypal_mode']:'';
        $this->paypal_secret_key = isset($admin_payment_setting['paypal_secret_key'])?$admin_payment_setting['paypal_secret_key']:'';
        }

        if($invoice)
        {
            if($get_amount > $invoice->getDue())
            {
                return redirect()->back()->with('error', __('Invalid amount.'));
            }
            else
            {
                $this->setApiContext($user);

                $name = $settings['company_name'] . " - " . $user->invoiceNumberFormat($invoice->invoice_id);

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName($name)->setCurrency($settings['site_currency'])->setQuantity(1)->setPrice($get_amount);

                $item_list = new ItemList();
                $item_list->setItems([$item_1]);

                $amount = new Amount();
                $amount->setCurrency($settings['site_currency'])->setTotal($get_amount);

                $transaction = new Transaction();
                $transaction->setAmount($amount)->setItemList($item_list)->setDescription($name);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(route('client.get.payment.status', $invoice->id))->setCancelUrl(route('client.get.payment.status', $invoice->id));

                $payment = new Payment();
                $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions([$transaction]);

                try
                {
                    $payment->create($this->_api_context);
                }
                catch(\PayPal\Exception\PayPalConnectionException $ex) //PPConnectionException
                {
                    if(\Config::get('app.debug'))
                    {
                        if(\Auth::check())
                        {
                            return redirect()->route('invoices.show', $invoice_id)->with('error', __('Connection timeout'));
                        }
                        else
                        {
                            return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Connection timeout'));
                        }
                    
                    }
                    else
                    {
                        if(\Auth::check())
                        {
                            return redirect()->route('invoices.show', $invoice_id)->with('error', __('Some error occur, sorry for inconvenient'));
                        }
                        else
                        {
                            return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Some error occur, sorry for inconvenient'));
                        }
                       
                    }
                }
                foreach($payment->getLinks() as $link)
                {
                    if($link->getRel() == 'approval_url')
                    {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }
                Session::put('paypal_payment_id', $payment->getId());
                if(isset($redirect_url))
                {
                    return Redirect::away($redirect_url);
                }

                if(\Auth::check())
                {
                     return redirect()->route('invoices.show', $invoice_id)->with('error', __('Unknown error occurred'));
                }
                else
                {
                    return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Unknown error occurred'));
                }
                
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function clientGetPaymentStatus(Request $request, $invoice_id)
    {
        //$this->paymentSetting();

        $invoice = Invoice::find($invoice_id);
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
            $this->currancy_symbol = isset($admin_payment_setting['currency_symbol'])?$admin_payment_setting['currency_symbol']:'';
        $this->currancy = isset($admin_payment_setting['currency'])?$admin_payment_setting['currency']:'';
        $this->paypal_client_id = isset($admin_payment_setting['paypal_client_id'])?$admin_payment_setting['paypal_client_id']:'';
        $this->paypal_mode = isset($admin_payment_setting['paypal_mode'])?$admin_payment_setting['paypal_mode']:'';
        $this->paypal_secret_key = isset($admin_payment_setting['paypal_secret_key'])?$admin_payment_setting['paypal_secret_key']:'';
        }
       

      

        if($invoice)
        {
            $this->setApiContext($user);

            $payment_id = Session::get('paypal_payment_id');

            Session::forget('paypal_payment_id');

            if(empty($request->PayerID || empty($request->token)))
            {
                if(\Auth::check())
                {
                    return redirect()->route('invoices.show', $invoice_id)->with('error', __('Payment failed'));
                }
                else
                {
                    return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Payment failed'));
                }
                
            }

            $payment   = Payment::get($payment_id, $this->_api_context);

            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            try
            {
                $result = $payment->execute($execution, $this->_api_context)->toArray();

                $status = ucwords(str_replace('_', ' ', $result['state']));

                if($result['state'] == 'approved')
                {
                    $invoice_payment = new InvoicePayment();
                    $invoice_payment->transaction_id =  app('App\Http\Controllers\InvoiceController')->transactionNumber($user);
                    $invoice_payment->invoice_id = $invoice->id;
                    $invoice_payment->amount = $result['transactions'][0]['amount']['total'];
                    $invoice_payment->date = date('Y-m-d');
                    $invoice_payment->payment_id = 0;
                    $invoice_payment->payment_type = __('PAYPAL');
                    $invoice_payment->client_id = $user->id;
                    $invoice_payment->notes = '';
                    $invoice_payment->save();

                    if(($invoice->getDue() - $invoice_payment->amount) == 0) {
                        $invoice->status = 'paid';
                        $invoice->save();
                    }

                    $settings  = Utility::settings($invoice->created_by);

                    if(isset($settings['payment_notification']) && $settings['payment_notification'] ==1){
                        $msg = ucfirst($user->name) .' paid '.$result['transactions'][0]['amount']['total'].'.'; 
                       
                        Utility::send_slack_msg($msg);
                    }
                    if(isset($settings['telegram_payment_notification']) && $settings['telegram_payment_notification'] ==1){
                        $resp = ucfirst($user->name) .' paid '.$result['transactions'][0]['amount']['total'].'.';
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

                    
                }
                else
                {
                    if(\Auth::check())
                    {
                        return redirect()->route('invoices.show', $invoice_id)->with('error', __('Transaction has been ' . $status));
                    }
                    else
                    {
                        return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Transaction has been'));
                    }
                    
                }

            } catch(\Exception $e) {
                if(\Auth::check())
                {
                    return redirect()->route('invoices.show', $invoice_id)->with('error', __('Transaction has been failed!'));
                }
                else
                {
                    return redirect()->route('pay.invoice',\Crypt::encrypt($invoice_id))->with('error', __('Transaction has been'));
                }
                
            }
        } else {
            return redirect()->back()->with('error',__('Permission denied.'));
        }
    }

    public function paymentSetting(){

        $admin_payment_setting = Utility::payment_settings();

        $this->currancy_symbol = isset($admin_payment_setting['currency_symbol'])?$admin_payment_setting['currency_symbol']:'';
        $this->currancy = isset($admin_payment_setting['currency'])?$admin_payment_setting['currency']:'';
        $this->paypal_client_id = isset($admin_payment_setting['paypal_client_id'])?$admin_payment_setting['paypal_client_id']:'';
        $this->paypal_mode = isset($admin_payment_setting['paypal_mode'])?$admin_payment_setting['paypal_mode']:'';
        $this->paypal_secret_key = isset($admin_payment_setting['paypal_secret_key'])?$admin_payment_setting['paypal_secret_key']:'';

        return;
    }
}
