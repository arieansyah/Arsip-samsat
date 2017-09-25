<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = 'arsips';

    protected $fillable =['no_reg', 'nama', 'alamat', 'masa_berlaku', 'status', 'start'];

    public function setMasaBerlakuAttribute($date){
		 $this->attributes['masa_berlaku'] = Carbon::createFromFormat('d F Y', $date)->format('Y-m-d');
	}

	public function getMasaBerlakuAttribute($value){
		  return Carbon::parse($value)->format('d F Y');
	}	

    public function setStartAttribute($date){
		 $this->attributes['start'] = Carbon::createFromFormat('d F Y', $date)->format('Y-m-d');
	}

	public function getStartAttribute($value){
		return Carbon::parse($value)->format('d F Y');
	}

	/*public function setEndAttribute($date){
		 $this->attributes['end'] = Carbon::createFromFormat('d F Y', $date)->format('Y-m-d');
	}*/

	public function getEndAttribute($value){
		return Carbon::parse($value)->format('d F Y');
	}


	public function setNoRegAttribute($value){
		$this->attributes['no_reg'] = strtoupper($value);
	}
}
