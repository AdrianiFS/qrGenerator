<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qrgenerator;
use Illuminate\Support\Facades\Redirect; //use for external redirection

class QrgeneratorController extends Controller
{
    public function index()
    {
        $qrgenerator = Qrgenerator::latest()->get();
        return view('qrpages.index', compact('qrgenerator'));
    }
    public function show(Qrgenerator $qrgenerator, Request $request)
    {
        // return view('qrpages.show', compact('qrgenerator'));
        return Redirect::to($qrgenerator['redirectionUrl']);
    }
    public function create()
    {
        return view('qrpages.create');
    }
    public function store()
    {
        Qrgenerator::create($this->validateFields());
        return redirect(route('qrpages.index'));
    }
}
















































// public function edit(Qrgenerator $qrgenerator)
//     {
//         return view('qrpages.edit', compact('qrgenerator'));
//     }
//     public function update(Qrgenerator $qrgenerator)
//     {
//         $qrgenerator->update($this->validateArticle());
//         return redirect(route('qrpages.show', $qrgenerator));
//     }
//     public function delete()
//     {
//         // delete ressource
//     }
//     protected function validateFields()
//     {
//         return request()->validate([
//             'generatedUrl' => 'required',
//             'redirectionUrl' => 'required'
//         ]);
//     }