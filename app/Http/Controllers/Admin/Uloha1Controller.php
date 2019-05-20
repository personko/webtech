<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Uloha1;

class Uloha1Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Create a model to work with data
        $uloha1 = new Uloha1();

        if (Auth::user()->hasRole('Admin'))
        {
            return view('uloha1.adminIndex', ["subjects" => $uloha1->getAllSubjects(Auth::user()->ais_id)]);
        }
        else
        {
            $uloha1 = new Uloha1();

            $subjects = $uloha1->getAllSubjects4AisId(Auth::user()->ais_id);

            return view('uloha1.studentShow', ['subjects' => $subjects]);
        }
        return view('uloha1.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()->hasRole('Admin'))
        {
            return view('uloha1.create');
        }
        else
        {
            return redirect()->route('uloha1.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (Auth::user()->hasRole('Admin'))
        {
            $uloha1 = new Uloha1();

            $points = $uloha1->getAllPoints4Subject($request->get('id'));

            return view('uloha1.adminShow', ['points' => $points]);
        }
        else
        {
            return redirect()->route('uloha1.index');
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input fields
        request()->validate([
            'nazov' => 'required',
            'skolsky_rok' => 'required',
            'semester' => 'required',
            'oddelovac' => 'required',
            'csv_import' => 'required|mimes:csv,txt'
        ]);

        // Create a model to work with data
        $uloha1 = new Uloha1();

        // Convert csv to array
        $csv_data = $uloha1->csvToArray($request->file('csv_import')->getRealPath(), $request->post('oddelovac'));
        $headers = array_shift($csv_data);

        // Save input data to database
        $uloha1->save([
            'nazov' => $request->post('nazov'),
            'skolsky_rok' => $request->post('skolsky_rok'),
            'semester' => $request->post('semester'),
            'columns' => json_encode($headers),
            'nahral' => Auth::user()->ais_id
        ], $csv_data);

        // If everything was okay, redirect user to uloha1 index page
        return redirect()->route('uloha1.index')
            ->with('success','Výsledky z predmetu boli úspešne nahraté!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $subject)
    {
        $keyArray = array_keys($subject->query());

        $uloha1 = new Uloha1();

        $uloha1->delete($keyArray[0]);

        return redirect()->route('uloha1.index')
                        ->with('success','Predmet bol úspešne vymazaný');
    }
}
