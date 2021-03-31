@extends('layouts.main')

@section('title', 'Главная')

@section('content')
    <h1 class="main_title">Главная</h1>
    
    <div class="main_page_container">
        <div class="main_section">
            <div class="last_news_list">
                @forelse($newNews as $item)
                    @if ($loop->first)
                        <a class="last_news_item_link" href="{{ route('news.show', $item) }}">
                            <div class="last_news_item">
                                <div class="last_news_item_img" style="background-image: url({{ $item->image ?? asset('storage/default.jpeg') }})"></div>
                                
                                <h2 class="last_news_item_title_first">
                                    <div class="last_news_item_date">
                                        @if (date('d-m-Y', strtotime($item->date)) == date('d-m-Y'))
                                            {{ date('H:i', strtotime($item->date)) }} 
                                        @else
                                            {{ date('d-m-Y', strtotime($item->date)) }}
                                        @endif
                                    </div>
                                    {{ $item->title }}
                                </h2>
                            </div>
                        </a>
                    @else
                    <a class="last_news_item_link" href="{{ route('news.show', $item) }}">
                        <div class="last_news_item">
                            <h2 class="last_news_item_title">
                                <div class="last_news_item_date">
                                    @if (date('d-m-Y', strtotime($item->date)) == date('d-m-Y'))
                                        {{ date('H:i', strtotime($item->date)) }} 
                                    @else
                                        {{ date('d-m-Y', strtotime($item->date)) }}
                                    @endif
                                </div>
                                {{ $item->title }}
                            </h2>
                        </div>
                    </a>
                    @endif
                    
                @empty
                    <p>Нет новостей</p>
                @endforelse   
                <a class="news_in_category_btn" href="{{ route('news.index') }}">
                    Больше новостей
                </a>              
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
