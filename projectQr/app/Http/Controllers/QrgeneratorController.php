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
        return $qrgenerator;
        // return view('qrpages.index', compact('qrgenerator'));
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
    public function qrform()
    {
        $qrgenerator = Qrgenerator::latest()->get();

        return view('qrpages.qrform', compact('qrgenerator'));
    }
    public function store(Request $request)
    {
        $param = $request->input('generatedUrl');
        $resource = Qrgenerator::where('generatedUrl', $param)->first();
        if (!$resource) {
            Qrgenerator::create($this->validateFields());
        }
    }
    protected function validateFields()
    {
        return request()->validate([
            'generatedUrl' => 'required',
            'redirectionUrl' => 'required'
        ]);
    }
    protected function updateResource()
    {
        $paramOrigin = request('generatedUrl');
        $paramRedirection = request('redirectionUrl');
        $affected = Qrgenerator::where('generatedUrl', $paramOrigin)
            ->update(['redirectionUrl' => $paramRedirection]);
        return $affected;
    }
    protected function delete()
    {
        $paramOrigin = request('generatedUrl');
        Qrgenerator::where('generatedUrl', $paramOrigin)->delete();
    }
    // protected function gettingValues(Request $request)
    // {
    //     $input = $request->all();
    //     $param = $request->input('generatedUrl');

    //     if ($input['action'] === 'update') {
    //         $this->updateResource();
    //     }
    //     if ($input['action'] === 'delete') {
    //         $this->delete();
    //     }
    //     return redirect()->route('qrpages.qrform');
    // }
}
// validar si url es correcta, si el campo no esta vacio, y q ambso datos existen al enviar
// enviar mensaje de error a la vista si recourso existe o por cada variacion o error 
// enviar al servidor
// 1. tipo de action(update, delete), pq son valores q existen

// 2. q contienen las acciones(generatedUrl)

// 3. verificar ambos valores en el servidor 