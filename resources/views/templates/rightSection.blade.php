
<div class="right_section">

    @if ($news)
        <div class="currency_exchange_rate">
            <p>Курс ЦБ</p> 
            <p>USD: <span>{{ $rate['USD/RUB'] }}</span></p>
            <p>EUR: <span>{{ $rate['EUR/RUB'] }}</span></p>
        </div>
        <div class="right_section_news">
            <h1 class="right_section_news_title">{{ $title }}</h1>
            @forelse($news as $item)
                <div class="right_section_news_item">
                    <a class="right_section_news_item_title" href="{{ route('news.show', $item) }}">
                        {{ $item->title }}
                    </a>
                </div>
            @empty
                <p>Нет новостей</p>
            @endforelse
        </div>
    @endif 

</div>