<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Download;
use App\Models\Enquiry;
use App\Models\Gallery;
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
        $downloadCount = Download::count();
        $galleryCount = Gallery::count();
        $enquiriesThisWeek = Enquiry::where('created_at', '>=', now()->subDays(7))->count();
        $contactsThisWeek = Contact::where('created_at', '>=', now()->subDays(7))->count();
        $recentEnquiries = Enquiry::latest()->limit(5)->get();
        $recentContacts = Contact::latest()->limit(5)->get();
        $topDownloads = Download::orderByDesc('downloads_count')->limit(5)->get();
        $productsByCategory = Category::withCount('products')->orderByDesc('products_count')->limit(6)->get();

        return view('admin.pages.dashboard', compact('productCount', 'categoryCount', 'enquiryCount', 'contactCount', 'downloadCount', 'galleryCount', 'enquiriesThisWeek', 'contactsThisWeek', 'recentEnquiries', 'recentContacts', 'topDownloads', 'productsByCategory'));
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
