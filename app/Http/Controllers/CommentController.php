<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request, Product $product) {
        $formFields = $request->validate([
            'comment' => ['required', 'min:10'],
        ]);

        $formFields['product_id'] = $request->id;

        Comment::create($formFields);
        
        return back()->with('message', 'Comment added');
    }
}
