<ul class="review-list">
    @forelse($restaurant->reviews as $review)                
        <div class="review">
            <li>
                <span class="review-title">{{ $review->title }}, by {{$review->user->name }}</span> <br>
                <span class="review-score">score: {{ $review->score }}</span><br>
                <span class="review-comment">{{ $review->comment }}</span>
            </li>                                
        </div>             
    @empty                    
        <p class="food">The restaurant {{ $restaurant->name }} does not have reviews yet.</p>
        <p class="food">Be the first.</p>
    @endforelse
</ul>