<?php

namespace App\Http\Controllers;

use App\Arsip;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

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
	
	public function printWidPdf(Request $request, $id)
	{
		$arsip = Arsip::findOrFail($id);
		$dompdf = PDF::loadView('data-arsip.print', compact('arsip'))->setPaper(array(0,0,595.2755905512,283.4645669291));
		return $dompdf->stream($arsip->nama.'_'.$arsip->no_reg.'.pdf');
	}

	public function printPdf(Request $request){
		$dataarsip = array();
		foreach ($request['oke'] as $value) {
			$arsip = Arsip::where('status_pmb', '=', $value)->get();
			$dataarsip[] = $arsip;	
		}

		$no = 0;
		$pdf = PDF::loadView('data-arsip.pdf', compact('arsip','dataarsip', 'no'));
		$pdf->setPaper('a4', 'potrait');
		$date = Carbon::now()->year;
		return $pdf->stream('Arsip_'.$date.'.pdf');
	}

	public function cetak(){
		return view('data-arsip.cetak');
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

			if ($list->status_pmb == 'Denda'){
				$pmb = '<span class="label label-danger">Denda</span>';
			}else{
				$pmb = '<span class="label label-success">Tidak Denda</span>';
			}

			$getStart = $list->start;
			$end = date('Y-m-d', strtotime('+1 year', strtotime($getStart)));

			$row = array();
			$row[] = $list->no_reg;
			$row[] = $list->nama;
			$row[] = Carbon::parse($list->masa_berlaku)->format('d F Y');
			$row[] = Carbon::parse($list->start)->format('d F Y');
			$row[] = $result;
			$row[] = $pmb;

			$row[] = '<div class="btn-group">
					<a onclick="showDetail('.$list->id.')" class="btn bg-aqua btn-sm"><i class="fa fa-eye"></i></a>
					<a onclick="editForm('.$list->id.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
					<a href="arsip/print/'.$list->id.'" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-print"></i></a>
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
		/*Status Id*/
			$awal = starts_with($request->no_reg, 'H');
			$end = ends_with($request->no_reg, ['A','P','H','S','F']);
			if ($awal && $end == true) {
				 $result = 'LOKAL';
			}else{
				 $result = 'ONLINE';
			};
		$arsip->status = $result;
		/*status pembayaran*/
			$now = Carbon::now()->toDateString();
			$masa_berlakux = Carbon::parse($request->masa_berlaku)->format('Y-m-d');         
			if ($masa_berlakux < $now){
				$pmb = 'Denda';
			}else{
				$pmb = 'Tidak Denda';
			}
		$arsip->status_pmb = $pmb;
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
		/*Status Id*/
			$awal = starts_with($request->no_reg, 'H');
			$end = ends_with($request->no_reg, ['A','P','H','S','F']);
			if ($awal && $end == true) {
				 $result = 'LOKAL';
			}else{
				 $result = 'ONLINE';
			};
		$arsip->status = $result;
		/*status pembayaran*/
			$now = Carbon::now()->toDateString();
			$masa_berlakux = Carbon::parse($request->masa_berlaku)->format('Y-m-d');         
			if ($masa_berlakux < $now){
				$pmb = 'Denda';
			}else{
				$pmb = 'Tidak Denda';
			}
		$arsip->status_pmb = $pmb;
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
