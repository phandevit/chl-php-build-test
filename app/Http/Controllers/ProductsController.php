<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    private $file = 'products.json';

    /**
     * Products index page
     *
     * @return view
     */
    public function index()
    {
        $data = $this->getProducts();

        return view('index', ['products' => $data]);
    }

    /**
     * Show a specific product page
     *
     * @param id
     * @return view
     */
    public function show($id)
    {
    	$data = $this->getProducts();
        $product = null;
        foreach ($data as $obj) {
          if ($obj->id == $id) {
            $product = $obj;
          }
        }

        // Invalid product
        if (empty($product)) {
            return redirect('/');
        }

        // Get reviews for product
        $reviews = DB::table('reviews')
            ->where('id_product', '=', $id)
            ->where('approved', '=', 1)
            ->orderBy('created_at', 'DESC')
        ->get();

        // Calculate avg. rating
        $rating = $temp = 0;
        $num_reviews = count($reviews);
        if ($num_reviews > 0) {
            foreach ($reviews as $review) {
                $temp += $review->rating;
            }
            $rating = $temp/$num_reviews;
            $rating = number_format((float) $rating, 1, '.', '');
        }

        // Get reviews for product
        $reviews_pending = DB::table('reviews')
            ->where('id_product', '=', $id)
            ->where('approved', '=', 0)
            ->orderBy('created_at', 'DESC')
        ->get();

        return view('product', ['product' => $product, 'reviews' => $reviews, 'rating' => $rating, 'reviews_pending' => $reviews_pending]);
    }

    /**
     * Add product page
     *
     * @return view
     */
    public function add()
    {
        return view('product-add');
    }

    /**
     * Execute add product
     *
     * @param request
     * @return view
     */
    public function store(Request $request)
    {
        // Validate user input
        $rules = [
            'title'       => 'required',
            'description' => 'required',
            'photo'       => 'required',
        ];
        $this->validate($request, $rules);

        $data = [
            'id'          => uniqid(), // for sake of brevity, we will use this
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'photo'       => $request->input('photo'),
        ];

        // Save to JSON file
        $temp = $this->getProducts();
        $temp[] = $data;
        $json = json_encode($temp);
        Storage::disk('local')->put('products.json', $json);

        return redirect('/');
    }

    /**
     * Execute approval of reviews
     *
     * @param request
     * @return view
     */
    public function approveReviews(Request $request)
    {
        $review_ids = $request->input('reviews');
        if (!empty($review_ids)) {
            DB::table('reviews')
                ->whereIn('id', $review_ids)
                ->update(['approved' => 1
            ]);
        }

        return redirect()->back();
    }

    /**
     * Get products from file
     *
     * @return array data object
     */
    public function getProducts() {
        $data = null;
        $exists = Storage::disk('local')->exists($this->file);
        if ($exists) {
            $json = Storage::get($this->file);
            $data = json_decode($json);
        }

        return $data;
    }
}