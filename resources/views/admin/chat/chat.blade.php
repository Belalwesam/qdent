@extends('layout.default')
@section('styles')
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-storage.js"></script>
    <style>
        .img-message {
            object-fit: scale-down;
            width: 200px;
            height: 162px;
            box-shadow: 0px -1px 10px;
        }
    </style>

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        @media (max-width: 768px) {
            .w3-modal {
                padding-top: 220px !important;
            }
        }

    </style>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#config-web-app -->

    <script>

        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyCU4TZ5EDr_dVxZuZIDdzXJCq6hWa_giao",
            authDomain: "qdent-60bcf.firebaseapp.com",
            projectId: "qdent-60bcf",
            storageBucket: "qdent-60bcf.appspot.com",
            messagingSenderId: "40128659303",
            appId: "1:40128659303:web:060a93892b30950615b9c2",
            measurementId: "G-EB3PDX87HM",
            databaseURL: "https://qdent-60bcf-default-rtdb.europe-west1.firebasedatabase.app/",
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const db = firebase.firestore();

        firebase.database().ref("messages").on("child_removed", function (snapshot) {
            document.getElementById("message-" + snapshot.key).innerHTML = "This message has been deleted";
        });

        function deleteMessage(self) {
            var messageId = self.getAttribute("data-id");
            firebase.database().ref("messages").child(messageId).remove();
        }


        function sendMessage() {
            var message = document.getElementById("message").value;
            var chat = document.getElementById("chat_id").value ?? 'sd';

            if (message != '') {
                var d = new Date();
                var time = d.getTime();
                // console.log(time)
                db.collection("chat_groups").doc(chat).collection('group_messages').add({
                    "message": message,
                    "sender_id": "0",
                    "src": "",
                    "time": '{{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y-m-d A g:i') }}'
                });
                db.collection("chat_groups").doc(chat).update({
                    "last_message": message,
                    "last_message_time": '{{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y-m-d A g:i') }}',
                    "seen": false,
                    "seen_admin": true,
                });

                {{--$.ajaxSetup({--}}
                {{--    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}--}}
                {{--});--}}

                {{--$.ajax({--}}
                {{--    url: '{{ url('/message/notification') }}',--}}
                {{--    method: 'POST',--}}
                {{--    data: {--}}
                {{--        _token: '{{ csrf_token() }}',--}}
                {{--        ids: user_ids--}}
                {{--    },--}}
                {{--    success: function (data) {--}}
                {{--        console.log('success')--}}
                {{--    }--}}
                {{--});--}}

                $('.message-input').val(null);
                return false;
            }
        }

    </script>

    <style>
        /* width */
        #message2::-webkit-scrollbar {
            background-color: #C9F7F5;
            width: 8px;
        }

        /* Track */
        #message2::-webkit-scrollbar-track {
            background-color: #C9F7F5;
            box-shadow: 0 0 3px #C9F7F5;
            border-radius: 20px;
        }

        /* Handle */
        #message2::-webkit-scrollbar-thumb {
            background-color: hsl(200, 48%, 61%);
            border-radius: 10px;
        }

        /* Handle on hover */
        #message2::-webkit-scrollbar-thumb:hover {
            background: #1BC5BD;
        }
    </style>
