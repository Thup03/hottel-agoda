<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{asset('royal/image/favicon.png')}}" type="image/png">
        <title>Khách sạn Gia Huy</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('royal/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('royal/vendors/linericon/style.css')}}">
        <link rel="stylesheet" href="{{asset('royal/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('royal/vendors/owl-carousel/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('royal/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('royal/vendors/nice-select/css/nice-select.css')}}">
        <link rel="stylesheet" href="{{asset('royal/vendors/owl-carousel/owl.carousel.min.css')}}">
        <!-- main css -->
        <link rel="stylesheet" href="{{asset('royal/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('royal/css/responsive.css')}}">

        <link rel="stylesheet" href="{{asset('royal/css/loginRegister.css')}}">
    </head>
    <body>
        <!--================Header Area =================-->
        <header class="header_area navbar_fixed">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="/"><img src="{{asset('royal/image/Logo.png')}}" alt="" width="200"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li> 
                            <!-- <li class="nav-item"><a class="nav-link" href="about.html">About us</a></li>
                            <li class="nav-item"><a class="nav-link" href="accomodation.html">Accomodation</a></li>
                            <li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li> -->
                            <!-- <li class="nav-item"><a class="nav-link" href="elements.html">Elemests</a></li> -->
                            <!-- <li class="nav-item"><a class="nav-link" href="contact.html">Liên hệ</a></li> -->
                            @if(Auth::check())
                            <li class="nav-item submenu dropdown active">
                                <a href="#" class="nav-link dropdown-toggle" class="fa fa-user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-star"></i> {{Auth::user()->name}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Đăng xuất</a></li>
                                </ul>
                            </li> 
                            @else
                            <li class="nav-item"><a class="nav-link" onclick="handleShowModalLogin()" >Đăng nhập</a></li>
                            @endif
                        </ul>
                    </div> 
                </nav>
            </div>
        </header>
        <!--================Header Area =================-->
        
        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="booking_table d_flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<!-- <div class="container">
					<div class="banner_content text-center">
						<h6>Away from monotonous life</h6>
						<h2>Relax Your Mind</h2>
						<p>If you are looking at blank cassettes on the web, you may be very confused at the<br> difference in price. You may see some for as low as $.17 each.</p>
						<a class="btn theme_btn button_hover btn-book-room" data-id="1">Get Started</a>
					</div>
				</div> -->
            </div>
            <div class="hotel_booking_area position">
                <div class="container">
                    <div class="hotel_booking_table">
                        <div class="col-md-3">
                            <h2>Mẫu đăng kí</h2>
                        </div>
                        <div class="col-md-9">
                            <div class="boking_table">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker11'>
                                                    <input type='text' class="form-control" placeholder="Nhận phòng" disabled/>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" placeholder="Trả phòng" disabled/>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="input-group">
                                                <select class="wide">
                                                    <option data-display="Loại giường">Chọn loại giường</option>
                                                    <option value="1">Giường đơn</option>
                                                    <option value="2">Giường đôi</option>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <select class="wide">
                                                    <option data-display="Số lượng giường">Chọn số lượng giường</option>
                                                    <option value="1">1 giường</option>
                                                    <option value="2">2 giường</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="input-group">
                                                <select class="wide">
                                                    <option data-display="Loại phòng">Chọn loại phòng</option>
                                                    <option value="1">Manual</option>
                                                    <option value="2">Master</option>
                                                </select>
                                            </div>
                                            <button class="book_now_btn button_hover" href="#" id="select-room">Đặt phòng ngay</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Banner Area =================-->
        
        <!--================ Accomodation Area  =================-->
        <section class="accomodation_area section_gap">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color" id="select-room-hotel">Chỗ ở khách sạn</h2>
                </div>
                <div class="row mb_30">
                    @if (isset($rooms) && !empty($rooms))
                        @foreach ($rooms as $room)
                            <div class="col-lg-3 col-sm-6">
                                <div class="accomodation_item text-center">
                                    <div class="hotel_img">
                                        <img src="{{asset('/images/'.$room->thumbnail)}}" alt="{{$room->title}}">
                                        <a class="btn theme_btn button_hover btn-check-book-room" data-id="{{$room->id}}">Đặt phòng</a>
                                    </div>
                                    <a href="#"><h4 class="sec_h4">{{ $room->title }}</h4></a>
                                    <h5>{{number_format($room->price ,0 ,'.' ,'.')}} VND<small>/đêm</small></h5>
                                </div>
                                <div class="accomodation_item text-center">
                                    <a class="genric-btn info radius btn-show-room btn-view-room-information" data-id="{{$room->id}}">Xem thông tin</a>
                                    <style>
                                        .btn-view-room-information:hover{
                                            color: #38a4ff !important;
                                        }
                                    </style>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <!-- room information  -->
        <section>
            <div class="col-xs-12">
                <div class="modal fade" id="showRoom" tabindex="-1" role="dialog" aria-labelledby="formRoom"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="border-radius: 0px !important;">
                            @csrf
                            <div class="box box-widget">
                                <div class="box-header with-border">
                                    <div class="box-tools">
                                        <a class="genric-btn danger button_hover" data-dismiss="modal">Đóng</a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <!-- <img class="attachment-img" src="{{asset('')}}admin/dist/img/photo1.png" alt="Attachment Image"> -->
                                    <div class="attachment-pushed">
                                        <div class="attachment-text" style="box-sizing: border-box; color: black; padding: 20px 20px;">
                                            <p id="showRoomTitle" style="font-weight: 600; font-size: 26px; text-transform: capitalize;"></p>
                                            <div style="text-align: center; margin-top: 30px;">
                                                <img src="" name="thumbnail" id="showThumbnail" alt="" style="width: 100%;">
                                                <br>
                                            </div>
                                            <p style="font-weight: 600; font-size: 20px; text-transform: capitalize; margin-top: 30px;">
                                                Mô tả chung:
                                            </p>
                                            <p id="showRoomDescription">
                                            </p>
                                            <p style="font-weight: 600; font-size: 20px; text-transform: capitalize; margin-top: 30px;">
                                                Thông tin chi tiết:
                                            </p>
                                            <p id="showRoomContent">
                                            </p>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- form booking room -->
        <section>
            <div class="col-xs-12">
                <div class="modal fade" id="showFormBooking" tabindex="-1" role="dialog" aria-labelledby="formBookingRoom"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="border-radius: 0px !important; height: 350px; background: #e9ecef;">
                            @csrf
                            <div class="box box-widget">
                                <div class="box-header with-border">
                                    <div class="box-tools">
                                        <a class="genric-btn danger button_hover" data-dismiss="modal">Đóng</a>
                                    </div>
                                </div>
                                <div class="box-body" style="padding-top: 30px;">
                                    <div class="hotel_booking_area position">
                                        <div class="container">
                                            <div class="hotel_booking_table">
                                                <div class="col-md-12">
                                                    <div class="boking_table">
                                                        <div class="row" style="margin-right: -45px !important; margin-left: 0px !important;">
                                                            <div class="col-md-4">
                                                                <div class="book_tabel_item">
                                                                    <div class="form-group">
                                                                        <div class='input-group date' id='datetimepicker11'>
                                                                            <input id="getCheckIn" type='text' class="form-control" placeholder="Nhận phòng"/>
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class='input-group date' id='datetimepicker1'>
                                                                            <input id="getCheckOut" type='text' class="form-control" placeholder="Trả phòng"/>
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="book_tabel_item">
                                                                    <div class="input-group" id="input-bed-type">
                                                                        <select class="wide">
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group" id="input-no-bed">
                                                                        <select class="wide">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="book_tabel_item">
                                                                    <div class="input-group" id="input-category">
                                                                        <select class="wide">
                                                                        </select>
                                                                    </div>
                                                                    <button class="book_now_btn button_hover btn-book-room" href="#">Đặt phòng</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--================ Facilities Area  =================-->
        <section class="facilities_area section_gap">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">  
            </div>
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_w">Cơ sở vật chất</h2>
                    <p>Bao gồm rất nhiều các tiện ích và dịch vụ đẳng cấp hàng đầu thế giới</p>
                </div>
                <div class="row mb_30">
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-dinner"></i>Nhà hàng</h4>
                            <p>Du khách có thể thuê xe hơi hoặc xe máy để khám phá khu vực, sử dụng trung tâm dịch vụ doanh nhân hoặc đọc báo trong khuôn viên.</p>                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-bicycle"></i>Câu lạc bộ thể thao</h4>
                            <p>Du khách có thể thuê xe hơi hoặc xe máy để khám phá khu vực, sử dụng trung tâm dịch vụ doanh nhân hoặc đọc báo trong khuôn viên.</p>                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-shirt"></i>Bể bơi</h4>
                            <p>Du khách có thể thuê xe hơi hoặc xe máy để khám phá khu vực, sử dụng trung tâm dịch vụ doanh nhân hoặc đọc báo trong khuôn viên.</p>                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-car"></i>Thuê xe ô tô</h4>
                            <p>Du khách có thể thuê xe hơi hoặc xe máy để khám phá khu vực, sử dụng trung tâm dịch vụ doanh nhân hoặc đọc báo trong khuôn viên.</p>                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-construction"></i>Gym</h4>
                            <p>Du khách có thể thuê xe hơi hoặc xe máy để khám phá khu vực, sử dụng trung tâm dịch vụ doanh nhân hoặc đọc báo trong khuôn viên.</p>                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-coffee-cup"></i>Bar</h4>
                            <p>Du khách có thể thuê xe hơi hoặc xe máy để khám phá khu vực, sử dụng trung tâm dịch vụ doanh nhân hoặc đọc báo trong khuôn viên.</p>                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Facilities Area  =================-->
        
        <!--================ About History Area  =================-->
        <section class="about_history_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d_flex align-items-center">
                        <div class="about_content ">
                            <h2 class="title title_color">Lịch sử phát triển<br>& Tầm nhìn</h2>
                            <p>Khách sạn Gia Huy đặt mục tiêu chiếm lĩnh 70% thị phần khách du lịch đến năm 2030. Bời vì chúng tôi có vị trí đắc địa ở ngay trung tâm thành phố, dễ dàng di chuyển đến các địa điểm ăn uống và tham quan nên thường được khách nghỉ dưỡng và khách công tác lựa chọn khi đến Thủ Đức.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid" src="{{asset('royal/image/about_bg.jpg')}}" alt="img">
                    </div>
                </div>
            </div>
        </section>
        <!--================ About History Area  =================-->
        
        <!--================ start footer Area  =================-->	
        <footer class="footer-area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">Giới thiệu</h6>
                            <p class="text-justify">Tọa lạc tại thành phố Thủ Đức, "Khách sạn Gia Huy" có 2 nhà hàng trong khuôn viên, 3 quán bar, hồ bơi ngoài trời, trung tâm thể dục và quán bar. Khách sạn 5 sao này cũng có sảnh khách chung và dịch vụ concierge. Chỗ nghỉ cung cấp dịch vụ lễ tân 24 giờ, dịch vụ phòng và dịch vụ thu đổi ngoại tệ cho khách.</p>		
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">Nhận thông tin</h6>
                            <div id="mc_embed_signup">
                                <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative">
                                    <div class="input-group d-flex flex-row">
                                        <input name="EMAIL" placeholder="Địa chỉ email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Địa chỉ email '" required="" type="email">
                                        <button class="btn sub-btn"><span class="lnr lnr-location"></span></button>		
                                    </div>									
                                    <div class="mt-10 info"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">Liên kết hữu ích</h6>
                            <div class="row">
                                <div class="col-12">
                                    <ul class="list_style">
                                        <li><a href="#">Trang chủ</a></li>
                                        <li><a href="#">Bài viết</a></li>
                                        <li><a href="#">Liên hệ</a></li>
                                    </ul>
                                </div>									
                            </div>							
                        </div>
                    </div>							
                </div>
                <div class="border_line"></div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-8 col-sm-12 footer-text m-0">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                    </p>
                    <div class="col-lg-4 col-sm-12 footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </footer>
		<!--================ End footer Area  =================-->
        
        @include('/templates/_modalLogin')
        @include('/templates/_modalForgotPassword')
        @include('/templates/_modalRegister')
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('royal/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('royal/js/popper.js')}}"></script>
        <script src="{{asset('royal/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('royal/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('royal/js/jquery.ajaxchimp.min.js')}}"></script>
        <script src="{{asset('royal/js/mail-script.js')}}"></script>
        <script src="{{asset('royal/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js')}}"></script>
        <script src="{{asset('royal/vendors/nice-select/js/jquery.nice-select.js')}}"></script>
        <script src="{{asset('royal/js/mail-script.js')}}"></script>
        <script src="{{asset('royal/js/stellar.js')}}"></script>
        <script src="{{asset('royal/vendors/lightbox/simpleLightbox.min.js')}}"></script>
        <script src="{{asset('royal/js/custom.js')}}"></script>

        <script src="{{asset('royal/js/sweetalert.min.js')}}"></script>

        <script>
            function handleShowModalLogin(){
                setTimeout(function () {
                    $('#loginModal').modal('show');
                }, 300);
            }

            // function openForgotPassword() {
            //     $('#loginModal').modal('hide')
            //     // $('#forgotPasswordModal').modal('show')
            //     setTimeout(function () {
            //         $('#forgotPasswordModal').modal('show')
            //     }, 300)
            // }

            function closeModalRegister() {
                $('#registerModal').modal('hide');
            }

            function openModalRegister() {
                $('#loginModal').modal('hide')
                $('#forgotPasswordModal').modal('hide')
                // $('#registerModal').modal('show')
                setTimeout(function () {
                    $('#registerModal').modal('show')
                }, 300)
            }

            function hideShowPwd(idElm, idElmWrapper) {
                let x = document.getElementById(idElm);
                if (x.type === "password") {
                    x.type = "text";
                    $(`#${idElmWrapper} .pw-hidden`).addClass('hide')
                    $(`#${idElmWrapper} .pw-show`).removeClass('hide')
                } else {
                    x.type = "password";
                    $(`#${idElmWrapper} .pw-hidden`).removeClass('hide')
                    $(`#${idElmWrapper} .pw-show`).addClass('hide')
                }
            }

            function generateFeedbackMessage(text) {
                return `<p>${text}</p>`;
            }

            function login() {
                const phone = $('#phone-number').val().trim();
                const password = $('#loginPassword').val().trim();

                console.log("phone and password", phone, password)

                $(".input-phone-feedback, .input-password-feedback, .input-feedback").empty();

                let isAllowSubmit = true;
                if (!phone) {
                    isAllowSubmit = isAllowSubmit && false;
                    $(".input-phone-feedback").append(generateFeedbackMessage('Thông tin này là bắt buộc. Vui lòng nhập đầy đủ.'));
                }
                else {
                    if (!validatePhone(phone)) {
                        isAllowSubmit = isAllowSubmit && false;
                        $(".input-phone-feedback").append(generateFeedbackMessage('Số điện thoại không hợp lệ, vui lòng thử lại.'));
                    }
                }

                if (!password) {
                    isAllowSubmit = isAllowSubmit && false;
                    $(".input-password-feedback").append(generateFeedbackMessage('Thông tin này là bắt buộc. Vui lòng nhập đầy đủ.'));
                }

                if (isAllowSubmit) {
                    let form_data = new FormData();
                    form_data.append("_token", '{{ csrf_token() }}');
                    form_data.append("phone", phone);
                    form_data.append("password", password);
                    form_data.append("remember", $('#remember').is(":checked"));

                    $.ajax({
                        type: 'POST',
                        url: '/login',
                        data: form_data,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.success) {
                                setTimeout(function () {
                                    window.location.href = "/";
                                }, 200);
                            } else {
                                $(".input-feedback").append(generateFeedbackMessage(response.message));
                            }
                        }
                    });
                }
            }

            function validatePhone(phone) {
                const mobile = new RegExp(/^(0|\+84)((3[2-9])|(4[0-9])|(5[2689])|(7[06-9])|(8[1-9])|(9[0-46-9]))(\d)(\d{3})(\d{3})$/);
                return mobile.test(phone);
            }

            function clearAlert() {
                $(".r-input-username-feedback, .r-input-phone-feedback, .r-input-otp-feedback, .r-input-email-feedback, .r-input-password-feedback, .r-input-address-feedback, .r-input-company-feedback, .r-input-representative-name-feedback, .r-input-tax-feedback, .r-input-clinic-name-feedback, .r-input-special-doctor-name-feedback, .r-input-name-of-pharmacy-feedback, .r-input-pharmacist-in-charge-feedback, .r-input-business-license-feedback, .r-input-certificate-of-eligibility-feedback, .r-input-license-to-operate-retail-feedback, .r-input-certificate-of-practice-feedback, .r-input-license-to-operate-feedback, .register-feedback").empty();
            }

            function openModalLogin() {
                $('#forgotPasswordModal').modal('hide')
                $('#registerModal').modal('hide')
                setTimeout(function () {
                    $('#loginModal').modal('show')
                }, 300)
            }

            function register() {
                const name = $('#userName').val().trim();
                const phone = $('#phoneNumber').val().trim();
                const password = $('#passwordRegister').val().trim();
                const address = $('#address').val().trim();
            
                // clear alert
                clearAlert();

                let isAllowSubmit = true;
                if (!name) {
                    isAllowSubmit = isAllowSubmit && false;
                    $(".r-input-username-feedback").append(generateFeedbackMessage('Vui lòng nhập tên của bạn.'));
                }

                if (!phone) {
                    isAllowSubmit = isAllowSubmit && false;
                    $(".r-input-phone-feedback").append(generateFeedbackMessage('Vui lòng nhập số điện thoại của bạn.'));
                }
                else {
                    if (!validatePhone(phone)) {
                        isAllowSubmit = isAllowSubmit && false;
                        $(".r-input-phone-feedback").append(generateFeedbackMessage('Số điện thoại không hợp lệ, vui lòng thử lại.'));
                    }
                }

                if (!password) {
                    isAllowSubmit = isAllowSubmit && false;
                    $(".r-input-password-feedback").append(generateFeedbackMessage('Vui lòng nhập mật khẩu của bạn.'));
                }

                if (!address) {
                    isAllowSubmit = isAllowSubmit && false;
                    $(".r-input-address-feedback").append(generateFeedbackMessage('Vui lòng nhập địa chỉ của bạn.'));
                }

                if (isAllowSubmit) {
                    let form_data = new FormData();
                    form_data.append("_token", '{{ csrf_token() }}');
                    form_data.append("name", name);
                    form_data.append("phone", phone);
                    form_data.append("password", password);
                    form_data.append("address", address);
                    $.ajax({
                        type: 'POST',
                        url: '/register',
                        data: form_data,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                closeModalRegister();
                                swal({
                                    title: "Đăng kí hoàn tất",
                                    text: "Tài khoản của bạn đã được đăng kí thành công",
                                    icon: "success",
                                    buttons: {
                                        cancel: "Đóng",
                                        accept: "Đăng nhập ngay!",
                                    },
                                })
                                    .then((value) => {
                                        switch (value) {
                                            case "accept":
                                                openModalLogin();
                                                break;
                                            default:
                                                window.location.reload();
                                        }
                                    });

                            } else {
                                $(".register-feedback").append(generateFeedbackMessage(data.message || 'Số điện thoại hoặc mật khẩu không chính xác, vui lòng thử lại'));
                            }
                        }
                    });
                }
            }
            
            $("#select-room").click(function() {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#select-room-hotel").offset().top
                }, 500);
            });

            // show room information
            $('.btn-show-room').click(function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "get",
                    url: "/room/" + id + "/information",
                    data: {
                        _token: $('[name="_token"]').val(),
                    },
                    success: function(response) {
                        $('#showRoomTitle').html(response.title),
                        $('#showRoomDescription').html(response.description);
                        $('#showRoomContent').html(response.content);
                        $('#showThumbnail').attr('src', '/images/'+response.thumbnail);
                    }
                });

                $('#showRoom').modal('show');
                $("body").removeAttr("class");
                $("body").removeAttr("style");
                $(".modal-dialog").css("max-width", "100%");
                $(".modal-dialog").css("justify-content", "center");
            });

            $('.btn-check-book-room').click(function(){
                const roomId = $(this).attr('data-id');
                $.ajax({
                    type : 'post',
                    url : '/booking/check/' + roomId,
                    data : {
                        _token :$('[name="_token"]').val(),
                    },
                    success : function(response){
                        const categories = response.categories || [];
                        const mapping = {};
                        for(let type of categories){
                            mapping[type.id] = type.name;
                        }
                        if(response.success){
                            $('#showFormBooking').modal('show');
                            $("body").removeAttr("class");
                            $("body").removeAttr("style");
                            $(".modal-dialog").css("max-width", "100%");
                            $(".modal-dialog").css("justify-content", "center");
                            $('.btn-book-room').attr('data-id', roomId);
                            try {
                                // lib public/royal/vendors/nice-select/js/jquery.nice-select.js
                                $('#input-bed-type').find('.current').html(response.room.bed_type);
                                $('#input-no-bed').find('.current').html(response.room.no_bed);
                                $('#input-category').find('.current').html(mapping[response.room.category_id]);
                            } catch (error) {
                                console.log(error);
                            }
                        }
                        else{
                            if(response.code == 'NOT_LOGIN'){
                                swal({
                                    title: "Bạn chưa đăng nhập",
                                    text: "Hãy đăng nhập để có thể đặt phòng bạn nhé.",
                                    icon: "warning",
                                    buttons: {
                                        cancel: "Đóng",
                                        accept: "Đăng nhập",
                                    },
                                }).then((value) => {
                                        switch (value) {
                                            case "accept":
                                                console.log('accept-clearInterval');
                                                openModalLogin();
                                                break;
                                        }
                                });
                            }
                        }
                    }
                });
            });

            function alertInformation(data){
                const {text, title, icon, time} = data;
                swal({
                    title,
                    text,
                    icon,
                    buttons: true,
                    dangerMode: true,
                    buttons: ["Ok"],
                    timer: time || 2000
                })
            }

            // book room
            $('.btn-book-room').click(function(){
                const id = $(this).attr('data-id');
                const checkIn = $('#getCheckIn').val().trim();
                const checkOut = $('#getCheckOut').val().trim();
                if(!checkIn){
                    alertInformation({
                        text: "Bạn cần chọn thời gian nhận phòng",
                        icon: "error",
                    });
                    return;
                }
                if(!checkOut){
                    alertInformation({
                        text: "Bạn cần chọn thời gian trả phòng",
                        icon: "error",
                    });
                    return;
                }

                try {
                    if(Date.parse(`${checkIn}:00`) < Date.parse(new Date())){
                        alertInformation({
                            text: "Thời điểm nhận phòng không hợp lệ",
                            icon: "error",
                        });
                        return;
                    }
                    if(Date.parse(`${checkIn}:00`) >= Date.parse(`${checkOut}:00`)){
                        alertInformation({
                            text: "Thời điểm trả phòng không hợp lệ",
                            icon: "error",
                        });
                        return;
                    }
                } catch (error) {
                    alertInformation({
                        text: "Định dạng thời gian không hợp lệ",
                        icon: "error",
                    });
                    return;
                }

                $.ajax({
                    type : 'post',
                    url : '/booking',
                    data : {
                        _token :$('[name="_token"]').val(),
                        room_id : id,
                        check_in_at : checkIn,
                        check_out_at : checkOut,
                        check_in : `${checkIn}:00`,
                        check_out : `${checkOut}:00`,
                    },
                    success : function(response){
                        console.log("============>", response)
                        if(response.success){
                            alertInformation({
                                text: "Đặt phòng thành công",
                                icon: "success",
                                time: 4000
                            });
                            $('#showFormBooking').modal('hide');
                        }
                        else{
                            alertInformation({
                                title: response.title,
                                text: response.text || "Không đặt được phòng",
                                icon: "error",
                                time: 4000
                            });
                        }
                    }
                });
            });
        </script>
    </body>
</html>