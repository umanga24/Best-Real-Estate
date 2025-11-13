<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use App\Models\Admin\ProductImage;
use App\Models\Process;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'product_id' => 'required|exists:products,id'
        ]);

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                // Generate a unique name
                $uniqueName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();

                // Define folders
                $thumbPath = public_path('images/thumbnail');
                $mainPath = public_path('images/main');
                $listingPath = public_path('images/listing');

                // Make sure directories exist
                foreach ([$thumbPath, $mainPath, $listingPath] as $path) {
                    if (!file_exists($path)) {
                        mkdir($path, 0755, true);
                    }
                }

                // Save images using Intervention Image
                Image::make($image->getRealPath())->save($thumbPath . '/' . $uniqueName);
                Image::make($image->getRealPath())->save($listingPath . '/' . $uniqueName);
                Image::make($image->getRealPath())->save($mainPath . '/' . $uniqueName);

                // Save to DB
                ProductImage::create([
                    'product_id' => $request->product_id,
                    'images' => $uniqueName
                ]);
            }
        }

        return back()->with('message', 'Gallery Added Successfully');
    }




    public function destroy($id)
    {


        $productImage = ProductImage::findOrFail($id);

        // Delete image file from storage
        $imagePath = public_path('images/main/' . $productImage->images);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete from database
        $productImage->delete();

        return back()->with('message', 'Image deleted successfully');
    }
}
