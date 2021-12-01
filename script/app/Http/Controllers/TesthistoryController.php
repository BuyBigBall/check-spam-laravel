<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Settings;
use App\Models\Post;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class TesthistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.testhistories.index')
                ->with('testhistories', TestResult::orderBy('received_at', 'DESC')->get());
    }
}
