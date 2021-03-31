@extends('layouts.main')

@section('title', 'Главная')

@section('content')
    <h1 class="main_title">Главная</h1>
    
    <div class="main_page_container">
        <div class="main_section">
            <div class="last_news">
                
            </div>
        </div>

        <div class="right_section">
            @if ($popularNews)
                <div class="currency_exchange_rate">
                    <p>Курс ЦБ</p> 
                    <p>USD: <span>{{ $rate['USD/RUB'] }}</span></p>
                    <p>EUR: <span>{{ $rate['EUR/RUB'] }}</span></p>
                </div>
                <div class="new_news">
                    <h1 class="new_news_title">Главные новости</h1>
                    @forelse($popularNews as $item)
                        <div class="new_news_item">
                            <a class="new_news_item_title" href="{{ route('news.show', $item) }}">
                                {{ $item->title }}
                            </a>
                        </div>
                    @empty
                        <p>Нет новостей</p>
                    @endforelse
                </div>
            @endif 
        </div>
    </div>
@endsection
