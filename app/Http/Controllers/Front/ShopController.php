<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\Color;
use App\Models\Back\General;
use App\Models\Back\Product;
use App\Models\Back\Size;
use App\Models\Back\SubCategory;
use App\Models\Back\Wishlist;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Route;

use function PHPUnit\Framework\isEmpty;

class ShopController extends Controller
{





    // public function index(Request $request, $id)
    // {
    //     $cat_id = $id;
    //     $getAllGeneralInfo = General::first();
    //     $getAllCategories = Category::has('products')->with('subCategory')->where('id', $cat_id)->get();
    //     $allProducts_ids = [];
    //     $allProducts = [];

    //     // Retrieve all products for the specific category ID
    //     $allProductsQuery = Product::whereHas('subCategory', function ($query) use ($cat_id) {
    //         $query->where('category_id', $cat_id);
    //     });
    //     // $allProducts = $allProductsQuery->get();

    //     // return $allProducts;
    //     // Check if request has colors and sizes
    //     if ($request->colors != 'All' && $request->sizes != 'All') {
    //         // return 'lsdf';
    //         $colors = explode(',', $request->input('colors'));
    //         $sizes = explode(',', strtolower($request->input('sizes')));
    //         $allColors = Color::whereIn('color', $colors)->get();
    //         foreach ($allColors as $key => $color) {
    //             $allProducts_ids[] = $color->product_id;
    //         }
    //         // return $allColors;

    //         $allSizes = Size::whereIn('size', $sizes)->get();
    //         foreach ($allSizes as $key => $size) {
    //             $allProducts_ids[] = $size->product_id;
    //         }
    //         // return $allSizes;
    //         $allProducts_ids = array_unique($allProducts_ids);
    //         return $allProducts_ids;
    //         $allProductsQuery->with('colors', 'sizes')->whereIn('id', $allProducts_ids);
    //         // $allpr = $allProductsQuery->get();
    //         // return $allpr;
    //     }

    //     // Check if request has colors only
    //     if ($request->colors != 'All' && $request->sizes == 'All') {
    //         // return 'sixe';
    //         $colors = explode(',', $request->input('colors'));
    //         $allColors = Color::whereIn('color', $colors)->get();
    //         foreach ($allColors as $key => $color) {
    //             $allProducts_ids[] = $color->product_id;
    //         }
    //         $allProducts_ids = array_unique($allProducts_ids);
    //         $allProductsQuery->with('colors','sizes')->whereIn('id', $allProducts_ids);
    //         // return $allProductsQuery->get();
    //     }

    //     // Check if request has sizes only
    //     if ($request->colors == 'All' && $request->sizes != 'All') {
    //         $sizes = explode(',', $request->input('sizes'));
    //         $allSizes = Size::whereIn('size', $sizes)->get();
    //         foreach ($allSizes as $key => $size) {
    //             $allProducts_ids[] = $size->product_id;
    //         }
    //         $allProducts_ids = array_unique($allProducts_ids);
    //         $allProductsQuery->with('colors', 'sizes')->whereIn('id', $allProducts_ids);
    //     }

    //     // Final query to retrieve products
    //     $allProducts = $allProductsQuery->where('remained_quantity', '>', 0)->paginate(12);
    //     return $allProducts;
    //     $minPrice = $allProducts->min('price');
    //     $maxPrice = $allProducts->max('price');

    //     $wishlistCount = 0;
    //     $userSession = session()->get('clientSession', []);
    //     if ($userSession) {
    //         $userId = $userSession['id'];
    //         $wishlistCount = Wishlist::where('user_id', $userId)->count();
    //     }

    //     return view('Front.shop', compact('cat_id', 'wishlistCount', 'getAllGeneralInfo', 'getAllCategories', 'allProducts', 'maxPrice', 'minPrice'));
    // }


    public function index(Request $request, $id)
    {
        $selectedColors = [];
        if ($request->has('colors')) {
            $selectedColors = explode(',', $request->input('colors'));
        }
        $selectedSizes = [];
        if ($request->has('sizes')) {
            //! Convert the string of colors to an array
            $selectedSizes = explode(',', $request->input('sizes'));
        }

        $cat_id = $id;
        $getAllGeneralInfo = General::first();
        $getAllCategories = Category::has('products')->with('subCategory')->where('id', $cat_id)->get();
        $allProducts_ids = [];
        $allProducts = [];

        //! Retrieve all products for the specific category ID
        $allProductsQuery = Product::whereHas('subCategory', function ($query) use ($cat_id) {
            $query->where('category_id', $cat_id);
        });

        //! Check if request has colors and sizes
        if ($request->colors != 'All' && $request->sizes != 'All') {

            $colors = explode(',', $request->input('colors'));
            $sizes = explode(',', strtolower($request->input('sizes')));
            $allProductsQuery->whereHas('colors', function ($query) use ($colors) {
                $query->whereIn('color', $colors);
            })->whereHas('sizes', function ($query) use ($sizes) {
                $query->whereIn('size', $sizes);
            });
        }

        //! Check if request has colors only
        if ($request->colors != 'All' && $request->sizes == 'All') {
            $colors = explode(',', $request->input('colors'));
            $allProductsQuery->whereHas('colors', function ($query) use ($colors) {
                $query->whereIn('color', $colors);
            });
        }

        //! Check if request has sizes only
        if ($request->colors == 'All' && $request->sizes != 'All') {
            $sizes = explode(',', $request->input('sizes'));
            $allProductsQuery->whereHas('sizes', function ($query) use ($sizes) {
                $query->whereIn('size', $sizes);
            });
        }
        //! Apply sorting
        $sortType = $request->query('sort');
        if ($sortType === 'lowest_price') {
            $allProductsQuery->orderBy('price');
        } elseif ($sortType === 'highest_price') {
            $allProductsQuery->orderByDesc('price');
        }

        $allProducts = $allProductsQuery->where('remained_quantity', '>', 0)->paginate(12);

        $minPrice = $allProducts->min('price');
        $maxPrice = $allProducts->max('price');

        $wishlistCount = 0;
        $userSession = session()->get('clientSession', []);
        if ($userSession) {
            $userId = $userSession['id'];
            $wishlistCount = Wishlist::where('user_id', $userId)->count();
        }


        return view('Front.shop', compact('selectedColors', 'selectedSizes', 'cat_id', 'wishlistCount', 'getAllGeneralInfo', 'getAllCategories', 'allProducts', 'maxPrice', 'minPrice'));
    }










