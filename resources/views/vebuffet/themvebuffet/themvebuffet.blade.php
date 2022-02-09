@extends("./master")

@section('page_title')
    Admin - Thêm vé Buffet
@endsection

@section('main')
    <table id="dangnhap">
            <tr>
                <td id="tieude">
                    <div class="jumbotron text-center">
                        <h1>THÊM VÉ BUFFET</h1> 
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="{{ route('postThemVeBuffet') }}" method="post" onsubmit="return kiemtrathemvebuffet()"> @csrf
                        <table>
                            <tr>
                                <td><label for="tenvebuffet">Tên vé buffet</label></td>
                                <td><input type="text" name="tenvebuffet" value="{{ old('tenvebuffet') }}" id="tenvebuffet" placeholder="Nhập tên vé buffet"/></td>
                                <td><p id="tenvebuffetError"></p></td>
                            </tr>
                            <tr>
                                <td><label for="donvitinh">Đơn vị tính</label></td>
                                <td>
                                    <select name="donvitinh">
                                        @foreach($donvitinh as $dvt)
                                            @if($dvt->DVT == 'vé')
                                            <option value="{{$dvt->MaDVT}}" selected="selected">{{$dvt->DVT}}</option>
                                            @endif
                                            <option value="{{$dvt->MaDVT}}">{{$dvt->DVT}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            <td><label for="dongia">Đơn giá</label></td>
                                <td><input type="text" name="dongia" value="{{ old('dongia') }}" id="dongia" placeholder="Nhập giá vé"/></td>
                                <td>    
                                    @if (session('error'))
                                        <div>
                                            <p id="alert-xoa"><i class="fas fa-times"></i>{{ session('error') }}</p>
                                        </div>
                                    @endif
                                </td>
                                <td class="alert text-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </td>
                                <td><p id="dongiaError"></p></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Thêm" id="submit-them"></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
    </table>
@endsection