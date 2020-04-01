<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Restaurant;
use App\Review;

class ReviewTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/users');

    //     $response->assertStatus(200);
    // }  
    /** @test */ 
    public function review_has_user()
    {          
        $review = factory(Review::class)->create();        
        $user = $review->user;   
        
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user, User::find($user->id));                 
    }

    /** @test */ 
    public function review_has_restaurant()
    {       
        $review = factory(Review::class)->create();
        $restaurant = $review->restaurant;        
       
        $this->assertInstanceOf(Restaurant::class, $restaurant);
        $this->assertEquals($restaurant, Restaurant::find($restaurant->id));
    }
    
    /** @test */ 
    public function readReview_test1()
    {
        $expected = factory(Review::class)->create();

        $actual = new Review;
        $result = $actual->readReview($expected->id);

        $this->assertTrue($result);
        $this->assertEquals($expected->attributes, $actual->attributes);
    }

    /** @test */ 
    public function readReview_test2()
    {    
        $reviewTest = new Review;
        $result = $reviewTest->readReview(99);

        $this->assertFalse($result);        
    }

    /** @test */ 
    public function updateReview_test1()
    {
        $expected = factory(Review::class)->create();                

        $expected->score = 0;
        $expected->comment = "new comment";
        $expected->updateReview();

        $actual = new Review;
        $result = $actual->readReview($expected->id);

        $this->assertTrue($result);
        $this->assertEquals($expected->comment, $actual->comment);
        $this->assertEquals($expected->score, $actual->score);        
    }

    /** @test */ 
    public function updateReview_test2()
    {
        $review = new Review;
        $review->id = 99;
        $review->title = "title not exists";
        $review->comment = "This review does not exist in the database.";
        $review->score = 1;
        $review->user_id = 1;
        $review->restaurant_id = 1;

        $result = $review->updateReview();
        $result2 = $review->readReview($review->id);

        $this->assertFalse($result);        
        $this->assertFalse($result2);
    }

    /** @test */ 
    public function deleteReview_test1()
    {
        $review = factory(Review::class)->create();

        $result = Review::deleteReview($review->id);

        $this->assertTrue($result);
    }

    /** @test */ 
    public function deleteReview_test2()
    {
        $review = new Review;
        $review->id = 99;
        $review->title = "title not exists";
        $review->comment = "This review does not exist in the database.";
        $review->score = 1;
        $review->user_id = 1;
        $review->restaurant_id = 1;

        $result = Review::deleteReview($review->id);
        $result2 = $review->readReview($review->id);

        $this->assertFalse($result);        
        $this->assertFalse($result2);
    }

    /** @test */ 
    public function createReview_test1()
    {
        $review = new Review;        
        $review->title = "title test";
        $review->comment = "This review does not exist in the database.";
        $review->score = 1;
        $review->user_id = 1;
        $review->restaurant_id = 1;

        $result = Review::createReview($review);
        $result2 = $review->readReview($review->id);

        $this->assertTrue($result);        
        $this->assertTrue($result2);
    }

    /** @test */ 
    public function create_delete_Review_test()
    {
        $restaurant = factory(Restaurant::class)->create();        
        $user1 = factory(User::class, 'Client')->create();
        $user2 = factory(User::class, 'AdminApp')->create();;

        $user1->role_id = $user2->role_id = 3; // client role

        $review1 = new Review;        
        $review1->title = "title by user1";
        $review1->comment = "Comment by user1";
        $review1->score = 1;
        $review1->user_id = $user1->id;
        $review1->restaurant_id = $restaurant->id;

        $this->assertEquals(0, $restaurant->number_reviews);
        $result = Review::createReview($review1);
        $restaurant = Restaurant::find($restaurant->id);
        $this->assertEquals(1, $restaurant->number_reviews);

        $review2 = new Review;       
        $review2->title = "title by user2"; 
        $review2->comment = "Comment by user2";
        $review2->score = 2;
        $review2->user_id = $user2->id;
        $review2->restaurant_id = $restaurant->id;
        
        $result2 = Review::createReview($review2);        
        $restaurant = Restaurant::find($restaurant->id);        
        $this->assertEquals(2, $restaurant->number_reviews);

        $this->assertTrue($result);        
        $this->assertTrue($result2);

        $result = Review::deleteReview($review1->id);
        $restaurant = Restaurant::find($restaurant->id);        
        $this->assertEquals(1, $restaurant->number_reviews);

        $result2 = Review::deleteReview($review2->id);
        $restaurant = Restaurant::find($restaurant->id);        
        $this->assertEquals(0, $restaurant->number_reviews);

        $this->assertTrue($result);        
        $this->assertTrue($result2);
    }

    /** @test */ 
    public function listReviewsByDate_test1()
    {
        $restaurant = $this->aux_listReviews();
        $reviews = Review::listReviewsByDate($restaurant, true);

        $review_last = $reviews[0];
        foreach($reviews as $review)
        {
            $this->assertTrue($review_last->created_at <= $review->created_at);
            $review_last = clone $review;
        }
    }

    /** @test */ 
    public function listReviewsByDate_test2()
    {
        $restaurant = $this->aux_listReviews();
        $reviews = Review::listReviewsByDate($restaurant, false);

        $review_last = $reviews[0];
        foreach($reviews as $review)
        {
            $this->assertTrue($review_last->created_at >= $review->created_at);
            $review_last = clone $review;
        }
    }

    /** @test */ 
    public function listReviewsByScore_test1()
    {
        $restaurant = $this->aux_listReviews();
        $reviews = Review::listReviewsByScore($restaurant, true);

        $review_last = $reviews[0];
        foreach($reviews as $review)
        {                     
            $this->assertTrue($review_last->score <= $review->score);
            $review_last = clone $review;
        }
    }

    /** @test */ 
    public function listReviewsByScore_test2()
    {
        $restaurant = $this->aux_listReviews();
        $reviews = Review::listReviewsByScore($restaurant, false);

        $review_last = $reviews[0];
        foreach($reviews as $review)
        {
            $this->assertTrue($review_last->score >= $review->score);
            $review_last = clone $review;
        }
    }

    private function aux_listReviews()
    {
        $restaurant = factory(Restaurant::class)->create();        
        $user1 = factory(User::class, 'Client')->create();
        $user2 = factory(User::class, 'AdminApp')->create();                

        $user1->role_id = $user2->role_id = 3; // client role

        $review1 = new Review;        
        $review1->title = "title by user1";
        $review1->comment = "Comment by user1";
        $review1->score = 1;
        $review1->user_id = $user1->id;
        $review1->restaurant_id = $restaurant->id;

        $review2 = new Review;        
        $review2->title = "title by user2";
        $review2->comment = "Comment by user2";
        $review2->score = 2;
        $review2->user_id = $user2->id;
        $review2->restaurant_id = $restaurant->id;
        
        Review::createReview($review1);        
        Review::createReview($review2);                

        return $restaurant;
    }
}