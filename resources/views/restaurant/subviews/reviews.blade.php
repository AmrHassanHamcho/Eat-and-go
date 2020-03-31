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

<div class="review-container">
    <h4>Write your opinion</h4>
    <form class="review-form" method="post" name="review-form" action="/restaurants/{{ $restaurant->id }}/reviews">
        @csrf        
        <input type="text" id="title-box" name="title" placeholder="Name your review.">
        <select id="score-list" name="score">
            <option disabled selected>Enter score</option>
            <option value="1">Score: 1</option>
            <option value="2">Score: 2</option>
            <option value="3">Score: 3</option>
            <option value="4">Score: 4</option>
            <option value="5">Score: 5</option>
        </select>           
        {{-- <input type="text" id="comment-box" name="comment" placeholder="Write your comment...">             --}}
        <textarea name="comment" id="comment-box" form="review-form" placeholder="Write your comment..."></textarea>
        <input type="submit" id="review-submit" value="Submit review">
    </form>
</div>