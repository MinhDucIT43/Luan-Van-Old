<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\mon;
use App\Models\donvitinh;
use App\Models\nhommon;

use Session;

class MonController extends Controller
{
    public function Admin(){
        if(Session::get('admin') && Session::get('vaitroadmin')){
            $data = mon::orderBy('MaMon','DESC')->paginate(5);
            return view('mon.admin',['data' => $data]);
        }else {
            return redirect()->route('showlogin');
        }
    }

    public function getThemMon(){
        if(Session::get('admin') && Session::get('vaitroadmin')){
            $donvitinh = donvitinh::all();
            $nhommon = nhommon::all();
            return view('mon.themmon.themmon',['donvitinh' => $donvitinh, 'nhommon' => $nhommon]);
        }else{
            return redirect()->route('showlogin');
        }
    }

    public function postThemMon(Request $request){
        $request->validate([
            'gianhap'=>'numeric',
        ],[
            'gianhap.numeric'=>'Đơn giá: Vui lòng nhập số!'
        ]);
        if(Session::get('admin') && Session::get('vaitroadmin')){
            $mon = new mon();
            $mon->TenMon = $request->tenmon;
            $mon->MaNM = $request->nhommon;
            $mon->MaDVT = $request->donvitinh;
            if($request->gianhap<0){
                return redirect::back()->withInput()->with('error-dg','Giá không được âm');
                $check=false;
            }else{
                $mon->Gia = $request->gianhap;
            }
            $mon->save();
            $data = mon::orderBy('MaMon','DESC')->get();
            return redirect()->route('mon.admin',compact('data'))->with('alert','Thêm món ăn thành công.');
        }else{
            return redirect()->route('showlogin');
        }
    }

    public function getSuaMon($MaMon){
        if(Session::get('admin') && Session::get('vaitroadmin')){
            $data = mon::where('MaMon',$MaMon)->get();
            $nhommon = nhommon::all();
            $donvitinh = donvitinh::all();
            return view('mon.suamon.suamon',['data' => $data, 'nhommon' => $nhommon, 'donvitinh' => $donvitinh]);
        }else{
            return redirect()->route('showlogin');
        }
    }

    public function postSuaMon(Request $request, $MaMon){
        $request->validate([
            'gianhap'=>'numeric',
        ],[
            'gianhap.numeric'=>'Đơn giá: Vui lòng nhập số!'
        ]);
        if(Session::get('admin') && Session::get('vaitroadmin')){
            if($request->gianhap<0){
                return redirect::back()->withInput()->with('error-dg','Giá không được âm');
            }
            else{
                $mon = mon::where('MaMon',$MaMon)->update([
                    'TenMon' => $request->tenmon,
                    'MaNM' => $request->nhommon,
                    'MaDVT' => $request->donvitinh,
                    'Gia' => $request->gianhap
                ]);
            }
            $data = mon::orderBy('MaMon','DESC')->get();
            return redirect()->route('mon.admin',compact('data'))->with('alert','Sửa món ăn thành công.');
        }else{
            return redirect()->route('showlogin');
        }
    }

    public function XoaMon($MaMon){
        if(Session::get('admin') && Session::get('vaitroadmin')){
            mon::where('MaMon',$MaMon)->delete();
            $data = mon::orderBy('MaMon','DESC')->get();
            return redirect()->route('mon.admin',compact('data'))->with('alert','Xóa món ăn thành công.');
        }else{
            return redirect()->route('showlogin');
        }
    }
}
