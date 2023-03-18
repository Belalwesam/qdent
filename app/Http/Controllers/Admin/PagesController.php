<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Coupon;
use App\Model\Order;
use App\Model\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PhpParser\Builder\Property;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function test(){
        return parent::SMS('966537141291','رسالة تجريبية');
//        return parent::sendMessage();
    }

    public function driver(){
        return parent::sendMessageDriver();
    }
    public function index()
    {
        $page_title =  __("لوحة التحكم");
        $page_description = __("متجر روزنيري ");

                $usersCount = User::count();
                $productCount = Product::all()->count();
                $totalOrder = Order::all()->count();
                $totalCoupon = Coupon::all()->count();
                $totalOrders = Order::all()->sum('total');
                $users = User::where('type', '=', 1)->latest('created_at')->limit(5)->get();
                $orders = Order::latest('created_at')->limit(5)->get();
                $products = Product::latest('created_at')->limit(5)->get();
                return view('pages.dashboard', compact('page_title', 'page_description','productCount','users','products','usersCount',
                'totalCoupon','totalOrder','totalOrders','orders'));
    }

    /**
     * Demo methods below
     */
public function contact(Request $request){

}
    // Datatables
    public function datatables()
    {
        $page_title = 'Datatables';
        $page_description = 'This is datatables test page';

        return view('pages.datatables', compact('page_title', 'page_description'));
    }

    // KTDatatables
    public function ktDatatables()
    {
        $page_title = 'KTDatatables';
        $page_description = 'This is KTdatatables test page';

        return view('pages.ktdatatables', compact('page_title', 'page_description'));
    }

    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('pages.select2', compact('page_title', 'page_description'));
    }

    // custom-icons
    public function customIcons()
    {
        $page_title = 'customIcons';
        $page_description = 'This is customIcons test page';

        return view('pages.icons.custom-icons', compact('page_title', 'page_description'));
    }

    // flaticon
    public function flaticon()
    {
        $page_title = 'flaticon';
        $page_description = 'This is flaticon test page';

        return view('pages.icons.flaticon', compact('page_title', 'page_description'));
    }

    // fontawesome
    public function fontawesome()
    {
        $page_title = 'fontawesome';
        $page_description = 'This is fontawesome test page';

        return view('pages.icons.fontawesome', compact('page_title', 'page_description'));
    }

    // lineawesome
    public function lineawesome()
    {
        $page_title = 'lineawesome';
        $page_description = 'This is lineawesome test page';

        return view('pages.icons.lineawesome', compact('page_title', 'page_description'));
    }

    // socicons
    public function socicons()
    {
        $page_title = 'socicons';
        $page_description = 'This is socicons test page';

        return view('pages.icons.socicons', compact('page_title', 'page_description'));
    }

    // svg
    public function svg()
    {
        $page_title = 'svg';
        $page_description = 'This is svg test page';

        return view('pages.icons.svg', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
