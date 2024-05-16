<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Brand;
use App\Models\Back\Category;
use App\Models\Back\Color;
use App\Models\Back\Product;
use App\Models\Back\product_Image;
use App\Models\Back\Size;
use App\Models\Back\SubCategory;
use App\Models\Sizes;
use App\Models\Colors;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $id = $adminSession['id'];
        $user = User::find($id);
        $allInfo = Product::with('subCategory.category', 'brand',  'images')->get()->groupBy('id');
        return view('Back.products.index', compact('allInfo', 'user'));
    }


    public function create()
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $allSubCategories = SubCategory::allSubCategories();
        $allBrands = Brand::getAllBrands();
        $id = $adminSession['id'];
        $user = User::find($id);
        return view('Back.products.create', compact('allSubCategories', 'allBrands', 'user'));
    }


    public function store(Request $request)
    {
        $adminSession = session()->get('adminSession');
        if (!$adminSession) {
            return redirect()->route('admin.index');
        }

        $productName = $request->productName;
        $quantity = $request->quantity;
        $gender = $request->gender;
        $price = $request->price;
        $description = $request->description;
        $subCategory_id = $request->category_id;
        $brand_id = $request->brand_id;
        $is_featured = $request->is_featured;



        $validator = $request->validate([
            'productName' => 'required|min:2|max:30',
            'gender' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'is_featured' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'productImages' => 'required',
            'quantity' => 'required',
        ]);

        $existingProduct = Product::where('name', $productName)->exists();
        if ($existingProduct) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product name already exists, please try again with a different name.',
            ]);
        }


        $data = [
            'brand_id' => $brand_id,
            'subCategory_id' => $subCategory_id,
            'name' => $productName,
            'gender' => $gender,
            'description' => $description,
            'is_featured' => $is_featured,
            'price' => $price,
            'quantity' => $quantity,
            'remained_quantity' => $quantity,
        ];

        $product = Product::create($data);
        $productId = $product->id;


        foreach ($request->colors as $color) {
            Color::create([
                'product_id' => $productId,
                'color' => $color,
            ]);
        }


        foreach ($request->sizes as $size) {
            Size::create([
                'product_id' => $productId,
                'size' => $size,
            ]);
        }



        $images = [];
        $allImages = $request->file('productImages');

        if ($allImages) {

            foreach ($request->file('productImages') as $image) {
                $imageName = $productName . '_' . time() . rand(1, 99) . '.' . $image->extension();
                $image->storeAs('Back/img/product/', $imageName, 'back-img-product');
                product_Image::create([
                    'image' => $imageName,
                    'product_id' => $productId,
                ]);
            }
        }


        product_Image::insert($images);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added successfully.',
        ]);
    }

    public function show(string $id)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $allProducts = Product::with('subCategory.category', 'brand', 'colors', 'sizes', 'images')->where('id', $id)->get()->first();
        $id = $adminSession['id'];
        $user = User::find($id);
        return view('Back.products.show', compact('allProducts', 'user'));
    }

    public function edit(string $id)
    {
        $adminSession = session()->get('adminSession');
        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $user_id = $adminSession['id'];
        $user = User::find($user_id);
        $allSpecificProducts = Product::with('subCategory.category', 'brand',  'images', 'sizes', 'colors')->find($id);
        $allSubCategories = SubCategory::allSubCategories();
        $allBrands = Brand::getAllBrands();
        return view('Back.products.edit', compact('allSpecificProducts',  'allBrands', 'allSubCategories', 'user'));
    }


    public function update(Request $request, string $id)
    {

        $adminSession = session()->get('adminSession');
        if (!$adminSession) {
            return redirect()->route('admin.index');
        }

        $colors = $request->colors;
        $sizes = $request->sizes;
        $productName = $request->productName;
        $quantity = $request->quantity;
        $gender = $request->gender;
        $price = $request->price;
        $description = $request->description;
        $subCategory_id = $request->category_id;
        $brand_id = $request->brand_id;
        $is_featured = $request->is_featured;
        $colors = $request->filled('color') ? $request->color : [];
        $sizes = $request->filled('size') ? $request->size : [];

        $validator = $request->validate([
            'productName' => 'required|min:2|max:30',
            'price' => 'required',
            'gender' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'is_featured' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'quantity' => 'required',
        ]);

        $product = Product::where('name', $productName)->where('id', '!=', $id)->first();
        if ($product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product name already exists. Please try again.',
            ]);
        }
        $product = Product::find($id);
        $oldQuantity = $product->quantity;
        $remain = $product->remained_quantity;
        $remained_quantity = $remain + ($quantity - $oldQuantity);
        if ($remained_quantity < 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'updated quantity should be GREATER THAN old quantity',
            ]);
        }
        $product->update([
            'brand_id' => $brand_id,
            'subCategory_id' => $subCategory_id,
            'name' => $productName,
            'gender' => $gender,
            'description' => $description,
            'is_featured' => $is_featured,
            'price' => $price,
            'quantity' => $quantity,
            'remained_quantity' => $remained_quantity,
        ]);

        $product->colors()->delete();
        $product->colors()->createMany(array_map(function ($color) {
            return ['color' => $color];
        }, $request->colors));

        $product->sizes()->delete();
        $product->sizes()->createMany(array_map(function ($size) {
            return ['size' => $size];
        }, $request->sizes));

        $allImages = $request->file('productImages');

        if ($allImages) {
            $images = [];
            foreach ($allImages as $key => $image) {
                $imageName = $productName . '_' . time() . rand(1, 99) . '.' . $image->extension();
                $image->storeAs('Back/img/product', $imageName, 'back-img-product');
                $images[] = [
                    'image' => $imageName,
                    'product_id' => $id,
                ];
            }
            product_Image::insert($images);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully.',
        ]);
    }



    public function destroy(string $id)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        try {
            $deleted = Product::where('id', $id)->delete();
            if ($deleted) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please try again',
                ]);
            }
        } catch (QueryException $e) {

            if ($e->errorInfo[1] == 1451) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete the Product because it is being referenced by other records.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred. Please try again.',
                ]);
            }
        }
    }
    public function destroyImage(string $id)
    {
        $adminSession = session()->get('adminSession');
        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $deleted = product_Image::where('id', $id)->delete();
        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Image Deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Please Try again',
            ]);
        }
    }
}
