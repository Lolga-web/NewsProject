
<div class="news_item">

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

    <div class="news_item_img" 
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