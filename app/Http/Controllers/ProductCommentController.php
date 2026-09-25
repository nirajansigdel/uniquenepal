<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductCommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        $product->comments()->create($validated);

        return redirect(route('products.detail', $product->id) . '#comments')
            ->with('comment_success', 'Thank you — your comment has been posted.');
    }
}
