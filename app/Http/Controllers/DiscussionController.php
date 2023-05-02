<?php

namespace App\Http\Controllers;

use App\Models\{Discussion, Product};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator};
use Illuminate\Validation\{Rule};

class DiscussionController extends Controller
{
    public function store(Request $request)
    {
        $rules = Validator::make($request->all(), [
            'product_hash' => [
                'required',
                Rule::exists('products', 'product_hash')
            ],
            'parent' => 'nullable|string',
            'message' => 'required',
        ]);
        if ($rules->fails()) {
            return response()->json(['data' => 'Invalid input!']);
        }
        $data = $rules->validated();
        $disc = new Discussion;
        $disc->product_hash = $data['product_hash'];
        $disc->user_hash = auth()->user()->user_hash;
        $disc->discussion_hash = md5($disc->product_hash . $disc->user_hash . now());
        $disc->parent = Discussion::where('discussion_hash', $data['parent'])->exists() ? $data['parent'] : null;
        $disc->message = $data['message'];
        $disc->save();
        return response()->json(['data' => 'Pertanyaan telah ditambahkan!']);
    }
}
