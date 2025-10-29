<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(ProductImage $productImage)
    {
        // Delete the image file from storage
        if (Storage::disk('public')->exists($productImage->image_path)) {
            Storage::disk('public')->delete($productImage->image_path);
        }

        // Delete the database record
        $productImage->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Afbeelding verwijderd.'], 200);
        }

        return redirect()->back()->with('status', 'Afbeelding verwijderd.');
    }
}
