<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;


use Session;
use Stripe;


class HomeController extends Controller
{

    public function index()
    {
        $product=Product::paginate(3);

        return view('home.userpage',compact('product'));
    }


    public function redirect()
    {
        $userType = Auth::user()->usertype;

        if ($userType == '1') 
        {
            //to show in admin dashboard count
            $total_product=product::all()->count();

            $total_order=order::all()->count();

            $total_user=user::all()->count();

            $order=order::all();
            $total_revenue=0;
            foreach($order as $order)
            {
                $total_revenue=$total_revenue + $order->price;
            }

            $total_delivered =order::where('delivery_status','=','delivered')->get()->count();

            $total_processing =order::where('delivery_status','=','processing')->get()->count();


            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        } 
        else 
        {
            $product=Product::paginate(3);


            return view('home.userpage',compact('product'));    
        }
    }



    public function product_details($id)
    {

        $product=product::find($id);

        return view('home.product_details',compact('product'));
    }


    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
    
            $cartCount = Cart::where('user_id', $user->id)->count();
            if ($cartCount >= 5) {
                return redirect()->back()->with('error', 'You can only add up to 5 items to your cart.');
            }
                
            $product = Product::find($id);
    
            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price;
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
    
            if ($cartCount < 5) {
                $cart->save();
            } else {
                return redirect()->back()->with('error', 'You can only add up to 5 items to your cart.');
            }
    
            return redirect()->back();
    
        } else {
            return redirect('login');
        }
    }
    
    
    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;

            $cart=cart::where('user_id','=',$id)->get();

            return view('home.showcart',compact('cart'));
        }
        else
        {
            return redirect('login');
        }

    }


    public function remove_cart($id)
    {
        $cart=cart::find($id);

        $cart->delete();

        return redirect()->back();
    }


    public function cash_order($totalproduct)
    {
        if($totalproduct==0)
        {
            return redirect()->back()->with('message','Please add some product');
        }
        else
        {
         $user=Auth::user();

        $userid=$user->id;

        $data=cart::where('user_id','=',$userid)->get();

        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;

            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';

            $order->save();

            $cart_id=$data->id;

            $cart=cart::find($cart_id);

            $cart->delete();
        }
        return redirect()->back()->with('message','We have Received your Order. We will connect with you soon...');
        }
    }


    public function stripe($totalprice)
    {
        if($totalprice==0)
        {
            return redirect()->back()->with('message','Please add some product');
        }
        else
        {
            return view('home.stripe',compact('totalprice'));
        }
    }


    // stripe post function----------
    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount_cents = $totalprice * 100;

        Stripe\Charge::create([
            "amount" => $amount_cents,
            "currency" => "lkr", // Set currency to LKR
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);


        {
            $user=Auth::user();
   
           $userid=$user->id;
   
           $data=cart::where('user_id','=',$userid)->get();
   
           foreach($data as $data)
           {
               $order=new order;
               $order->name=$data->name;
               $order->email=$data->email;
               $order->phone=$data->phone;
               $order->address=$data->address;
               $order->user_id=$data->user_id;
   
               $order->product_title=$data->product_title;
               $order->price=$data->price;
               $order->quantity=$data->quantity;
               $order->image=$data->image;
               $order->product_id=$data->product_id;
               $order->payment_status='paid';
               $order->delivery_status='processing';
   
               $order->save();
   
               $cart_id=$data->id;
   
               $cart=cart::find($cart_id);
               
   
               $cart->delete();
           }
   

        Session::flash('success', 'Payment successful!');

        return back();
    }

    }


    public function show_order()
    {
        if(Auth::id()) //if user logged in
        {
            $user=Auth::user();//check which user logged in

            $userid=$user->id;

            $order=order::where('user_id','=',$userid)->get();

            return view('home.order',compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }



    public function cancel_order($id)
    {
        $order=order::find($id);

        $order->delivery_status='You canceled the order';

        $order->save();

        return redirect()->back();
    }



    public function product_search(Request $request)
    {

        $search_text=$request->search;

        $product=product::where('title','LIKE',"%$search_text%")
        ->orwhere('category','LIKE',"$search_text")->paginate(10);

        return view('home.userpage',compact('product'));
    }




    
}