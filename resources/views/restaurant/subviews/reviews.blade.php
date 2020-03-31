<ul class="review-list">
    @forelse($restaurant->reviews as $review)                
        <div class="review">
            <li>
                {{ $review->title }} <br>
                <span class="review-comment">{{ $review->comment }}</span>
            </li>                    
            <span class="score">{{ $review->score }}</button>  
        </div>             
    @empty                    
        <p class="food">The restaurant {{ $restaurant->name }} does not have reviews yet.</p>
        <p class="food">Be the first.</p>
    @endforelse
</ul>