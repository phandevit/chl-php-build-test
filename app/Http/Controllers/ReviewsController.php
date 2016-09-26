<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    /**
     * Add review page
     *
     * @param id
     * @return view
     */
    public function add($id)
    {
        return view('review-add');
    }

    /**
     * Save the review
     *
     * @param request, id product
     * @return view
     */
    public function store(Request $request, $id)
    {
        // Validate user input
        $rules = [
            'comments' => 'required',
            'rating'   => 'required|integer',
        ];
        $this->validate($request, $rules);

        $data = [
            'id_product' => $id,
            'comments'   => $request->input('comments'),
            'rating'     => $request->input('rating'),
            'approved'   => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Save to database
        DB::table('reviews')->insert($data);

        return view('review-add-success');
    }
}