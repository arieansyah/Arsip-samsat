<?php

namespace App\Http\Controllers;

use App\Arsip;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DataArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('data-arsip.index');
    }

    public function listData()
    {
        $arsip = Arsip::orderBy('id', 'desc')->get();
        $data = array();
        foreach($arsip as $list){
            $awal = starts_with($list->no_reg, 'H');
            $end = ends_with($list->no_reg, ['A','P','H','S','F']);
            if ($awal && $end == true) {
                $result = '<span class="label label-success">LOKAL</span>';
            }else{
                $result = '<span class="label label-primary">ONLINE</span>';
            };

            $getStart = $list->start;
            $end = date('Y-m-d', strtotime('+1 year', strtotime($getStart)));

            $row = array();
            $row[] = $list->no_reg;
            $row[] = $list->nama;
            $row[] = $list->alamat;
            $row[] = Carbon::parse($list->masa_berlaku)->format('d F Y');
            $row[] = Carbon::parse($list->start)->format('d F Y');
            $row[] = $result;

            $row[] = '<div class="btn-group">
                    <a onclick="showDetail('.$list->id.')" class="btn bg-aqua btn-sm"><i class="fa fa-eye"></i></a>
                    <a onclick="editForm('.$list->id.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                    <a onclick="deleteData('.$list->id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
            $data[] = $row;
        }

        $output = array("data" => $data);
        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arsip = new Arsip;
        $arsip->no_reg = $request->no_reg;
        $arsip->nama = $request->nama;
        $arsip->alamat = $request->alamat;
        $arsip->masa_berlaku = $request->masa_berlaku;
        $arsip->start = $request->start;
        $getStart = $arsip->start;
        $arsip->end = date('Y-m-d', strtotime('+1 year', strtotime($getStart)));
        //dd($arsip);
        $arsip->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arsip = Arsip::find($id);        
        echo json_encode($arsip);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arsip = Arsip::find($id);
        echo json_encode($arsip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arsip = Arsip::find($id);
        $arsip->no_reg = $request->no_reg;
        $arsip->nama = $request->nama;
        $arsip->alamat = $request->alamat;
        $arsip->masa_berlaku = $request->masa_berlaku;
        $arsip->start = $request->start;        
        $getStart = $arsip->start;
        $arsip->end = date('Y-m-d', strtotime('+1 year', strtotime($getStart)));
        //dd($arsip);
        $arsip->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arsip = Arsip::find($id);
        $arsip->delete();
    }

    public function __construct(){
        $this->middleware('auth');
    }
}
