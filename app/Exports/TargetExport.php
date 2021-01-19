<?php

namespace App\Exports;

use App\Models\RealisasiTarget;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB; 

class TargetExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;

    public function __construct($startDate, $endDate, $id_kabupaten, $jenis)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->id_kabupaten = $id_kabupaten;
        $this->jenis = $jenis;
    }

    use Exportable;

    public function view(): View
    {
        // if(($this->id_kabupaten == "") && ($this->jenis != "")){
        //     $targetRealisasi = RealisasiTarget::whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
        //     return view("target_excel", compact("targetRealisasi"));
        // }elseif(($this->id_kabupaten != "") && ($this->jenis == "")){
        //     $targetRealisasi = RealisasiTarget::whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
        //     return view("target_excel", compact("targetRealisasi"));
        // }elseif(($this->id_kabupaten != "") && ($this->jenis != "")){
        //     $targetRealisasi = RealisasiTarget::whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
        //     return view("target_excel", compact("targetRealisasi"));
        // }else{
        //     $targetRealisasi = RealisasiTarget::whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
        //     return view("target_excel", compact("targetRealisasi"));
        // }

        if(($this->id_kabupaten == "") && ($this->jenis == "")){
            $targetRealisasi = RealisasiTarget::whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
            return view("target_excel", compact("targetRealisasi"));
        }elseif(($this->id_kabupaten != "") && ($this->jenis == "")){
            $targetRealisasi = RealisasiTarget::where('id_kabupaten',$this->id_kabupaten)->whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
            return view("target_excel", compact("targetRealisasi"));
        }elseif(($this->id_kabupaten == "") && ($this->jenis != "")){
            $targetRealisasi = RealisasiTarget::where('jenis',$this->jenis)->whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
            return view("target_excel", compact("targetRealisasi"));
        }elseif(($this->id_kabupaten != "") && ($this->jenis != "")){
            $targetRealisasi = RealisasiTarget::where('jenis',$this->jenis)->where('id_kabupaten',$this->id_kabupaten)->whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
            return view("target_excel", compact("targetRealisasi"));
        }
    }
}
