@extends("./master")

@section('page_title')
    Admin - Vé Buffet
@endsection

@section('main')
    <div class="jumbotron text-center" id="tieude">
        <h1>THÔNG TIN VÉ BUFFET</h1>
    </div>
    @if (session('alert'))
        <div>
            <p id="alert-them-sua"><i class="fas fa-check"></i>{{ session('alert') }}</p>
        </div>
    @endif
    @if (session('alert-xoa'))
        <div>
            <p id="alert-xoa"><i class="fas fa-times"></i>{{ session('alert-xoa') }}</p>
        </div>
    @endif
    <a class="btn btn-primary m-1" href="{{ route('vebuffet.themvebuffet.themvebuffet') }}" role="button" id="btn-themnhanvien">Thêm vé Buffet</a>
    <a class="btn btn-primary m-1" href="{{ route('sanpham.donvitinh.admin') }}" role="button" id="btn-themnhanvien">Đơn vị tính</a>
    <div id="table-dsnv">
        @if(!empty($data))
            <table class="table table-bordered">
                    <tr>
                        <th>Tên vé</th>
                        <th>Đơn vị tính</th>
                        <th>Đơn giá</th>
                        <th style="width: 90px">Thao tác</th>
                    </tr>
                <tbody>
                @foreach($data as $bien)
                    <tr>
                        <td>{{ $bien->TenVe }}</td>
                        <td><?php echo App\Models\donvitinh::where('MaDVT',$bien['MaDVT'])->value('DVT') ?></td>
                        <td><?php echo number_format($bien['GiaVe']) ?> VNĐ</td>
                        <td id="thaotac">
                            <a href="{{ route('vebuffet.suavebuffet.suavebuffet',['MaVe' => $bien['MaVe']]) }}"><i class="fas fa-wrench" style="color: #3b95ef"></i></a>
                            <a href="{{ route('vebuffet.xoavebuffet',['MaVe' => $bien['MaVe']]) }}"><i class="fas fa-user-minus" style="color: #ff0000"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection