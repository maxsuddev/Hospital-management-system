<?php

namespace App\Http\Controllers;

use App\Helpers\TelegramHelper;
use App\Models\CashBox;
use Illuminate\Http\Request;

class CashBoxController extends Controller
{
    public function index(){
        $cashBoxes = CashBox::all();
        return view('bill.list', compact('cashBoxes'));
    }

    public function inkassa($id)
    {
        $cashBox = CashBox::findOrFail($id);
        if ($cashBox !== null) {
            $message = "Diqqat Inkass amali bajarildi!\n\n"
                    . "Inkassaning umumiy sumasi: " . $cashBox->remains . "\n";

            TelegramHelper::sendMessage(config('services.telegram.owner_id'), $message);
            $cashBox->remains = 0;
            $cashBox->save();
}
        return redirect()->route('cash_box.index')->with('success', 'Inkassa muvaffaqiyatli bajarildi.');
    }
        public
        function create()
        {
            return view('bill.create');
        }

        public
        function cost(Request $request)
        {
            $request->validate([
                'cost' => 'required',
                'comment' => 'required'
            ]);

            $cash = new CashBox();
            $cash->comment = $request->comment;
            $cash->cost = $request->cost;


            $cashBox = CashBox::find(1);
            if ($cashBox) {
                $cashBox->remains -= $request->cost;
                $cashBox->save();

                $message = "Kassadan  pull olindi!\n\n"
                    . "Pul olish izoxi: " . $cash->comment . "\n"
                    . "Yechib olingan summa: " . $cash->cost . "sum" . "\n";

                TelegramHelper::sendMessage(config('services.telegram.owner_id'), $message);
            }
            return redirect()->route('cash_box.index')->with('success', 'Kassadan  pull olindi!');
        }
    }
