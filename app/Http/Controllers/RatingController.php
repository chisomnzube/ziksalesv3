<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($token)
    {
        $rating = Rating::where('token', $token)->first();

        if (!$rating) 
            {
                return redirect()->route('landingpage')->with('success_message', 'Invalid Token!');
            }

        $checkRating = Review::where('token', $token)->get()->count();
        if ($checkRating > 0) 
            {
                return redirect()->route('landingpage')->with('success_message', 'You have already rated the product');
            }
        $order = Order::find($rating->order_id);

        return view('rating.create')->with([
                    'rating' => $rating,
                    'order' => $order,
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rating = Rating::where('token', $request->input('Thetoken'))->first();
        if (!$rating) 
            {
                return redirect()->route('landingpage')->with('success_message', 'Invalid Token!');
            }

        $request->validate([
            'rating' => 'required|integer',
            'review' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ]);


        $rating->update([
            'star' => $request->input('rating'),  
            'review' => $request->input('review'),  
            'remit' => 1,
        ]);

        return redirect()->route('landingpage')->with([
            'success_message' => 'Your review have been submitted successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
