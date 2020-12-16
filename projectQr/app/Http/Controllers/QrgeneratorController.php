<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qrgenerator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class QrgeneratorController extends Controller
{
    public function index()
    {
        $qrgenerator = Qrgenerator::latest()->get();
        return view('qrpages.index', compact('qrgenerator'));
    }
    public function queryString(Request $request)
    {
        $param = $request->input('generatedUrl');
        $url = DB::table('qrgenerators')->where('generatedUrl', $param)->first();
        if (!$url) {
            abort(404);
        } else {
            return Redirect::to($url->redirectionUrl);
        }
    }
    // public function create()
    // {
    //     return view('qrpages.create');
    // }
    public function qrform()
    {
        $qrgenerator = Qrgenerator::latest()->get();

        return view('qrpages.qrform', compact('qrgenerator'));
    }

    public function store()
    {
        Qrgenerator::create($this->validateFields());
        // return redirect()->route('qrpages.index');
        return view('qrpages.qrform');
    }
    // public function update(Qrgenerator $qrgenerator)
    // {
    //     $qrgenerator = new Qrgenerator();
    //     $qrgenerator->redirectionUrl = request('redirectionUrl');
    //     $qrgenerator->save();
    //     return redirect()->route('qrpages.index');
    // }
    protected function validateFields()
    {
        return request()->validate([
            'generatedUrl' => 'required',
            'redirectionUrl' => 'required'
        ]);
    }
    public function createResource()
    {
        Qrgenerator::create($this->validateFields());
        return view('qrpages.qrform');
    }
    protected function updateResource()
    {
        $paramOrigin = request('generatedUrl');
        $paramRedirection = request('redirectionUrl');
        if (strlen($paramOrigin) > 0 && strlen($paramRedirection) > 0) {
            $affected = DB::table('qrgenerators')
                ->where('generatedUrl', $paramOrigin)
                ->update(['redirectionUrl' => $paramRedirection]);
            return $affected;
            // return view('qrpages.qrform');
        }
    }
    protected function updateAndStore(Request $request)
    {
        $param = $request->input('generatedUrl');
        $resource = DB::table('qrgenerators')->where('generatedUrl', $param)->first();
        if (!$resource) {
            return  $this->createResource();
        } else {
            return $this->updateResource();
        }
        // return view('qrpages.qrform');
    }
    protected function gettingValues(Request $request)
    {
        $input = $request->all();
        dd($input);
    }
}
// validar si url es correcta, si el campo no esta vacio, y q ambso datos existen al enviar