    public function shopByCategory(Request $request,string $id)
    {

        $getAllGeneralInfo = General::first();

        $selectedColors = [];
        if ($request->has('colors')) {
            $selectedColors = explode(',', $request->input('colors'));
        }
        $selectedSizes = [];
        if ($request->has('sizes')) {
            //! Convert the string of colors to an array
            $selectedSizes = explode(',', $request->input('sizes'));
        }
        $selectedSizes = $request->input('sizes', []);
        $getAllCategories = Category::has('products')->with('subCategory')->get();
        $category = Category::with('subCategory')->findOrFail($id);
        $cat_id = $category->id;
        $allProducts = collect([]);
        foreach ($category->subCategory as $subCategory) {
            $products = Product::whereHas('subCategory', function ($query) use ($subCategory) {
                $query->where('id', $subCategory->id);
            })
                ->where('remained_quantity', '>', 0)
                ->with('images', 'brand', 'sizes', 'colors')
                ->get();
            $allProducts = $allProducts->concat($products);
        }

        $perPage = 12;
        $currentPage = request()->query('page', 1);
        $currentPageItems = $allProducts->slice(($currentPage - 1) * $perPage, $perPage);
        $allProducts = new LengthAwarePaginator(
            $currentPageItems,
            $allProducts->count(),
            $perPage,
            $currentPage
        );
        $allProducts->setPath(request()->url());
        $userSession = session()->get('clientSession', []);
        $minPrice = $allProducts->min('price');
        $maxPrice = $allProducts->max('price');
        $prices = $allProducts->pluck('price')->toArray();
        if (!$userSession) {
            $wishlistCount = 0;
            return view('Front.shop', compact('prices','selectedColors', 'selectedSizes','cat_id', 'wishlistCount', 'getAllGeneralInfo', 'getAllCategories', 'category','allProducts', 'minPrice', 'maxPrice'));
        }

        $userId = $userSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();

        if (empty($userSession)) {
            $wishlistCount = 0;
        }


        return view('Front.shop', compact('prices', 'selectedColors', 'selectedSizes', 'cat_id', 'wishlistCount', 'getAllGeneralInfo', 'getAllCategories', 'category', 'allProducts', 'minPrice', 'maxPrice'));
    }








    public function filterBySorting(string $id)
    {
        $getAllGeneralInfo = General::first();

        $getAllCategories = Category::has('products')->with('subCategory')->get();
        $category = Category::with('subCategory')->findOrFail($id);
        $allProducts = [];
        foreach ($category->subCategory as $subCategory) {
            $products = Product::whereHas('subCategory', function ($query) use ($subCategory) {
                $query->where('id', $subCategory->id);
            })
                ->with('images', 'brand', 'sizes', 'colors')
                ->get();

            $allProducts = array_merge($allProducts, $products->toArray());
        }

        $allProducts = collect($allProducts)->unique('id')->values();
        $minPrice = $allProducts->min('price');
        $maxPrice = $allProducts->max('price');
        $userSession = session()->get('clientSession', []);
        if (!$userSession) {
            $wishlistCount = 0;
            return view('Front.shop', compact('wishlistCount', 'getAllGeneralInfo', 'getAllCategories', 'category', 'allProducts', 'maxPrice', 'minPrice'));
        }
        $userId = $userSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        if (empty($userSession)) {
            $wishlistCount = 0;
        }
        return view('Front.shop', compact('wishlistCount', 'getAllGeneralInfo', 'getAllCategories', 'category', 'allProducts', 'maxPrice', 'minPrice'));
    }







    public function shopBySubCategory(string $id)
    {
        $url = request()->path();
        $colorsArray = [];

        $subCategory = SubCategory::findOrFail($id);

        $allProducts = Product::where('subCategory_id', $id)->with('images')->paginate(12);

        // Retrieve the highest and lowest priced products
        $highestPriceProduct = $allProducts->sortByDesc('price')->first();
        $lowestPriceProduct = $allProducts->sortBy('price')->first();

        $wishlistCount = Wishlist::count();
        $data = [
            'subCategory' => $subCategory,
            'allProducts' => $allProducts,
            'highestPriceProduct' => $highestPriceProduct,
            'lowestPriceProduct' => $lowestPriceProduct,
            'colorsArray' => $colorsArray,
            'wishlistCount' => $wishlistCount,
            'url' => $url,
        ];

        return view('Front.shop', $data);
    }
}
