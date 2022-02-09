@extends("./master")

@section('page_title')
    Admin - Sửa vé Buffet
@endsection

@section('main')
    <table id="dangnhap">
            <tr>
                <td id="tieude">
                    <div class="jumbotron text-center">
                        <h1>SỬA VÉ BUFFET</h1> 
                    </div>
                </td>
            </tr>
            <tr>
                <td>@foreach($data as $ve)
                    <form action="{{route('postSuaVeBuffet',['MaVe' => $ve['MaVe']]) }}" method="post" onsubmit="return kiemtrathemvebuffet()"> @csrf
                        <table>
                            <tr>
                                <td><label for="tenvebuffet">Tên vé buffet</label></td>
                                <td><input type="text" name="tenvebuffet" id="tenvebuffet" placeholder="Nhập tên vé buffet" value="{{$ve->TenVe}}"/></td>
                                <td><p id="tenvebuffetError"></p></td>
                            </tr>
                            <tr>
                                <td><label for="donvitinh">Đơn vị tính</label></td>
                                <td>
                                    <select name="donvitinh">
                                        @foreach($donvitinh as $dvt)
                                            @if($ve->MaDVT == $dvt->MaDVT)
                                            <option value="{{$dvt->MaDVT}}" selected="selected" style="display:none">{{$dvt->DVT}}</option>
                                            @endif
                                            <option value="{{$dvt->MaDVT}}">{{$dvt->DVT}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            <td><label for="dongia">Đơn giá</label></td>
                                <td><input type="text" name="dongia" id="dongia" placeholder="Nhập giá vé" value="{{$ve->GiaVe}}"/></td>
                                <td><p id="dongiaError"></p></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Thêm" id="submit-them"></td>
                            </tr>
                        </table>
                    </form>@endforeach
                </td>
            </tr>
    </table>
@endsection