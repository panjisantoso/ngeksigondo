<?php

namespace App\Exports;

use App\Models\DetailRealisasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB; 

class RealisasiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;

    public function __construct($startDate, $endDate, $id_kabupaten)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->id_kabupaten = $id_kabupaten;
    }

    use Exportable;

    public function view(): View
    {
        if($this->id_kabupaten == ""){
            $detailRealisasi = DetailRealisasi::whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
            return view("realisasi_excel", compact("detailRealisasi"));
        }else{
            $detailRealisasi = DetailRealisasi::where('id_kabupaten',$this->id_kabupaten)->whereBetween(DB::raw('DATE(tanggal)'), array($this->startDate, $this->endDate))->get();
            return view("realisasi_excel", compact("detailRealisasi"));
        }
        
    }
}
