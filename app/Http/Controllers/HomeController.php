<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(News $news, Rate $rate)
    {
        $newNews = $news->orderByDesc('date')
                        ->take(10)
                        ->get();

        $popularNews = $news->inRandomOrder()
                        ->take(21)
                        ->get();

        $mainNews = $news->inRandomOrder()
                        ->take(10)
                        ->get();
                        
        $allNewsByCategories = Category::with(['news' => function ($query) {
            $query->orderByDesc('date');
        }])->orderBy('title')->get();

        $rate = $rate->currencyExchangeRate(['USD/RUB', 'EUR/RUB']);

        return view('index')
                    ->with('newNews', $newNews)
                    ->with('rate', $rate)
                    ->with('popularNews', $popularNews)
                    ->with('mainNews', $mainNews)
                    ->with('allNewsByCategories', $allNewsByCategories);
    }
}
