<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function index()
    {
        $members = Member::all();

        $ketua = $members->where('role', 'Ketua Klub')->first();
        $wakil = $members->where('role', 'Wakil Ketua')->first();
        $sekretaris1 = $members->where('role', 'Sekretaris 1')->first();
        $sekretaris2 = $members->where('role', 'Sekretaris 2')->first();
        $bendahara = $members->where('role', 'Bendahara')->first();

        return view('pages.structure', compact('ketua', 'wakil', 'sekretaris1', 'sekretaris2', 'bendahara'));
    }
}
