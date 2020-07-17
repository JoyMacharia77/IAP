<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ReviewsResources;
use App\Review;
use App\Car;
class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews=Review::all()->toArray();
        return view('review.allReviews', compact('reviews'));
        //return ReviewsResources::collection($review);
    }

    public function create()
    {
        return view('review.addReview');
    }


    public function store(Request $request)
    { 
        $car=new Car();
        $request->validate([
        'car_id' => 'required',
        'car_review'=>'required',
        'car_rating'=>'required']);

        $input = $request->all();
        $review=new Review;
        $review->car_id=$request->input('car_id');
        $review->car_review=$request->input('car_review');
        $review->car_rating=$request->input('car_rating');
        $review->save();
       
        return new ReviewsResources($review);
    }

    public function show(Review $review)
    {
        $reviews=Review::find($review);
        return new ReviewsResources($reviews);
    }

    public function update(Request $request, Review $review)
    {
       //

    }

    public function destroy(Review $review)
    {
        $review -> delete();
         return response(['message' => 'Review Deleted Successfully']);
        }
    }