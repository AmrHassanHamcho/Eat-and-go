<ul class="review-list">
    <form method="post" action="">
        @csrf
        @forelse($restaurant->reviews as $review)                
            <div class="review">            
                <li>
                    <span class="review-title">{{ $review->title }}, by {{$review->user->name }}</span> <br>
                    <span class="review-score">score: {{ $review->score }}</span><br>
                    <span class="review-comment">{{ $review->comment }}</span>                
                </li>                                  
                @if(Auth::user()->id == $review->user->id)
                    <div class="review-btns">                              
                        <button class="edit-btn" type="submit" name="review-btn" value="" formaction="/editReview/{{ $restaurant->id }}&{{ $review->id }}">Edit</button>
                    </div>
                @endif                    
            </div>             
        @empty                    
            <p class="food">The restaurant {{ $restaurant->name }} does not have reviews yet.</p>
            <p class="food">Be the first.</p>
        @endforelse
    </form>
</ul>

<div class="review-container">
    <h4>Write your opinion</h4>
    @include('error-list')
    <form class="review-form" method="post" id="review-form" action="/restaurants/{{ $restaurant->id }}/reviews">
        @csrf        
        <input type="text" id="title-box" name="title" placeholder="Name your review">
        <select id="score-list" name="score">
            <option disabled selected>Enter score</option>
            <option value="1">Score: 1</option>
            <option value="2">Score: 2</option>
            <option value="3">Score: 3</option>
            <option value="4">Score: 4</option>
            <option value="5">Score: 5</option>
        </select>           
        <textarea name="comment" id="comment-box" form="review-form" placeholder="Write your comment..." formaction="/restaurants/{{ $restaurant->id }}/reviews"></textarea>
        <input type="submit" id="review-submit" value="Submit review">
    </form>    
</div>