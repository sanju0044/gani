<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MentorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.mentors', [
            'data' => User::where('user_type', '3')->with('cityModel')->with('stateModel')->get()
        ]);
    }
}
