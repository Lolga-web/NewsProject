<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Swap\Laravel\Facades;
use App\Models\News;
use App\Services\CurrencyExchangeRate as Rate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(News $news, Rate $rate)
    {
        $newNews = News::orderByDesc('date')
                        ->take(10)
                        ->get();

        $popularNews = News::inRandomOrder()
                        ->take(10)
                        ->get();
                        
        $rate = $rate->currencyExchangeRate(['USD/RUB', 'EUR/RUB']);

        return view('index')
                    ->with('newNews', $newNews)
                    ->with('rate', $rate)
                    ->with('popularNews', $popularNews);
    }
}
