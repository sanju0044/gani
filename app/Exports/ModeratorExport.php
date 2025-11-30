<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ModeratorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.moderators', [
            'data' => User::where('user_type', '2')->with('cityModel')->with('stateModel')->get()
        ]);
    }
}