@endsection
@section('content')
    <!--begin::Chat-->
    <div class="d-flex flex-row">
        <!--begin::Aside-->
        <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin:Search-->
                    {{--                        <div class="input-group input-group-solid">--}}
                    {{--                            <div class="input-group-prepend">--}}
                    {{--														<span class="input-group-text">--}}
                    {{--															<span class="svg-icon svg-icon-lg">--}}
                    {{--																<!--begin::Svg Icon | path:/assets/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->--}}
                    {{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                    {{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                    {{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
                    {{--																		<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>--}}
                    {{--																		<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>--}}
                    {{--																	</g>--}}
                    {{--																</svg>--}}
                    {{--                                                                <!--end::Svg Icon-->--}}
                    {{--															</span>--}}
                    {{--														</span>--}}
                    {{--                            </div>--}}
                    {{--                            <input type="text" class="form-control py-4 h-auto" placeholder="Email">--}}
                    {{--                        </div>--}}
                    <!--end:Search-->
                    <!--begin:Users-->
                    <div class="mt-7 scroll scroll-pull ps ps__rtl ps--active-y" id="chats" style="overflow: auto !important;
    width: auto;
    height: 500px;">

                        <!--begin:User-->
                        <!--end:User-->
                        <!--begin:User-->

                        <!--end:User-->
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 264px; right: 341px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div>
                        </div>
                    </div>
                    <!--end:Users-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        {{--            <div class="offcanvas-mobile-overlay"></div>--}}
        <!--end::Aside-->
        <!--begin::Content-->
        <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header align-items-center px-4 py-3">
                    <div class="text-left flex-grow-1">
                        <!--begin::Aside Mobile Toggle-->

                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none"
                                id="kt_app_chat_toggle">
														<span class="svg-icon svg-icon-lg">
															<!--begin::Svg Icon | path:/assets/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Adress-book2.svg-->
															<svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                 height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none"
                                                                   fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z"
                                                                          fill="#000000" opacity="0.3"></path>
																	<path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
                                                                          fill="#000000"></path>
																</g>
															</svg>
                                                            <!--end::Svg Icon-->
														</span>
                        </button>
                        <!--end::Aside Mobile Toggle-->
                        <!--begin::Dropdown Menu-->
                        <!--end::Dropdown Menu-->
                    </div>
                    <div class="text-center flex-grow-1">
                        <div class="text-dark-75 font-weight-bold font-size-h5" id="name_chat">None</div>
                        {{--                            <div>--}}
                        {{--                                <span class="label label-sm label-dot label-success"></span>--}}
                        {{--                                <span class="font-weight-bold text-muted font-size-sm">Active</span>--}}
                        {{--                            </div>--}}
                    </div>
                    <div class="text-right flex-grow-1">
                        <!--begin::Dropdown Menu-->
                        <!--end::Dropdown Menu-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body" style="">
                    {{--                        <div class="scroll scroll-pull ps ps__rtl ps--active-y" data-mobile-height="350" style="height: auto; overflow: auto;">--}}
                    <div class="messages " id="message2"
                         style="overflow: auto;width: auto;height: 500px; padding: 20px;direction: ltr">
                        <div style="text-align: center;">
                            <img src="/assets/media/svg/icons/Communication/Chat6.svg" height="200">
                            <h4>{{__('no-message')}}</h4>
                            <span class="span">{{__('Selectconverstion')}} </span>
                        </div>

                    </div>
                    {{--                            <div class="ps__rail-x" style="left: 0px; bottom: -200px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 200px; height: 95px; right: 805px;"><div class="ps__thumb-y" tabindex="0" style="top: 11px; height: 40px;"></div></div></div>--}}
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer align-items-center" style="display: none" id="chat_textarea">
                    <!--begin::Compose-->
                    <textarea class="message-input form-control border-0 p-0" id="message" rows="3"
                              placeholder="{{__('typeMsg')}}"></textarea>
                    <div class="filearray">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-5">
                        {{--                            <div class="mr-3">--}}
                        {{--                                <input type="file" onchange="loadFile(event)" id="imgupload" multiple accept="image/x-png,image/gif,image/jpeg" style="display:none"/>--}}

                        {{--                                <a href="#" id="uploadImg" class="btn btn-clean btn-icon btn-md mr-1">--}}
                        {{--                                    <i class="flaticon2-photograph icon-lg"></i>--}}
                        {{--                                </a>--}}

                        {{--                            </div>--}}
                        <div>
                            <button type="button"
                                    class=" message-submit btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6  ">
                                {{__('send')}}</button>
                        </div>
                    </div>
                    <!--begin::Compose-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Chat-->
    <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
        <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
        <div class="w3-modal-content w3-animate-zoom">
            <img id="img01" style="width:100%">
        </div>
    </div>
    <input type="hidden" value="" name="chat_id" id="chat_id">

    <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
@endsection

@section('scripts')

    <script src="/assets/js/pages/custom/chat/chat.js?v=7.2.0"></script>

    <script src="{{asset('/js/ajax.js')}}"></script>
    @include('admin.chat._chat_script')
@endsection
