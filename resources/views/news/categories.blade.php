@extends('layouts.main')

@section('title', 'Категории')

@section('content')
    <h1 class="main_title">Категории новостей</h1>

    <div class="categories_list_container">
        <div class="categories_list">
            @forelse($categoriesWithNews as $category)
                <div class="categories_item btn btn-primary">
                    <a class="categories_item_link" href="{{ route('news.category.show', $category->slug) }}">
                        <h2 class="categories_item_title">{{ $category->title }}</h2>
                    </a>
                </div>
            @empty
                <p>Нет категорий</p> 
            @endforelse
        </div>
    </div>

    @include('templates.newsByCategories', ['news' => $categoriesWithNews])

@endsection
