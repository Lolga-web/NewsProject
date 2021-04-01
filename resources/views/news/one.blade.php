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
                <div class="news_list">
                    @if ($news->category)
                        @forelse($categoryNews as $item)
                            @if ($item->id !== $news->id)

                                @include('templates.newsItem', ['item' => $item])

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

            @include('templates.newsByCategories', ['news' => $allNewsByCategories])
           
        </div>

        @include('templates.rightsection', ['news' => $newNews, 'title' => 'Последние новости'])
        
    </div>   
@endsection
