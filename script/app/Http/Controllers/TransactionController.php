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
        return view('emails.invoicepdf')->with([
            'invoice_number'=>'VNT816',
            'invoice_date'  => date('F j, Y', strtotime('2021-12-11')),
            'firstname'     => 'Samir',
            'lastname'      => 'chakouri',
            'city'          => 'Gorod Krasnodar',
            'address'       => 'Krasnodar, Russia',
            'state'         => 'Krasnodar Russia',
            'phone'         => '5152463651',
            'country'       => 'Russia',
            'company'       => 'dev',
            'postcode'      => '123456',
            'email'         => 'yasha3651@mail.ru',
            'pay_id'        => 'cus_Kf5ew6n5wpp1AP',
            'Authority'     => 'pi_3JzlSg2eZvKYlo2C0kqoo2W9',
            'bank'          => 'paypal',
            'type'          => 'pending',
            'target_email'  => 'yakov.757@mail-analyzer.com',
            'price_type'    => 500,
            'qty'           => 1,
            'price'         => 50,
            'fee_amount'    => 10.50,
            'vat_fee'       => 21,
            'total'         => 60.50,
            
            
        ]);
        //dd($pdurl);
    }
}
