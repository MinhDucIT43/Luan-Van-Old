<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\nhanvien;
use App\Models\ban;
use App\Models\chucvu;

use Session;

class DangNhapController extends Controller
{
    public function ShowLogin(){
        return view('auth.login');
    }

    public function Login(Request $request){
        $request->validate([
            'tendangnhap'=>'required',
            'matkhau'=>'required',
        ],[
            'tendangnhap.required'=>'Tên đăng nhập rỗng!',
            'matkhau.required'=>'Mật khẩu rỗng!',
        ]);
        $tendangnhap = $request->tendangnhap;
        $matkhau =  $request->matkhau;
        $vaitro1 = 61; //Admin
        $vaitro2 = 33; //Thu ngan
        $vaitro3 = 31; //Phuc vu
        $nhanvien1 = nhanvien::where('TenDangNhap',$tendangnhap)->where('MatKhau',$matkhau)->where('MaCV',$vaitro1)->first();
        $nhanvien2 = nhanvien::where('TenDangNhap',$tendangnhap)->where('MatKhau',$matkhau)->where('MaCV',$vaitro2)->first();
        $nhanvien3 = nhanvien::where('TenDangNhap',$tendangnhap)->where('MatKhau',$matkhau)->where('MaCV',$vaitro3)->first();
        if($nhanvien1){
            Session::put('admin',$request->tendangnhap);
            Session::put('vaitroadmin',$vaitro1);
            return redirect()->route('admin');
        }else if($nhanvien2){
            Session::put('thungan',$request->tendangnhap);
            Session::put('vaitrothungan',$vaitro2);
            $data = ban::orderBy('MaBan','ASC')->get();
            return redirect()->route('banhang.admin',compact('data'));
        }else if($nhanvien3){
            Session::put('phucvu',$request->tendangnhap);
            Session::put('vaitrophucvu',$vaitro3);
            $data = ban::orderBy('MaBan','ASC')->get();
            return redirect()->route('banhang.admin',compact('data'));
        }else{
            return redirect()->back()->with('alert-xoa','Sai tên đăng nhập hoặc mật khẩu!');
        }
    }

    public function DangXuatAdmin(){
        Session::put('admin',null);
        Session::put('vaitroadmin',null);
        //Session::flush();
        Auth::logout();
        return redirect()->route('showlogin');
    }
}
