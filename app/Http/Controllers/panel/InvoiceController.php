<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index ()
    {
        return view('panel.invoice-archive', [
            'orders' => Order::list(),
            'page_name' => 'invoices',
            'page_title' => 'سفارشات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    public function get (Order $order)
    {
        return view('panel.invoice-details', [
            'invoice' => Order::full_info($order),
            'page_name' => 'invoices',
            'page_title' => 'فاکتور #' . $order->id,
            'options' => $this->options(['site_name', 'site_logo', 'dollar_cost'])
        ]);
    }

    public function description (Order $order, $description)
    {
        Validator::make([ 'description' => $description ], [
            'description' => 'required|max:255|string',
        ])->validate();

        $order->update(['admin_description' => $description]);
        return redirect()->back()->with('message', 'توضیح شما برای فاکتور '.$order->id.'# با موفقیت ثبت شد .');
    }

    public function status (Order $order, $status)
    {
        Validator::make([ 'status' => $status ], [
            'status' => 'required|min:0|max:7|integer',
        ])->validate();

        $datetimes = json_decode($order->datetimes, true);
        switch ($status) {
            case 0: $datetimes['unpaid'] = time(); break;
            case 1: $datetimes['awaitingPayment'] = time(); break;
            case 2: $datetimes['paid'] = time(); break;
            case 3: $datetimes['pending'] = time(); break;
            case 4: $datetimes['packing'] = time(); break;
            case 5: $datetimes['sending'] = time(); break;
            case 6: $datetimes['posted'] = time(); break;
            case 7: $datetimes['canceled'] = time(); break;
        }
        $order->update([
            'datetimes' => json_encode($datetimes),
            'status' => $status
        ]);
        return redirect()->back()->with('message', 'وضعییت فاکتور '.$order->id.'# با موفقیت تغییر کرد .');
    }

    public function user_orders ()
    {
        $user_order = DB::select('SELECT `id` FROM `orders` WHERE `buyer` = ?', [\Auth::user()->id]);

        $id = '';
        foreach ($user_order as $order) 
        {
            $id .= "'".$order->id ."',";
        }

        $orders = DB::select('SELECT `buyer_description`, ((`shipping_cost` + `total`) - `offer`)
            AS \'total\', `status`, `created_at`, `payment` 
            FROM `Orders` WHERE `id` IN ('.rtrim($id, ',').')');
        

        $options = Option::select('name', 'value')->whereIn('name', 
            ['site_name', 'site_logo', 'site_description', 'social_link'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
                case 'site_description': $site_description = $option['value']; break;
                case 'social_link': $social_link = json_decode($option['value'], true); break;
            }
        }

        return view('store.orders', [
            'page_title' => 'سفارشات',
            'orders' => $orders,
            'site_name'=> $site_name,
            'site_logo'=> $site_logo,
            'site_description'=> $site_description,
            'social_link'=> $social_link,
            'cart_products' => $this -> Get_Cart_items(),
            'top_groups' => $this -> Get_sub_groups(),
            'dollar_cost' => 14500,
        ]);
    }
}
