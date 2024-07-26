<?php

namespace App\Http\Controllers;

use App\Helpers\TelegramHelper;
use App\Models\CashBox;
use App\Models\Doctor;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DoctorController extends Controller
{


    public function index()
    {
        $doctors = Doctor::with('categories')->get();
        return view('doctor.list', compact('doctors'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('doctor.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'telegram_id' => 'required|string|max:255',
            'birthday' => 'required|date',
            'balance' => 'nullable|numeric',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id'
        ]);

        $doctor = Doctor::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'telegram_id' => $validated['telegram_id'],
            'birthday' => $validated['birthday'],
            'balance' => $validated['balance'] ?? 0,
        ]);

        $doctor->categories()->sync($validated['category_id']);

        return redirect()->route('doctor.index')->with('success', 'Doctor created successfully.');
    }

//    public function show(Doctor $doctor)
//    {
//        return view('doctor.show', compact('doctor'));
//    }

    public function edit(Doctor $doctor)
    {
        $categories = Category::all();
        return view('doctor.edit', compact('doctor', 'categories'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'telegram_id' => 'required|max:255',
            'birthday' => 'required|date',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id'
        ]);

        $doctor->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'telegram_id' => $validated['telegram_id'],
            'birthday' => $validated['birthday'],
        ]);

        $doctor->categories()->sync($validated['category_id']);

        return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->categories()->detach();
        $doctor->delete();
        return redirect()->route('doctor.index')->with('success', 'Doctor deleted successfully.');
    }
    public function withdraw(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $amount = $request->input('amount');

        if ($amount > 0 && $doctor->balance >= $amount) {
            $doctor->balance -= $amount;
            $doctor->save();

            if ($doctor->telegram_id) {

                $message_user ="<b> Diqqat sizning hisobingizdan pul yechildi!</b>\n\n"
                    . "<b>Yechilgan pul miqdori: </b> $amount SO'M\n"
                    . "<b>Sizning hisobingiz : $doctor->balance SO'M qoldi</b>\n";

                TelegramHelper::sendMessage($doctor->telegram_id, $message_user);
            }


            $cashBox = CashBox::find(1);
            if ($cashBox) {
                $cashBox->remains -= $amount;
                $cashBox->save();

                $message = "<b>Kassadan doctor uchun pull olindi</b>\n\n"
                    . "<b>Doctor :</b> " . $doctor->first_name . ' ' . $doctor->last_name . "\n"
                    . "<b>Yechib olingan summa: </b>" . $amount. ' ' . "SO'M" . "\n";

                TelegramHelper::sendMessage(config('services.telegram.owner_id'), $message);
            }

            return redirect()->route('doctor.index')->with('success', 'Pul muvaffaqiyatli yechildi.');
        } else {
            return redirect()->route('doctor.index')->with('success', 'Yechish uchun mablag\' yetarli emas yoki miqdor noto\'g\'ri.');
        }
    }






}
