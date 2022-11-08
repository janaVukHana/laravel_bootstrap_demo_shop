<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request) {
        $formFields = $request->validate([
            'comment' => ['required', 'min:10'],
        ]);

        $formFields['product_id'] = $request->id;

        Comment::create($formFields);

        // Comment::create([
        //     'product_id' => $product->id,
        //     'comment' => $request->comment
        // ]);
        
        return back()->with('message', 'Comment added');
    }
}
