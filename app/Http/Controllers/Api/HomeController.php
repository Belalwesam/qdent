<?php

namespace App\Http\Controllers\Api;

use App\Gallary;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdsResource;
use App\Http\Resources\App\AddressResource;
use App\Http\Resources\App\Attrabiute\AttrabiuteResource;
use App\Http\Resources\App\CatalogResource;
use App\Http\Resources\App\CategoreisItemResource;
use App\Http\Resources\App\CategoreisResource;
use App\Http\Resources\App\CollectionItemResource;
use App\Http\Resources\App\EmployeeResource;
use App\Http\Resources\App\EventITemResource;
use App\Http\Resources\App\EventPageResource;
use App\Http\Resources\App\FeedItemResource;
use App\Http\Resources\App\FeedPageResource;
use App\Http\Resources\App\NotificationResource;
use App\Http\Resources\App\OfferItemResource;
use App\Http\Resources\App\ProductItemResource;
use App\Http\Resources\App\ProductPageResource;
use App\Http\Resources\App\RateResource;
use App\Http\Resources\App\SettingResource;
use App\Http\Resources\App\ShippinMethodResource;
use App\Http\Resources\BankingResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\Hrj\AdsCollection;
use App\Http\Resources\ImageResource;
use App\Http\Resources\KnowledgeResource;
use App\Http\Resources\Master\Item\MasterResource;
use App\Http\Resources\PublicationResource;
use App\Http\Resources\TableResource;
use App\Http\Resources\TalentResource;
use App\Image;
use App\Knowledge;
use App\Model\Address;
use App\Model\Ads;
use App\Model\Attrabiute;
use App\Model\Banking;
use App\Model\Cart;
use App\Model\Catalog;
use App\Model\Category;
use App\Model\City;
use App\Model\Comment;
use App\Model\Employee;
use App\Model\Event;
use App\Model\Favorite;
use App\Model\Feed;
use App\Model\Interested;
use App\Model\Item;
use App\Model\Like;
use App\Model\Notification;
use App\Model\Order;
use App\Model\Product;
use App\Model\Property;
use App\Model\Settings;
use App\Model\ShippingMethod;
use App\Model\Sub_Category;
use App\Model\EventAttendance;
use App\Publication;
use App\Model\Rate;
use App\Table;
use App\Talent;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Resources\Hrj\Category as CatRs;
use phpDocumentor\Reflection\Types\Parent_;
use App\User;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     * Home Data
     */
    public function home()
    {
        $events = EventITemResource::collection(Event::latest('id')->take(6)->get());
        $products = ProductItemResource::collection(Product::latest('id')->take(6)->get());
        $news = CollectionItemResource::collection(Product::where('is_new', 1)->latest('id')->take(6)->get());
        $best = CollectionItemResource::collection(Product::where('is_new', 1)->latest('id')->take(6)->get());
        $feeds = FeedItemResource::collection(Feed::where('is_ads', 0)->latest('id')->take(6)->get());
        $feeds_offers = FeedItemResource::collection(Feed::where('is_ads', 1)->latest('id')->take(6)->get());
        $offers = ProductItemResource::collection(Product::where('is_offer', 1)->latest('id')->take(6)->get());
        $data = ['events' => $events, 'products' => $products, 'feeds_Ads' => $feeds_offers, 'feeds' => $feeds, 'offers' => $offers, 'news' => $news, 'best' => $best];
        return parent::json('200', true, 'Received Data', $data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * Get All Categories
     */
    public function category(Request $request)
    {

        $product = Product::query();
        if ($request->has('type')) {
            $product->whereHas('category', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }
        if ($request->has('category_id')) {
            $product->where('category_id', $request->category_id);
        }
        if ($request->has('sub_category_id')) {
            $product->where('sub_category_id', $request->sub_category_id);
        }
        $products = $product->latest('id')->get();
        $data = ProductItemResource::collection($products);
        //        dd($products->next_page_url);

        //       $product->nextPageUrl();

        //       $data  = [ 'data'=>$data,'links'=>$product->links()]    ;
        return parent::json('200', true, 'Received Data', $data);
    }

    public function categories(Request $request)
    {
        if ($request->has('type')) {
            $data = CategoreisItemResource::collection(Category::where('type', $request->type)->orderBy('highlight', 'desc')->latest('id')->get());
        } else {
            $data = CategoreisItemResource::collection(Category::latest('id')->orderBy('highlight', 'desc')->latest('id')->get());
        }
        return parent::json('200', true, 'Received Data', $data);
    }
    public function search(Request $request, $text = null)
    {

        $text = $request->text;
        $products = Product::query();
        $products->where('name', 'LIKE', "%{$text}%")
            ->orWhere('description', 'LIKE', "%{$text}%");
        $feed = Feed::query();

        $feed->where('name', 'LIKE', "%{$text}%")
            ->orWhere('sub_title', 'LIKE', "%{$text}%");

        $event = Event::query();

        $event->where('name', 'LIKE', "%{$text}%")
            ->orWhere('description', 'LIKE', "%{$text}%");
        $data = [
            'text' => $text,
            'products' => ProductItemResource::collection($products->get()),
            'events' => EventITemResource::collection($event->get()),
            'feeds' => FeedItemResource::collection($feed->get()),
        ];
        return parent::json('200', true, 'Received Data', $data);
    }
    public function filter(Request $request)
    {


        $products = Product::query();

        if ($request->has('name')) {
            $products->where('name', 'LIKE', "%{$request->name}%");
        }
        if ($request->has('price')) {
            $products->whereBetween('price', $request->price);
        }

        if ($request->has('category_id')) {
            $products->where('category_id', $request->category_id);
        }
        if ($request->has('sub_category_id')) {
            $products->where('sub_category_id', $request->sub_category_id);
        }

        if ($request->has('attribute')) {
            $products->whereHas('ProductAttrabiute', function ($query) use ($request) {
                $query->whereIn('attribute_value_id', $request->attribute);
            });
        }


        return parent::json('200', true, 'تم استلام البيانات ', ['products' => ProductItemResource::collection($products->get())]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * Get data for product
     */
    public function product(Product $product)
    {
        $data = ProductPageResource::make($product);
        return parent::json('200', true, 'Received Data', $data);
    }


    // products
    public function products()
    {
        $data = ProductItemResource::collection(Product::latest('id')->get());
        return parent::json('200', true, 'Received Data', $data);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Rate Product
     */
    public function rate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'product_id' => ['required'],
            'rate' => ['required'],

        ]);
        if ($validator->fails()) {
            return Parent::json('422', 'false', $validator->messages()->first(), $validator->messages());
        }
        $product = Product::find($request->product_id);
        if ($product == null) {
            return parent::json('422', 'false', 'Product Not Found', null);
        }
        $rate = Rate::where('user_id', $request->user()->id)->where('product_id', $request->product_id)->first();
        if ($rate == null) {
            $request->user_id = $request->user()->id;
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            $status = Rate::create($data);
        } else {
            $rate->fill($request->all());
            $status = $rate->update();
        }
        if ($status) {
            return parent::json('200', true, 'Successfully added Rate');
        } else {
            return parent::json('500', false, 'Something went wrong, Please try again');
        }
    }

    // get rates
    public function rates(Product $product)
    {
        $data = RateResource::collection($product->rates);
        return parent::json('200', true, 'Received Data', $data);
    }

    /**
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     * get date for event
     */
    public function event(Event $event)
    {
        $data = EventPageResource::make($event);

        $is_exists = EventAttendance::query()->where('user_id', auth('api')->id())->where('event_id', $event->id)->exists();

        if (!$is_exists) {
            EventAttendance::query()->create([
                'user_id' => auth('api')->id(),
                'event_id' => $event->id,
            ]);
        }

        return parent::json('200', true, 'Received Data', $data);
    }

    // get all events
    public function events()
    {
        $data = EventItemResource::collection(Event::latest('id')->get());
        return parent::json('200', true, 'Received Data', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Interested Going
     */
    public function interested(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'event_id' => ['required'],

        ]);
        if ($validator->fails()) {
            return Parent::json('422', 'false', $validator->messages()->first(), $validator->messages());
        }
        $interested = Interested::where('user_id', $request->user()->id)->where('event_id', $request->event_id)->first();
        if ($interested == null) {
            $request->user_id = $request->user()->id;
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            $status = Interested::create($data);
        } else {
            $interested->fill($request->all());
            $status = $interested->update();
        }
        if ($status) {
            return parent::json('200', true, 'Successfully added to interested');
        } else {
            return parent::json('500', false, 'Something went wrong, Please try again');
        }
    }

    /**
     * @param Feed $feed
     * @return \Illuminate\Http\JsonResponse
     */
    public function feed($id, Request $request)
    {
        $feed = Feed::query()->find($id);
        $data = FeedPageResource::make($feed);
        return parent::json('200', true, 'Received Data', $data);
    }

    // get all feeds
    public function feeds(Request $request)
    {
        $data = FeedItemResource::collection(Feed::latest('id')->get());
        return parent::json('200', true, 'Received Data', $data);
    }





    public function like(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'feed_id' => ['required'],

        ]);
        if ($validator->fails()) {
            return Parent::json('422', 'false', $validator->messages()->first(), $validator->messages());
        }
        $like = Like::where('user_id', $request->user()->id)->where('feed_id', $request->feed_id)->first();
        if ($like == null) {
            $request->user_id = $request->user()->id;
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            $status = Like::create($data);
        } else {
            $like->fill($request->all());
            $status = $like->update();
        }
        if ($status) {
            return parent::json('200', true, 'Successfully Liked feed');
        } else {
            return parent::json('500', false, 'Something went wrong, Please try again');
        }
    }

    // dislike Feed
    public function dislike(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'feed_id' => ['required'],

        ]);
        if ($validator->fails()) {
            return Parent::json('422', 'false', $validator->messages()->first(), $validator->messages());
        }
        $like = Like::where('user_id', $request->user()->id)->where('feed_id', $request->feed_id)->first();
        if ($like != null) {
            $status = $like->delete();
        } else {
            return parent::json('500', false, 'Something went wrong, Please try again');
        }
        if ($status) {
            return parent::json('200', true, 'Successfully DisLiked feed');
        } else {
            return parent::json('500', false, 'Something went wrong, Please try again');
        }
    }

    public function addressGet(Request $request)
    {

        $data = AddressResource::collection($request->user()->addresses);
        return parent::json('200', true, 'Received Data', $data);
    }


    public function address(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'street_address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'zip' => ['required'],

        ]);
        if ($validator->fails()) {
            return Parent::json('422', 'false', $validator->messages()->first(), $validator->messages());
        }

        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $status = Address::create($data);

        if ($status) {
            return parent::json('200', true, 'Successfully address added');
        } else {
            return parent::json('500', false, 'Something went wrong, Please try again');
        }
    }
    // updated address Address Model
    public function addressUpdate($address, Request $request)
    {
        $address = Address::findorfail($address);
        $validator = \Validator::make($request->all(), [
            'street_address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'zip' => ['required'],

        ]);
        if ($validator->fails()) {
            return Parent::json('422', 'false', $validator->messages()->first(), $validator->messages());
        }
        $address->fill($request->all());
        $status = $address->update();
        if ($status) {
            return parent::json('200', true, 'Successfully address updated');
        } else {
            return parent::json('500', false, 'Something went wrong, Please try again');
        }
    }


    // deleted address Address Model
    public function addressDelete($address)
    {
        $address = Address::findorfail($address);
        $status = $address->delete();
        if ($status) {
            return parent::json('200', true, 'Successfully address deleted');
        } else {
            return parent::json('500', false, 'Something went wrong, Please try again');
        }
    }

    // get Attrabiute
    public function arrtabiute(Request $request)
    {
        $attribute = Attrabiute::all();
        if ($attribute == null) {
            return parent::json('500', false, 'Something went wrong, Please try again');
        } else {
            $data = AttrabiuteResource::collection($attribute);
            return parent::json('200', true, 'Received Data', $data);
        }
    }


    // get Catalog
    public function catalog(Request $request)
    {
        $catalog = Catalog::latest('id')->get();
        if ($catalog == null) {
            return parent::json('500', false, 'Something went wrong, Please try again');
        } else {
            $data = CatalogResource::collection($catalog);
            return parent::json('200', true, 'Received Data', $data);
        }
    }


    public function setting()
    {
        $setting = Settings::first();
        if ($setting == null) {
            return parent::json('500', false, 'Something went wrong, Please try again');
        } else {
            $data = SettingResource::make($setting);
            return parent::json('200', true, 'Received Data', $data);
        }
    }


    // notification
    public function notification(Request $request)
    {
        $notification = Notification::where('user_id', $request->user()->id)->latest('id')->get();
        if ($notification == null) {
            return parent::json('500', false, 'Something went wrong, Please try again');
        } else {
            $data = NotificationResource::collection($notification);
            return parent::json('200', true, 'Received Data', $data);
        }
    }

    // notification
    public function notificationCount(Request $request)
    {
        $notification = Notification::where('user_id', $request->user()->id)->where('status', 0)->count();
        if ($notification == null) {
            return parent::json('500', false, 'Something went wrong, Please try again');
        } else {
            return parent::json('200', true, 'Received Data', $notification);
        }
    }

    // notification
    public function notificationRead(Request $request)
    {
        $notification = Notification::where('user_id', $request->user()->id)->where('status', 0)->update(['status' => 1]);
        if ($notification == null) {
            return parent::json('500', false, 'Something went wrong, Please try again');
        } else {
            return parent::json('200', true, 'Received Data', $notification);
        }
    }


    //get All employees
    public function employees(Request $request)
    {
        $employees = Employee::all();
        if ($employees == null) {
            return parent::json('500', false, 'Something went wrong, Please try again');
        } else {
            $data = EmployeeResource::collection($employees);
            return parent::json('200', true, 'Received Data', $data);
        }
    }



    // get all shipping method
    public function shippingMethod(Request $request)
    {
        $shippingMethod = ShippingMethod::latest('id')->get();
        if ($shippingMethod == null) {
            return parent::json('500', false, 'Something went wrong, Please try again');
        } else {
            $data = ShippinMethodResource::collection($shippingMethod);
            return parent::json('200', true, 'Received Data', $data);
        }
    }


    public function delete_user()
    {
        User::query()->find(auth('api')->id())->delete();
        Rate::query()->where('user_id', auth('api')->id())->delete();
        Like::query()->where('user_id', auth('api')->id())->delete();
        Interested::query()->where('user_id', auth('api')->id())->delete();
        Favorite::query()->where('user_id', auth('api')->id())->delete();
        Address::query()->where('user_id', auth('api')->id())->delete();

        return parent::json('200', true, 'Deleted Successfully', []);
    }
    public function profileImageUpdate(Request $request)
    {

        // $this->validate($request, [
        //     'img' => 'required'
        // ]);
        $user = User::find(auth()->user()->id);
        // $path = $request->img->store('Users/imgs');
        // return $path;
        $image_name = time() . '_' . $request->file('img')->getClientOriginalName();
        $request->file('img')->storeAs('public/users/imgs', $image_name);
        $path  =  asset('/storage/users/imgs/' . $image_name);
        $user->img = $path;
        $user->save();
        return response()->json([
            'status' => 'successful',
            'profile_img' => $user->img
        ]);
    }
    public function appVersion()
    {
        $version = \DB::table('app')->first()->version;
        return $version;
    }
}
