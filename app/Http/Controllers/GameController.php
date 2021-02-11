<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param int $week
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request,$week =4)
    {

        $last = Game::where('week','=',$week)->get();

        if ($request->ajax()) {
//            $data = Game::where('week','=',2)->get();
            $data = Game::tableByWeek($week);
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $current_week = (integer)Game::max('week') + 1;
        $matches = Game::newMatch();
        $result = [];
        foreach ($matches as $match){
            $teams = explode('-',$match);
            $result[]=[
                'home_team' => $teams[0],
                'away_team' => $teams[1],
                'home_score' => rand(0,5),
                'away_score' => rand(0,5),
                'week' => $current_week
            ];

        }
        Game::insert($result);
        return redirect(route('home.index'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
