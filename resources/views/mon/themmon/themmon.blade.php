@extends("./master")

@section('page_title')
    Admin - Thêm món ăn
@endsection

@section('main')
    <table id="dangnhap">
            <tr>
                <td id="tieude">THÊM MÓN ĂN</td>
            </tr>
            <tr>
                <td>
                    <form action="{{route('postThemMon')}}" method="post" onsubmit="return kiemtrathemmon()"> @csrf
                        <table>
                            <tr>
                                <td><label for="tenmon">Tên món ăn</label></td>
                                <td><input type="text" name="tenmon" id="tenmon" placeholder="Nhập tên món ăn"/></td>
                                <td><p id="tenmonError"></p></td>
                            </tr>
                            <tr>
                                <td><label for="nhommon">Thuộc nhóm món</label></td>
                                <td>
                                    <select name="nhommon">
                                        @foreach($nhommon as $nm)
                                            <option value="{{$nm->MaNM}}">{{$nm->TenNM}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="donvitinh">Đơn vị tính</label></td>
                                <td>
                                    <select name="donvitinh">
                                        @foreach($donvitinh as $dvt)
                                            <option value="{{$dvt->MaDVT}}">{{$dvt->DVT}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            <td><label for="gianhap">Đơn giá</label></td>
                                <td><input type="text" name="gianhap" value="{{ old('gianhap') }}" id="gianhap" placeholder="Nhập giá nhập"/></td>
                                <td>    
                                    @if (session('error-dg'))
                                        <div>
                                            <p id="alert-xoa"><i class="fas fa-times"></i>{{ session('error-dg') }}</p>
                                        </div>
                                    @endif
                                </td>
                                <td><p id="gianhapError"></p></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Thêm" id="submit-them"></td>
                            </tr>
                        </table>
                    </form>
                    <ul class="alert text-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
    </table>
@endsection