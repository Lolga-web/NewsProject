<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Services\CurrencyExchangeRate as Rate;

class NewsController extends Controller
{
        public function index(News $news) 
        {
            $news = News::orderByDesc('date')->paginate(30);
            return view('news.index')
                    ->with('news', $news);
        }

        public function show(News $news, Rate $rate) 
        {
            $newNews = News::orderByDesc('date')
                                ->take(10)
                                ->get();

            $categoryNews = News::where('category_id', $news->category_id)
                                ->where('id', '!=', $news->id)
                                ->orderByDesc('date')
                                ->take(6)
                                ->get();

            $allNewsByCategories = Category::with(['news' => function ($query) {
                $query->orderByDesc('date');
            }])->orderBy('title')->get();

            $rate = $rate->currencyExchangeRate(['USD/RUB', 'EUR/RUB']);
        
            return view('news.one')
                    ->with('rate', $rate)
                    ->with('news', $news)
                    ->with('categoryNews', $categoryNews)
                    ->with('newNews', $newNews)
                    ->with('allNewsByCategories', $allNewsByCategories);
        }

}
