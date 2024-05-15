<?php

namespace App\Http\Controllers;

use App\Notifications\MyFirstNotification;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Notification;
//use PDF;




class AdminController extends Controller
{
    public function view_category()
    {

        $data=category::all();

        return view('admin.category',compact('data'));

    }




    public function add_category(Request $request)
    {
        $rules = [
            'category' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
    
        $messages = [
            'category.regex' => 'The category name may only contain letters or spaces.',
        ]];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();
    
        return redirect()->back()->with('message', 'Category Added Successfully!');
    }    


    public function delete_category($id)
    {
        $data = category::find($id);

        $data->delete();

        return redirect()->back()->with('message','Category Deleted Successfully!');
    }



    public function view_product()
    {
        $category =category::all();
        return view('admin.product',compact('category'));
    }




    public function add_product(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'dis_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're accepting image files
        ]);
    
        $product= new product;
    
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
    
        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        
        $request->image->move('product', $imagename);
    
        $product->image = $imagename; 
    
        $product->save();
    
        return redirect()->back()->with('message', 'Product Added Successfully');
    }
    

    

    public function show_product()
    {
        $product = Product::all();
        return view('admin.show_product',compact('product'));
    }


    public function delete_product($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully!');
    }


    public function update_product($id)
    {
        $product=product::find($id);

        // to send all the category data to update
        $category=category::all();

        return view ('admin.update_product',compact('product','category'));
    }


    public function update_product_confirm(Request $request,$id)
    {
        $product=product::find($id);

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->discount_price=$request->dis_price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;

        $image=$request->image;

        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
                
            $request->image->move('product',$imagename);

            $product->image=$imagename; 
        }

        $product->save();

        return redirect()->route('show_product')->with('message','Product Updated Successfully');

    }


    public function order()
    {
        $order=order::all();


        return view('admin.order',compact('order'));
    }


    public function delivered($id)
    {
        $order=order::find($id);

        $order->delivery_status="delivered";

        $order->payment_status='paid';

        $order->save();

        return redirect()->back();
    }



    public function print_pdf($id)
    {
        $order=order::find($id);

        $pdf=PDF::loadView('admin.pdf',compact('order'));

        return $pdf->download('order_details.pdf');
    }



    public function send_email($id)
    {
        $order=order::find($id);

        return view('admin.email_info',compact('order'));
    }



    public function send_user_email(Request $request, $id)
    {
        $order=order::find($id);

        $details = [
            'greeting' => $request->input('greeting'),
            'firstline' => $request->input('firstline'), 
            'body' => $request->input('body'), 
            'button' => $request->input('button'), 
            'url' => $request->input('url'),
            'lastline' => $request->input('lastline'),
        ];
        Notification::send($order,new MyFirstNotification($details));

        return redirect()->back();
    }
    


    public function searchdata(Request $request)
    {
        
        $searchText = $request->search;

        $order = Order::where('name', 'LIKE', "%$searchText%")
        ->orwhere('phone', 'LIKE', "%$searchText%")
        ->orwhere('product_title', 'LIKE', "%$searchText%")->get();

        return view('admin.order', compact('order'));
    }


}
