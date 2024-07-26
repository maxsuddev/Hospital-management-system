<?php

namespace App\Http\Controllers;

use App\Helpers\TelegramHelper;
use App\Models\CashBox;
use App\Models\CashBoxDoctor;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\Order;
use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('order.list', compact('orders'))->with('service');
    }

    public function create()
    {
        $categories = Category::with('services','persons')->get();
        return view('order.create', compact('categories'));
    }

    public function show(Order $order)
    {
        $order->load('service');
        return view('order.show', compact('order'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer',
            'services' => 'required|array',
            'services.*.person_id' => 'required|exists:persons,id',
            'services.*.id' => 'exists:services,id',
            'services.*.quantity' => 'required|integer',
            'services.*.price' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'full_name' => $validatedData['full_name'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
                'age' => $validatedData['age'],
            ]);

            foreach ($request->services as $service) {
                $order->service()->attach($service['id'], [
                    'quantity' => $service['quantity'],
                    'price' => $service['price'],
                ]);

                $orderService = OrderService::where('order_id', $order->id)
                    ->where('service_id', $service['id'])
                    ->first();

                if (!$orderService) {
                    throw new \Exception("OrderService could not be created");
                }

                $cashBox = CashBox::where('id' ,1)->first();

                if ($cashBox) {
                    $cashBox->remains += $service['price'];
                    $cashBox->sum = $service['price'];
                    $cashBox->save();
                }



                CashBoxDoctor::create([
                    'doctor_id' => $service['person_id'],
                    'order_service_id' => $orderService->id,
                    'sum' => $service['price'] / 2,
                    'remains' => $service['price'] / 2,
                    'comment' => 'Order ID: ' . $order->id . ', Service ID: ' . $service['id'],
                ]);



                $doctor = Doctor::find($service['person_id']);
                if ($doctor) {
                    $doctor->balance += $service['price'] / 2;
                    $doctor->save();


                    $message = "Yangi buyurtma tushdi!\n\n"
                        . "Buyurtma raqami: " . $order->id . "\n"
                        . "To'liq ismi: " . $order->full_name . "\n"
                        . "Yosh: " . $order->age . "\n"
                        . "Sizning hisobingizga: " . $service['price']/2  .  " ". "sum" . " " . "qo'shildi" ."\n"
                        . "Sizning hisobingiz: " . $doctor->balance . "sum" . "\n";

                    TelegramHelper::sendMessage($doctor->telegram_id, $message);
                } else {
                    throw new \Exception("Doctor not found");
                }
            }

            DB::commit();

            return redirect()->route('order.show', $order->id)->with('success', 'Buyurtma muvaffaqiyatli yaratildi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Buyurtma yaratishda xatolik yuz berdi: ' . $e->getMessage()]);
        }
    }

}
