<?php

namespace App\Http\Controllers\Api;

use App\Entity\Currency;
use App\Http\Requests\CurrencyUpdateRateRequest;
use App\Jobs\SendRateChangedEmail;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrenciesController extends Controller
{
    public function updateRateCurrency(CurrencyUpdateRateRequest $request ,int $id)
    {
        $currency = Currency::findOrFail($id);

        if(Gate::denies('update' , $currency)){
            return redirect('/');
        }


        $oldRate = $currency->rate;
        $currency->rate = $request->input('rate');
        $currency->save();
        $users = User::where('is_admin', false)->get();
        foreach ($users as $user) {
            SendRateChangedEmail::dispatch($user, $currency, $oldRate)->onQueue('notification');
        }
        return response()->json($currency);
    }
}
