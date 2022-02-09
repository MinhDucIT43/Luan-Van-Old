<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\nhanvien;
use App\Models\ban;
use App\Models\chucvu;
use App\Models\sanpham;
use App\Models\mon;
use App\Models\nhommon;
use App\Models\temp;

use Session;

class BanHangController extends Controller
{
    public function Admin(){
        if(Session::get('thungan') && Session::get('vaitrothungan')){
            $mon = mon::orderBy('MaMon','ASC')->paginate(10);
            $data = ban::orderBy('MaBan','ASC')->get();
            return view('banhang.admin',['mon'=>$mon,'data'=>$data]);
        }else {
            return redirect()->route('showlogin');
        }
        if(Session::get('phucvu') && Session::get('vaitrophucvu')){
            return view('banhang.admin',compact('data'));
        }else {
            return redirect()->route('showlogin');
        }
    }

    public function SoBan($MaBan){
        if(Session::get('thungan') && Session::get('vaitrothungan')){
            $mon = mon::orderBy('MaMon','ASC')->paginate(5);
            $banso = ban::where('MaBan',$MaBan)->get();
            return view('banhang.chitietban',['mon'=>$mon,'banso' => $banso]);
        }else{
            return redirect()->route('showlogin');
        }
    }

    public function postThemMonChon(Request $request){
        if(Session::get('thungan') && Session::get('vaitrothungan')){
            $mon = mon::orderBy('MaMon','ASC')->paginate(5);
            $banso = ban::where('MaBan',$request->maban)->get();

            $temp = new temp();
            $temp->MaBan =$request->maban;
            $temp->MaMon = $request->mamon;
            $temp->soluong = $request->soluong;
            $temp->save();
            return view('banhang.chitietban',['mon'=>$mon,'banso'=>$banso]);
        }else{
            return redirect()->route('showlogin');
        }
    }
}