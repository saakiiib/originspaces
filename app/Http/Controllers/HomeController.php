<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            $user = auth()->user();

            if ($user->user_type == '1') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->user_type == '0') {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function adminHome()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $enquiryCount = Enquiry::count();
        $contactCount = Contact::count();
        $recentEnquiries = Enquiry::latest()->limit(5)->get();

        return view('admin.pages.dashboard', compact('productCount', 'categoryCount', 'enquiryCount', 'contactCount', 'recentEnquiries'));
    }

    public function managerHome()
    {
        return 'manager';
    }

    public function userHome()
    {
        return 'user';
    }
}
