<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Settings;
use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //print_r(Transaction::orderBy('created_at', 'DESC')->get()); die;
        return view('backend.transactions.index')->with('transactions', Transaction::orderBy('created_at', 'DESC')->get());
    }
    public function invoice($transaction_id)
    {
        // $pdf = \PDF::loadView('emails.invoicepdf')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // $pdf->setPaper('a4', 'landscape')->setWarnings(false)->save('storage/pdf/'.$idss.'-invoice.pdf');
        // $pdurl = 'storage/pdf/'.$idss.'-invoice.pdf';
        $transaction = Transaction::find($transaction_id);
        if(!!empty($transaction)) abort(419);

        @session_start();
        $_SESSION['invoice'] = [
            'inv_num'   => sprintf("EMT%06d", $transaction_id),
            'inv_date'  => date('F j, Y'),
            'due_date'  => date('F j, Y', strtotime($transaction->created_at)),
            'inv_from'  => [ env('INVOICE_COMPANY'), env('INVOICE_ADDRESS'), env('INVOICE_PHONE'), env('INVOICE_EMAIL') ],
            'inv_to'    => [ $transaction->company, $transaction->address, $transaction->telephone, $transaction->mail_addr ],
            'items'     => [
                [
                    'mail test' .' '.$transaction->type, 
                    $transaction->price_type . ' purchase', 
                    $transaction->qty, 
                    $transaction->amount - $transaction->price * $transaction->qty,  // vat amount
                    $transaction->price,                //price 
                    $transaction->coupon_amount ?? '',  //discount
                    //$transaction->price * $transaction->qty - ($transaction->coupon_amount ?? 0),
                ],
            ],
            'sub_total' => $transaction->price * $transaction->qty - ($transaction->coupon_amount ?? 0),
            'vat' => $transaction->fee,
            'discount' => $transaction->coupon_amount ?? 0,
            'shipment' => 0,
            'total' => $transaction->amount,
        ];

        //include "../../invoice.php";        die;
        return redirect("/invoice.php?trans_no=" . $transaction_id);
        return view('emails.invoicepdf')->with([
            'invoice_number'=> sprintf("EMT%06d", $transaction_id),
            'invoice_date'  => date('F j, Y'),
            'firstname'     => $transaction->firstname ?? $transaction->buyer->name ?? $transaction->trash_mail->user->name,
            'lastname'      => $transaction->lastname,
            'city'          => $transaction->city,
            'address'       => $transaction->address,
            'state'         => $transaction->state,
            'phone'         => $transaction->telephone,
            'country'       => $transaction->country,
            'company'       => $transaction->company,
            'postcode'      => $transaction->postcode,
            'email'         => $transaction->mail_addr,
            'pay_id'        => $transaction->pay_id,
            'Authority'     => $transaction->authority,
            'bank'          => $transaction->bank,
            'type'          => $transaction->type,
            'target_email'  => $transaction->trash_mail->email,
            'price_type'    => $transaction->price_type,
            'qty'           => $transaction->qty,
            'price'         => $transaction->price,
            'fee_amount'    => $transaction->amount - $transaction->price*$transaction->qty,
            'vat_fee'       => $transaction->fee,
            'total'         => $transaction->amount,
        ]);

        //new Invoice($orderdata,$invoicedata,$pdurl)
        //dd($pdurl);
    }
}
