@extends('layouts.main')

@section('title', $news->title)

@section('content')
    <div class="one_news_container">
        <div class="main_section">

            <div class="one_news">
                @if ($news)
                    @if ($news->isPrivate && !Auth::user())
                        <p>Зарегистрируйтесь для просмотра</p>
                    @else
                        <h1 class="main_title">{{ $news->title }}</h1>
                        <div class="one_news_img" style="background-image: url({{ $news->image ?? asset('storage/default.jpg') }})"></div>
                        <p class="one_news_text">{!! $news->description !!}</p>
                    @endif
                @else
                    <p>Нет новости с таким id</p>
                @endif
            </div>

            <div class="news_in_category">
                <a class="news_in_category_link" href="{{ route('news.category.show', $news->category->slug) }}">
                    <h2 class="news_in_category_title">Другие материалы рубрики</h2>
                </a>
                <div class="news_in_category_list row">
                    @if ($news->category)
                        @forelse($categoryNews as $item)
                            @if ($item->id !== $news->id)
                                <div class="news_item col-md-6">
                                    <div class="news_item_date">
                                        <a href="{{ route('news.category.show', $item->category->slug) }}">
                                            <p class="news_item_category">{{ $item->category->title }}</p>
                                        </a>
                                        @if (date('d-m-Y', strtotime($item->date)) == date('d-m-Y'))
                                            Сегодня {{ date('H:i', strtotime($item->date)) }} 
                                        @else
                                            {{ date('d-m-Y', strtotime($item->date)) }}
                                        @endif
                                    </div>
                                    <div class="card-img-top news_item_img" 
                                        style="background-image: url({{ $item->image ?? asset('storage/default.jpeg') }})">    
                                    </div>
                                    <h2 class="news_item_title">{{ $item->title }}</h2>
                                    <div class="news_item_bottom">
                                        @if ($item->isPrivate && !Auth::user())
                                            <p class="news_item_more">Зарегистрируйтесь для просмотра</p>
                                        @else
                                            <a class="news_item_more" href="{{ route('news.show', $item) }}">Подробнее...</a>
                                        @endif
                                    </div>
                                </div>
                            @endif 
                        @empty
                            <p>Нет новостей</p>
                        @endforelse
                    @else
                        <p>Нет такой категории</p> 
                    @endif  
                    <a class="news_in_category_btn" href="{{ route('news.category.show', $news->category->slug) }}">
                        Больше новостей
                    </a>
                </div> 
            </div>

            <div class="categories_news_container">

                @foreach($allNewsByCategories as $category)
                    @if (count($category->news) >= 3)

                    <div class="categories_news_category">
                        <a href="{{ route('news.category.show', $category->slug) }}" class="category_news_link">
                            <h2 class="category_news_title">{{ $category->title }}</h2>
                        </a> 
                        
                        <div class="category_news_list">
                            @foreach($category->news as $item)
                                
                                @if ($loop->iteration <= 3)
                                <a class="category_news_item_link" href="{{ route('news.show', $item) }}">
                                    <div class="category_news_item">
                                        <div class="card-img-top category_news_item_img" 
                                            style="background-image: url({{ $item->image ?? asset('storage/default.jpeg') }})">   
                                        </div>
                                        <div class="category_news_item_container">
                                            <h3 class="category_news_item_title">{{ $item->title }}</h3>
                                            <div class="category_news_item_date">
                                                @if (date('d-m-Y', strtotime($item->date)) == date('d-m-Y'))
                                                    Сегодня {{ date('H:i', strtotime($item->date)) }} 
                                                @else
                                                    {{ date('d-m-Y', strtotime($item->date)) }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @else
                                    @break
                                @endif

                            @endforeach
                        </div>

                        <a href="{{ route('news.category.show', $category->slug) }}" class="category_news_bottom_link">Все материалы</a> 
                    </div>

                    @endif
                @endforeach
      
            </div>
        </div>

        <div class="right_section">
            @if ($newNews)
                <div class="currency_exchange_rate">
                    <p>Курс ЦБ</p> 
                    <p>USD: <span>{{ $rate['USD/RUB'] }}</span></p>
                    <p>EUR: <span>{{ $rate['EUR/RUB'] }}</span></p>
                </div>
                <div class="new_news">
                    <h1 class="new_news_title">Последние новости</h1>
                    @forelse($newNews as $item)
                        <div class="new_news_item">
                            <a class="new_news_item_title" href="{{ route('news.show', $item) }}">
                                <span class="new_news_item_date">{{ date('H:i', strtotime($item->date)) }}</span>
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
