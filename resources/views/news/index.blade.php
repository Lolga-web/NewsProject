@extends('layouts.main')

@section('title', 'Новости')

@section('content')

    <h1 class="main_title">Все новости</h1>
  
    <div class="news_wrp">
        <div class="news_list">
            @forelse($news as $item)

                @include('templates.newsItem', ['item' => $item])

            @empty
                <p>Нет новостей</p>
            @endforelse

            <div class="news_pagination">{{ $news->links() }}</div>
            
        </div>
    </div>
   
@endsection
