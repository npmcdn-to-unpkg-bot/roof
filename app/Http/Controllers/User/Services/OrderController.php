<?php

namespace App\Http\Controllers\User\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use LiqPay;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liqpay = new LiqPay(env("LIQPAY_PUBLIC_KEY"), env("LIQPAY_PRIVAT_KEY"));

        $orders = auth()
            ->user()
            ->orders()
            ->orderBy('payed')
            ->orderBy('created_at','desc')
            ->paginate(15);

        $th = [
            ['title'=>'',         'width'=>'45px'  ],
            ['title'=>'#',        'width'=>'90px'  ],
            ['title'=>'Дата',     'width'=>'90px'  ],
            ['title'=>'Заказ',    'width'=>'auto'  ],
            ['title'=>'Статус',   'width'=>'200px' ],
            ['title'=>'',         'width'=>'100px' ],
            ['title'=>'',         'width'=>'100px' ]
        ];
        $table=collect()->push($th);
        foreach ($orders as $order){
            $table->push([
                [
                    'edit'=>false,
                    'delete'=> $order->payed ? false : route('user.orders.destroy', $order),
                    'type'=>'actions',
                ],[
                    'field'=>$order->id,
                    'type'=>'text',
                ],[
                    'field'=>$order->created_at->format('d.m.Y'),
                    'type'=>'text',
                ],[
                    'field'=>$order->service->name,
                    'type'=>'text',
                ],[
                    'field'=>$order->payed ? 'Оплачено' : 'Ожидает оплаты',
                    'type'=>'text',
                ],[
                    'html' => (!$order->payed)&&auth()->user()->reserves()->where('service_id',$order->service->id)->first()?'<a href="/user/orders/reserve/'.$order->id.'" class="btn btn-lg btn-primary">Использовать резерв</a>':''  ,
                    'type'=>'html',
                ],[
                    'html' => $order->payed ? '' : $liqpay->cnb_form([
                            'version'        => 3,
                            'action'         => 'pay',
                            'amount'         => $order->service->price,
                            'currency'       => 'UAH',
                            'description'    => $order->service->name,
                            'order_id'       => $order->id,
                            'result_url'     => route('user.orders.index'),

                        ]),
                    'type'=>'html',
                ],
            ]);
        }
        return view('admin.universal.index', [
            'table' => $table,
            'items' => $orders,
            'title' => 'Счета',
            'pagination' => $orders->render()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $signature = base64_encode( sha1( 
            $this->private_key .  
            $request->data . 
            $this->private_key
            , 1 ));
        if ($request->signature == $signature) {
            $data = json_decode ( base64_decode ($request->data) );
            $order = Order::find($data->order_id);
            $order->liqpay_response = base64_decode ($request->data);
            if ($data->status=='success') {
                $order->payed = 1;
                $order->apply();
            }else{
                $order->payed = 0;
            }
            $order->save();
        }else{
            abort(404);
        }
        return redirect()->route('user.orders.index');
    }

    public function use_reserve($id) {
        $user = auth()->user();
        $order = Order::find($id);
        $reserve = $user->reserves()->where('service_id',$order->service->id)->first();
        if ($order->user_id == $user->id && $reserve->count > 0) {
            $order->payed = 1;
            $order->apply();
            $order->save();
            
            $reserve->count -= 1;
            $reserve->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->orders()->where('id',$id)->delete();
        return back();
    }
}

