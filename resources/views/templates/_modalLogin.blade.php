<div class="modal fade modal-customer" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="">
                <div class="mb-wrapper-content modal-wrapper-content">
                    <div class="modal-login-left modal-left-item">
                        <img src="{{asset('royal/image/about_bg.jpg')}}" height="500">
                    </div>
                    <div class="modal-login-right modal-right-item">
                        <div class="mlr-top modal-right-item-top">
                            <div class="modal-close-i" data-dismiss="modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5"
                                    stroke="#8E9AAB">
                                    <path d="M17.9964 6L6.00391 17.9925" stroke="inherit" stroke-width="inherit"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M18.0125 18.0125L6 6" stroke="inherit" stroke-width="inherit"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <h2 class="mrl-top-header modal-top-header">
                                <span class="text-register" onclick="openModalRegister()">Đăng kí ngay</span>
                            </h2>
                        </div>
                        <div class="content-modal-right">
                            <div class="form-title">
                                <h1 class="main-title">Đăng nhập tài khoản</h1>
                            </div>
                            <div class="input-feedback"></div>
                            <form class="form-login modal-right-form">
                                @csrf
                                <div class="form-group">
                                    <label for="phone-number" class="col-form-label">Số điện thoại</label>
                                    <input type="number" class="form-control" id="phone-number" placeholder="Số điện thoại">
                                </div>
                                <div class="input-phone-feedback"></div>
                                <div class="form-group input-password">
                                    <label for="password" class="col-form-label">Mật khẩu</label>
                                    <div id="modalLoginWrapper">
                                        <input type="password" class="form-control" id="loginPassword" placeholder="Nhập mật khẩu">
                                        <span onclick="hideShowPwd('loginPassword', 'modalLoginWrapper')" class="pw-show hide">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.9996 9.64136C10.6696 9.64136 9.58862 10.7234 9.58862 12.0534C9.58862 13.3824 10.6696 14.4634 11.9996 14.4634C13.3296 14.4634 14.4116 13.3824 14.4116 12.0534C14.4116 10.7234 13.3296 9.64136 11.9996 9.64136ZM11.9996 15.9634C9.84262 15.9634 8.08862 14.2094 8.08862 12.0534C8.08862 9.89636 9.84262 8.14136 11.9996 8.14136C14.1566 8.14136 15.9116 9.89636 15.9116 12.0534C15.9116 14.2094 14.1566 15.9634 11.9996 15.9634Z"
                                                    fill="#666666" />
                                                <mask id="mask0_29_638" style="mask-type:alpha"
                                                    maskUnits="userSpaceOnUse" x="2" y="4" width="20" height="17">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.00024 4.00024H22.0001V20.1052H2.00024V4.00024Z"
                                                        fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_29_638)">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.56999 12.0525C5.42999 16.1615 8.56299 18.6045 12 18.6055C15.437 18.6045 18.57 16.1615 20.43 12.0525C18.57 7.94451 15.437 5.50151 12 5.50051C8.56399 5.50151 5.42999 7.94451 3.56999 12.0525ZM12.002 20.1055H11.998H11.997C7.86099 20.1025 4.14699 17.2035 2.06099 12.3485C1.97999 12.1595 1.97999 11.9455 2.06099 11.7565C4.14699 6.90251 7.86199 4.00351 11.997 4.00051C11.999 3.99951 11.999 3.99951 12 4.00051C12.002 3.99951 12.002 3.99951 12.003 4.00051C16.139 4.00351 19.853 6.90251 21.939 11.7565C22.021 11.9455 22.021 12.1595 21.939 12.3485C19.854 17.2035 16.139 20.1025 12.003 20.1055H12.002Z"
                                                        fill="#666666" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span onclick="hideShowPwd('loginPassword', 'modalLoginWrapper')" class="pw-hidden">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M9.76094 15.6172C9.56894 15.6172 9.37694 15.5442 9.23094 15.3972C8.49294 14.6602 8.08594 13.6802 8.08594 12.6382C8.08594 10.4782 9.84194 8.72119 11.9999 8.72119C13.0379 8.72119 14.0459 9.14019 14.7649 9.87119C15.0549 10.1672 15.0519 10.6412 14.7559 10.9312C14.4609 11.2232 13.9869 11.2182 13.6959 10.9242C13.2569 10.4772 12.6389 10.2212 11.9999 10.2212C10.6689 10.2212 9.58594 11.3052 9.58594 12.6382C9.58594 13.2792 9.83694 13.8832 10.2909 14.3372C10.5839 14.6302 10.5839 15.1042 10.2919 15.3972C10.1449 15.5442 9.95294 15.6172 9.76094 15.6172"
                                                  fill="#999999" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M12.5676 16.4912C12.2126 16.4912 11.8966 16.2372 11.8306 15.8752C11.7566 15.4682 12.0266 15.0772 12.4346 15.0032C13.4146 14.8252 14.1906 14.0472 14.3666 13.0662C14.4406 12.6592 14.8306 12.3912 15.2376 12.4612C15.6456 12.5342 15.9166 12.9242 15.8436 13.3322C15.5566 14.9252 14.2946 16.1892 12.7026 16.4792C12.6576 16.4872 12.6116 16.4912 12.5676 16.4912"
                                                  fill="#999999" />
                                            <mask id="mask0_463_5220" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                                  x="2" y="4" width="17" height="15">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M2 4.62439H18.0862V18.7225H2V4.62439Z" fill="white" />
                                            </mask>
                                            <g mask="url(#mask0_463_5220)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M6.6545 18.7225C6.4925 18.7225 6.3295 18.6695 6.1915 18.5625C4.5005 17.2345 3.0715 15.2875 2.0615 12.9335C1.9795 12.7435 1.9795 12.5295 2.0615 12.3405C3.0825 9.97652 4.5205 8.01952 6.2205 6.68252C9.6865 3.93952 14.3005 3.93052 17.8015 6.70252C18.1265 6.95952 18.1815 7.43152 17.9245 7.75652C17.6665 8.07952 17.1965 8.13652 16.8705 7.87852C13.9045 5.53052 10.0835 5.53852 7.1495 7.86052C5.7135 8.99052 4.4805 10.6365 3.5705 12.6385C4.4715 14.6285 5.6935 16.2645 7.1185 17.3825C7.4445 17.6385 7.5005 18.1105 7.2445 18.4355C7.0965 18.6235 6.8765 18.7225 6.6545 18.7225"
                                                      fill="#999999" />
                                            </g>
                                            <mask id="mask1_463_5220" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                                  x="8" y="8" width="14" height="13">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M8.71777 8.74121H22.0003V20.6894H8.71777V8.74121Z"
                                                      fill="white" />
                                            </mask>
                                            <g mask="url(#mask1_463_5220)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M12.0004 20.6894C11.0634 20.6894 10.1314 20.5374 9.23141 20.2384C8.83841 20.1074 8.62541 19.6824 8.75641 19.2894C8.88741 18.8954 9.31041 18.6864 9.70541 18.8144C10.4524 19.0634 11.2244 19.1894 12.0004 19.1894C15.4284 19.1894 18.5614 16.7474 20.4304 12.6364C19.9744 11.6374 19.4434 10.7324 18.8494 9.94242C18.6004 9.61142 18.6664 9.14042 18.9974 8.89142C19.3274 8.64242 19.7984 8.71042 20.0474 9.04042C20.7714 10.0014 21.4074 11.1124 21.9384 12.3384C22.0214 12.5284 22.0214 12.7444 21.9384 12.9334C19.8424 17.7904 16.1274 20.6894 12.0004 20.6894"
                                                      fill="#999999" />
                                            </g>
                                            <mask id="mask2_463_5220" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                                  x="3" y="4" width="18" height="18">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M3.36328 4.00037H20.6368V21.2734H3.36328V4.00037Z"
                                                      fill="white" />
                                            </mask>
                                            <g mask="url(#mask2_463_5220)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M4.11303 21.2734C3.92103 21.2734 3.72903 21.2004 3.58303 21.0534C3.29003 20.7604 3.29003 20.2864 3.58303 19.9934L19.357 4.21938C19.65 3.92638 20.124 3.92638 20.417 4.21938C20.71 4.51238 20.71 4.98738 20.417 5.28038L4.64303 21.0534C4.49703 21.2004 4.30503 21.2734 4.11303 21.2734"
                                                      fill="#999999" />
                                            </g>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="input-password-feedback"></div>
                                </div>
                                <div class="form-group action-form-login">
                                    <div class="remember-left">
                                        <label class="main">
                                            <input type="checkbox" onclick="rememberMe()" id="remember">
                                            <span class="">Lưu đăng nhập</span>
                                            <span class="geekmark"></span>
                                        </label>
                                    </div>
                                    <div class="forgot-pwd-right">
                                        Lưu mật khẩu
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn-green btn-login" onclick="login()">Đăng
                                        nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
