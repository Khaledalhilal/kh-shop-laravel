<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Brand;
use App\Models\Back\Category;
use App\Models\Back\Product;
use App\Models\Common\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }

        $productCounts = [];

        $categoriesWithSubcategoryCount = Category::with('subCategory')->get();

        foreach ($categoriesWithSubcategoryCount as $category) {
            $totalCount = 0;
            foreach ($category->subCategory as $subcategory) {
                $totalCount += Product::where('subCategory_id', $subcategory->id)->count();
            }
            $productCounts[$category->name] = $totalCount;
        }
        asort($productCounts);

        // todo: -----------------------------------------------------------------
        $orderCountsForEachProduct = [];

        $productWithOrderItems = Product::select('id', 'name')
            ->withCount('order_items')
            ->whereHas('order_items', function ($query) {
                $query->where('product_id', '>', 0);
            })->get();

        foreach ($productWithOrderItems as $product) {
            $orderCountsForEachProduct[$product->name] = $product->order_items_count;
        }

        asort($orderCountsForEachProduct);

        // todo: -----------------------------------------------------------------

        $productCount = Product::count();
        $orderCount = Order::count();
        $brandCount = Brand::count();
        $categoryCount = Category::count();
        $id = $adminSession['id'];
        $user = User::find($id);

        return view('Back.dashboard', compact('orderCountsForEachProduct', 'productCounts', 'user', 'productCount', 'orderCount', 'categoryCount', 'brandCount'));
    }
}
