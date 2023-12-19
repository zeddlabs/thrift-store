<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'categories' => Category::all(),
            'products' => Product::take(8)->get(),
        ];

        return view('home', $data);
    }

    public function category(Category $category)
    {
        $data = [
            'title' => $category->name,
            'categories' => Category::all(),
            'products' => $category->products,
        ];

        return view('category', $data);
    }

    public function product(Product $product)
    {
        $data = [
            'title' => $product->name,
            'categories' => Category::all(),
            'product' => $product,
        ];

        return view('product', $data);
    }

    public function checkout(Product $product)
    {
        $data = [
            'title' => 'Checkout',
            'categories' => Category::all(),
            'product' => $product,
        ];

        return view('checkout', $data);
    }

    public function checkoutProcess(Request $request, Product $product)
    {
        $product->orders()->create([
            'customer_id' => auth()->guard('customer')->user()->id,
            'invoice' => 'INV-' . date('YmdHis'),
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'more_address' => $request->more_address,
            'quantity' => $request->quantity,
            'total_price' => $request->quantity * $product->price,
        ]);

        $product->update([
            'stock' => $product->stock - $request->quantity,
        ]);

        return redirect()->route('home.payment', $product->orders->last()->invoice);
    }

    public function payment($invoice)
    {
        $data = [
            'title' => 'Pembayaran',
            'categories' => Category::all(),
            'order' => Order::where('invoice', $invoice)->first(),
            'whatsapp_text' => 'Halo, saya ingin melakukan pembayaran untuk pesanan dengan nomor invoice ' . $invoice,
        ];

        return view('payment', $data);
    }
}
