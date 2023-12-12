@extends('client.layout.master')
@section('content')
    <section class="section-sub-banner bg-16">
        <div class="awe-overlay"></div>
        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>{{ $detailRoom->number }}</h2>
                    <p>{{ $detailRoom->type->name }}</p>
                </div>
            </div>

        </div>

    </section>
    <!-- END / SUB BANNER -->

    <!-- ROOM DETAIL -->
    <section class="section-room-detail bg-white">
        <div class="container">

            <!-- DETAIL -->
            <div class="room-detail">
                <div class="row">
                    <div class="col-lg-9">

                        <!-- LAGER IMGAE -->
                        <div class="room-detail_img">
                            @foreach ($image as $item)
                                <div class="room_img-item">
                                    <img src="{{ asset('img/room/') . '/' . $detailRoom->number . '/' . $item->url }}"
                                        alt="">
                                </div>
                            @endforeach

                        </div>
                        <!-- END / LAGER IMGAE -->

                        <!-- THUMBNAIL IMAGE -->
                        <div class="room-detail_thumbs">
                            @foreach ($image as $item)
                                <a href="#"><img
                                        src="{{ asset('img/room/') . '/' . $detailRoom->number . '/' . $item->url }}"
                                        alt=""></a>
                            @endforeach
                        </div>
                        <!-- END / THUMBNAIL IMAGE -->
                        <h1>{{ $detailRoom->number }}</h1>
                        <p>{{ $detailRoom->view }}</p>


                    </div>

                    <div class="col-lg-3">

                        <!-- FORM BOOK -->
                        <div class="room-detail_book">

                            <div class="room-detail_total">
                                <img src="img/icon-logo.png" alt="" class="icon-logo">

                                <h6>Bắt đầu homestay từ</h6>

                                <p class="price">
                                    <span class="amout">{{ Helper::convertToRupiah($detailRoom->price) }}</span> /days
                                </p>
                            </div>

                            <div class="room-detail_form">
                                <?php
                                if(isset($_GET['checkin']) && isset($_GET['checkout']) && isset($_GET['person'])){
                                ?>
                                <label>Ngày đến</label>
                                <input type="text" class="awe-calendar from" disabled placeholder="Arrive Date"
                                    value="{{ Helper::dateFormat($_GET['checkin']) }}" name="checkin">
                                <label>Ngày đi</label>
                                <input type="text" class="awe-calendar to" disabled placeholder="Departure Date"
                                    value="{{ Helper::dateFormat($_GET['checkout']) }}" name="checkin">
                                <label>Số người: {{ $_GET['person'] }}</label>

                                <label>Địa chỉ: {{ $detailRoom->type->name }}</label>

                                @if (isset(Auth()->user()->id))
                                    <form
                                        action="{{ route('confirm', ['user' => Auth()->user()->id, 'room' => $detailRoom->id]) }}"
                                        method="POST">
                                    @else
                                        <form action="{{ route('confirm', ['user' => 0, 'room' => $detailRoom->id]) }}"
                                            method="POST">
                                @endif
                                @csrf
                                <input type="hidden" value="{{ $_GET['checkin'] }}" name="checkin">
                                <input type="hidden" value="{{ $_GET['checkout'] }}" name="checkout">
                                <input type="hidden"
                                    value="{{ Helper::getDateDifference($_GET['checkin'], $_GET['checkout']) }}"
                                    name="total_day">
                                <input type="hidden" value="{{ $_GET['person'] }}" name="person">
                                <button class="awe-btn awe-btn-13" type="submit">Đặt ngay</button>
                                </form>

                                <?php } else { ?>
                                @if (isset(Auth()->user()->id))
                                    <form
                                        action="{{ route('confirm', ['user' => Auth()->user()->id, 'room' => $detailRoom->id]) }}"
                                        method="GET">
                                    @else
                                        <form action="{{ route('confirm', ['user' => 0, 'room' => $detailRoom->id]) }}"
                                            method="GET">
                                @endif
                                @csrf
                                <label>Đến</label>
                                <input type="text" class="awe-calendar from" placeholder="Ngày đến" id="check_in"
                                    name="checkin" value="{{ old('checkin') }}" required>
                                <label>Khởi hành</label>

                                <input type="text" class="awe-calendar to" placeholder="Ngày đi" id="check_out"
                                    name="checkout" value="{{ old('checkout') }}" required>
                                <input type="hidden" value="0" name="total_day">
                                <label>Số người</label>
                                <input type="text" class="awe-input" placeholder="Số người" id="count_person"
                                    name="person" value="{{ old('person') }}" required>
                                <label>Địa chỉ: {{ $detailRoom->type->name }}</label>
                                <button class="awe-btn awe-btn-13" type="submit">Đặt ngay</button>
                                </form>
                                <?php }?>
                            </div>

                        </div>
                        <!-- END / FORM BOOK -->

                    </div>
                </div>
            </div>
            <!-- END / DETAIL -->

            <!-- TAB -->
            <div class="room-detail_tab">

                <div class="row">
                    <div class="col-md-3">
                        <ul class="room-detail_tab-header">
                            <li><a href="#overview" data-toggle="tab">Tổng Quan</a></li>
                            <li class="active"><a href="#amenities" data-toggle="tab">Tiện nghi</a></li>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="room-detail_tab-content tab-content">

                            <!-- OVERVIEW -->
                            <div class="tab-pane fade" id="overview">

                                <div class="room-detail_overview">
                                    {{-- <h5 class='text-uppercase
                                '>de Finibus Bonorum et
                                        Malorum", written by Cicero in 45 BC</h5> --}}
                                    <p>KingTheLand Homestay là một lựa chọn tuyệt vời cho khách du lịch khi đến Hà
                                        Nội, cung cấp không khí dành cho gia đình cùng với nhiều tiện nghi hữu ích cho kì
                                        nghỉ của bạn.
                                        KingTheLand Homestay trở thành lựa chọn lý tưởng khi khi đến Hà Nội.</p>

                                    <div class="row">
                                        <div class="col-xs-6 col-md-4">
                                            <h6>Thông tin Homestay</h6>
                                            <ul>
                                                <li> 2 người lớn & 1 trẻ em</li>
                                                <li>Diện tích : 35 m2 </li>
                                                <li>Cửa sổ, ban công</li>
                                                <li>Giường đôi</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                            <h6>Dịch vụ kèm theo</h6>
                                            <ul>
                                                <li>Bữa sáng</li>
                                                <li>Dọn Homestay hàng ngày</li>
                                                <li>Dịch vụ giặt là</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- END / OVERVIEW -->

                            <!-- AMENITIES -->
                            <div class="tab-pane fade active in" id="amenities">

                                <div class="room-detail_amenities">
                                    <p> Khách có thể dùng nhân viên hỗ trợ khách và dịch vụ Homestay khi nghỉ tại KingTheLand
                                        Homestay.</p>

                                    <div class="row">
                                        <div class="col-xs-6 col-lg-4">
                                            <h6>Phòng Khách</h6>
                                            <ul>
                                                <li>Bàn làm việc / ăn uống</li>
                                                <li>TV / máy chiếu</li>
                                                <li>Karaoke</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-6 col-lg-4">
                                            <h6>Phòng bếp</h6>
                                            <ul>
                                                <li>Dụng cụ nhà bếp</li>
                                                <li>Bàn ăn</li>
                                                <li>Thiết bị điện</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-6 col-lg-4">
                                            <h6>Ban công</h6>
                                            <ul>
                                                <li>Bàn ghế ngoài trời</li>
                                                <li>Sân hiên phơi nắng</li>
                                                <li>Nhìn ra thành phố</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-6 col-lg-4">
                                            <h6>Phòng ngủ</h6>
                                            <ul>
                                                <li>Giường đôi</li>
                                                <li>Tủ để quần áo</li>
                                                <li>Hệ thống cách âm</li>
                                                <li>Đồng hồ báo thức</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-6 col-lg-4">
                                            <h6>Phòng tắm</h6>
                                            <ul>
                                                <li>Phòng tắm riêng</li>
                                                <li>Áo choàng tắm</li>
                                                <li>Máy sấy tóc</li>
                                                <li>Khăn tắm</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-6 col-lg-4">
                                            <h6>Khác</h6>
                                            <ul>
                                                <li>Wi-fi có ở các khu vực công cộng</li>
                                                <li>Lễ tân 24 giờ</li>
                                                <li>Báo động an ninh</li>
                                                <li>Két an toàn</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- END / AMENITIES -->



                        </div>
                    </div>

                </div>

            </div>
            <!-- END / TAB -->
            <section class="section-blog bg-white">
                <div class="container">
                    <div class="blog">
                        <div class="row">

                            <div class="col-md-8 col-md-offset-2">
                                <div class="blog-content">
                                    <div id="comments">
                                        @foreach ($results as $r)
                                            <h4 class="comment-title">Đánh giá ({{ $r->comment_count }})</h4>
                                        @endforeach
                                        <ul class="commentlist">
                                            @foreach ($comment as $c)
                                                <li>
                                                    <div class="comment-body">

                                                        <a class="comment-avatar"><img
                                                                src="{{ asset('img/user/' . $c->name . '-' . $c->uid . '/' . $c->avatar) }}"
                                                                alt=""></a>

                                                        <h4 class="comment-subject">{{ $c->com_subject }}</h4>
                                                        <p>{{ $c->com_content }}.</p>

                                                        <span class="comment-meta">
                                                            <a href="#">{{ $c->name }}</a> -
                                                            {{ $c->created_at }}
                                                        </span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- COMPARE ACCOMMODATION -->
            <div class="room-detail_compare">
                <h2 class="room-compare_title">Địa điểm khác</h2>
                <div class="room-compare_content">
                    <div class="row">
                        @foreach ($other_locations as $other_location)
                            <!-- ITEM -->
                            <div class="col-md-4 col-sm-6">
                                <div class="room-compare_item">
                                    <div class="img">
                                        <a href="{{ route('homestayDetail', $other_location->id) }}"><img
                                                src="{{ $other_location->firstImage() }}" alt=""></a>
                                    </div>
                                    <div class="text">
                                        <h2><a href="#">{{ $other_location->number }}</a></h2>
                                        <ul>
                                            <li><i class="lotus-icon-location"></i> {{ $other_location->location }}</li>
                                        </ul>
                                        <a href="{{ route('homestayDetail', $other_location->id) }}"
                                            class="awe-btn awe-btn-default">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- END / COMPARE ACCOMMODATION -->
        </div>
    </section>
@endsection
