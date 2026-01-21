<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productCreationModel;
use App\Models\AuditTrail;

class ProductCreationController extends Controller
{
    public function read(Request $request){
        $category = $request->query('category');
        $search = $request->query('search');
        $query = productCreationModel::query();
        if ($category) {
            $query->where('category', $category);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('category', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%");
            });
        }
        $products = $query->paginate(8)->appends($request->query());
        return view('menu-pricing', compact('products', 'category', 'search'));
    }

    public function createProduct(Request $request)

{

    $data = $request->validate([
        'name' => 'required|string|max:50',
        'category' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    $data['price'] = number_format($data['price'], 2, '.', '');

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        
        if (!file_exists(public_path('products'))) {
            mkdir(public_path('products'), 0777, true);
        }
        
        $image->move(public_path('products'), $imageName);
        $data['image'] = 'products/' . $imageName;
    } else {
        $data['image'] = null;
    }
    
    $product = productCreationModel::create($data);
    
    AuditTrail::create([
        'item_name' => $product->name,
        'action_type' => 'item_added',
        'user_id' => 1, // Hardcoded for now
        'previous_price' => null,
        'new_price' => $product->price
    ]);
    
    return redirect()->route('menu-pricing')->with('success', 'Product created successfully!');
}
    public function edit(productCreationModel $product){
        return view('menu-pricing.edit-product', compact('product'));
    }
    public function updateProduct(Request $request, productCreationModel $product){
    $oldPrice = $product->price;
    
    $data = $request->validate([
        'name' => 'required|string|max:50',
        'category' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    
    $data['price'] = number_format($data['price'], 2, '.', '');
    
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        
        if (!file_exists(public_path('products'))) {
            mkdir(public_path('products'), 0777, true);
        }
        
        $image->move(public_path('products'), $imageName);
        $data['image'] = 'products/' . $imageName;
    }
    
    $product->update($data);
    
    if ($oldPrice != $data['price']) {
        AuditTrail::create([
            'item_name' => $product->name,
            'action_type' => 'price_updated',
            'user_id' => 1, // Hardcoded for now
            'previous_price' => $oldPrice,
            'new_price' => $data['price']
        ]);
    }
    
    return redirect()->route('menu-pricing')->with('success', 'Product updated successfully!');
}
    public function deleteProduct(productCreationModel $product){
    $productName = $product->name;
    $productPrice = $product->price;
    
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }
    
    $product->delete();
    
    AuditTrail::create([
        'item_name' => $productName,
        'action_type' => 'item_deleted',
        'user_id' => 1, // Hardcoded for now
        'previous_price' => $productPrice,
        'new_price' => null
    ]);
    
    return redirect()->route('menu-pricing')->with('success', 'Product deleted successfully!');
    }
}