@extends('layouts.main')

@section('title')
    @parent Категории
@endsection

@section('content')

    <h1 class="main_title">Категория: {{ $category }}</h1>

    <div class="news_wrp">
        <div class="news_list">
            @if ($category)
                @forelse($news as $item)
                
                    @include('templates.newsItem', ['item' => $item])

                @empty
                    <p>Нет новостей</p>
                @endforelse

                <div class="news_pagination">{{ $news->links() }}</div>
            @else
                <p>Нет такой категории</p> 
            @endif  
        </div>
    </div>

@endsection
