<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Session;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Notification;
use App\Model\MobileToken;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function __;
use function abort;
use function collect;
use function redirect;
use function view;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $page_title = __("Dashboard");
        $page_description = __("َQDent");
        $data = Order::latest('id')->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<span class="badge badge-' . $row->span() . '">' . $row->status . '</span>';
                })->addColumn('name', function ($row) {
                    return $row->user->name ?? '-';
                })->addColumn('product_name', function ($row) {
                    $product = '';
                    foreach ($row->carts->items ?? collect() as $item) {
                        $product .= ($item->product->name ?? "-") . ", ";
                    }
                    return $product;
                })->addColumn('quantity', function ($row) {
                    $qty = 0;

                    foreach ($row->carts->items ?? collect() as $item) {
                        $qty += $item->qty ?? 0;
                    }
                    return $qty;
                })->addColumn('location', function ($row) {

                    return $row->address();
                })->addColumn('total', function ($row) {

                    return $row->total_price();
                })->addColumn('created_at', function ($row) {

                    return $row->created_at->diffForHumans();
                })->addColumn('action', function ($row) {
                    $button = '<a href="' . route('orders.show', $row->id) . '" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    $button .= '<a href="' . route('orders.edit', $row->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
                    return $button;
                })->rawColumns(['action', 'status', 'name', 'product_name', 'name', 'location', 'quantity'])
                ->make(true);
        }
        return view('pages.dashboard', compact('page_title', 'page_description'));
    }

    public function local($locale)
    {
        if (!in_array($locale, ['en', 'es', 'ar'])) {
            abort(400);
        }
        Session::put('locale', $locale);

        return redirect()->back();
        //
    }

    public function send_notification(Request $request)
    {
        $rules = [
            'ids' => 'required',
        ];

        $this->validate($request, $rules);

        $users_ids = $request->ids;

        foreach ($users_ids as $id) {
            $notification = Notification::query()->create([
                'title' => 'رسالة جديدة',
                'sub_title' => 'رسالة جديدة',
                'message' => 'لديك رسالة جديدة',
                'user_id' => $id
            ]);
        }

        $users = MobileToken::query()->whereIn('user_id', $users_ids)->pluck('token')->toArray();

        $this->fcmNotification($users, 'رسالة جديدة', 'رسالة جديدة', 'لديك رسالة جديدة');

        return ['status' => true];
    }
    public function appVersion()
    {
        $version = \DB::table('app')->first()->version;
        return view('admin.app-version.index', compact('version'));
    }
    public function updateAppVersion(Request $request)
    {
        $version = \DB::table('app')->where('version', '!=', 'null')->update([
            'version' => $request->app_version
        ]);
        return http_response_code(200);
        // $version
    }
    public function guestLoginPage()
    {
        $guest_login = \DB::table('app')->first()->guest_login;
        return view('admin.guest-login.index', compact('guest_login'));
    }
    public function guestLoginUpdate(Request $request)
    {
        if ($request->guest_login == 0) {
            $guest_login = \DB::table('app')->where('version', '!=', 'null')->update([
                'guest_login' => 0
            ]);
        } else {
            $guest_login = \DB::table('app')->where('version', '!=', 'null')->update([
                'guest_login' => 1
            ]);
        }
    }
}
