<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Uloha2;

class Uloha2Controller extends Controller
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
    public function index(Request $request) {
        $uloha2 = new Uloha2();

        if (Auth::user()->hasRole('Admin')) {
        } else {
            $subjects = $uloha2->getAllSubjects(Auth::user()->ais_id);
            if (empty($subjects)) {
                return redirect()->back()
                    ->with('error','Nemas ziadny registrovany predmet.');
            }

            $subjectId = $request->post('subject_id');
            if(isset($subjectId)) {
                $subjects = $this->orderSubjects($subjects, $subjectId);
            }
            $team = $uloha2->getTeam($subjectId, Auth::user()->ais_id);
            $data  = $uloha2->getStudentTeamData($subjectId, $team);
            $pointsSet = true;
            $adminAgreed = false;
            $studentAgreed = false;
            foreach ($data as $row) {
                if (!isset($row->student_points)) {
                    $pointsSet = false;
                }
                if ($row->ais_id == Auth::user()->ais_id && isset($row->student_confirm)) {
                    $studentAgreed = true;
                }
                if (isset($row->admin_confirm)) {
                    $adminAgreed = true;
                }
            }
            return view('uloha2.index', ["subjectId" => $subjectId, "subjects" => $subjects, 'teamData' => $data, 'pointsSet' => $pointsSet, 'studentAgreeFilled' =>$studentAgreed, 'adminAgreedFilled' => $adminAgreed, 'team' => $team]);
        }
    }

    public function studentShow(Request $request) {
        $uloha2 = new Uloha2();
        if (Auth::user()->hasRole('Admin')) {

        } else {
        }
    }

    public function store(Request $request){
    $uloha2 = new Uloha2();
    if (Auth::user()->hasRole('Admin')) {

    } else {
        $subjectId = $request->post('subject_id');
        $accept = $request->post('accept');
        $decline = $request->post('decline');
        if (isset($accept)) {
            $uloha2->submitStatement($subjectId, Auth::user()->ais_id, true);
            return redirect()->back()
                ->with('success', 'Rozdelenie bodov bolo akceptovane.');
        } else if (isset($decline)) {
            $uloha2->submitStatement($subjectId, Auth::user()->ais_id, false);
            return redirect()->back()
                ->with('error', 'Rozdelenie bodov bolo zamietnute.');
        } else {

            $data = $uloha2->getStudentTeamData($subjectId, $uloha2->getTeam($subjectId, Auth::user()->ais_id));
            $countPoits = 0;
            foreach ($data as $row) {
                $teamPoints = $row->tim_points;
                $points = $request->post($row->id);
                $countPoits += $points;
                if ($countPoits > $teamPoints) {
                    return redirect()->back()
                        ->with('error', 'Sucet rozdelenych bodov je vacsi ako pocet timovych bodov.');
                }
            }
            foreach ($data as $row) {
                $uloha2->storePoints($row->id, $request->post($row->id));
            }
            return redirect()->back()
                ->with('success', 'Body boli pridelene.');
        }
    }
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

    private function orderSubjects($subjects, $id){
        $result = array();
        foreach ($subjects as $subject) {
            if($subject->id == $id) {
                array_unshift($result, $subject);
            } else {
                $result[] =$subject;
            }
        }
        return $result;
    }
}
