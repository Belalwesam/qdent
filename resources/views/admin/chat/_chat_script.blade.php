<script>

    $('#uploadImg').on('click', function () {
        $('#imgupload').trigger('click');
    });
    $(function () {
        // Multiple images preview in browser
        var imagesPreview = function (input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function (event) {
                        $($.parseHTML('<img height="80">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#imgupload').on('change', function () {
            imagesPreview(this, 'div.filearray');
        });
    });

    $(window).on('load', function () {
        myName = "{{\Illuminate\Support\Facades\Auth::user()->name}}"
        id = "0"
        var chat = document.getElementById("chat_id").value;


        ///****************************** get chat room //*****************************************************
        // db.collection("group").where("user_id", "array-contains", id  )
        db.collection("chat_groups").orderBy('last_time', 'desc')
            .get()
            .then((querySnapshot) => {

                querySnapshot.forEach((snapshot) => {
                    console.log(snapshot.data());

                    if (snapshot.data().seen_admin == false) {

                        $(' <div class="d-flex align-items-center justify-content-between mb-5">\n' +
                            '                                <div class="d-flex align-items-center">\n' +
                            '                                    <div class="symbol symbol-circle symbol-50 mr-3">\n' +
                            '<span class="symbol symbol-35 symbol-light-success">\n' +
                            '   <span class="symbol-label font-size-h5 font-weight-bold">' + snapshot.data().name.charAt(0).toUpperCase() + ' </span></span>\n' + '                                    </div>\n' +
                            '                                    <div class="d-flex flex-column">\n' +
                            '                                        <a  href="#" id="chat_ids" onclick="chat(this)" data-chat="' + snapshot.id + '" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">'
                            + snapshot.data().name + '</a>\n' +
                            ' <span class="text-muted font-weight-bold font-size-sm" id="last' + snapshot.id + '"></span>' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '<div class="d-flex flex-column align-items-end">\n' +
                            '<span class="text-muted font-weight-bold font-size-sm" id="time' + snapshot.id + '"></span>\n' +
                            '<span class="label label-sm label-danger " id="seen-' + snapshot.id + '" ><i class="fa fa-facebook-messenger"></i></span>\n' +
                            '</div>' +
                            '                            </div>').appendTo($('#chats')).addClass('new');
                    } else {
                        $(' <div class="d-flex align-items-center justify-content-between mb-5">\n' +
                            '                                <div class="d-flex align-items-center">\n' +
                            '                                    <div class="symbol symbol-circle symbol-50 mr-3">\n' +
                            '<span class="symbol symbol-35 symbol-light-success">\n' +
                            '   <span class="symbol-label font-size-h5 font-weight-bold">' + snapshot.data().name.charAt(0).toUpperCase() + ' </span></span>\n' + '                                    </div>\n' +
                            '                                    <div class="d-flex flex-column">\n' +
                            '                                        <a  href="#" id="chat_ids" onclick="chat(this)" data-chat="' + snapshot.id + '" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">'
                            + snapshot.data().name + '</a>\n' +
                            ' <span class="text-muted font-weight-bold font-size-sm" id="last' + snapshot.id + '"></span>' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '<div class="d-flex flex-column align-items-end">\n' +
                            '<span class="text-muted font-weight-bold font-size-sm" id="time' + snapshot.id + '"></span>\n' +
                            '</div>' +
                            '                            </div>').appendTo($('#chats')).addClass('new');
                    }
                    // }
                    $("#last" + snapshot.id).html(snapshot.data().last_message);
                    time = snapshot.data().last_message_time;
                    $("#time" + snapshot.id).html(time);


                });
            })
            .catch((error) => {
                console.log("Error getting documents: ", error);
            });
//***************************************** put name of user ***********************************************
        db.collection("group").doc(chat).get().then((doc) => {
            if (doc.exists) {
                // console.log(doc.data())
                if (doc.data().name.name1 != myName) {
                    $('#name_chat').text(doc.data().name.name1)

                } else {
                    $('#name_chat').text(doc.data().name.name2)
                }
            } else {
                // doc.data() will be undefined in this case
                console.log("No such document!");
            }
        }).catch((error) => {
            console.log("Error getting document:", error);
        });

    });

    function chat(identifier) {

        myName = "admin"
        id = "1"
        var chat = $(identifier).data("chat");
        $('#chat_id').val(chat);
        otherUser = '';

        $('#chat_textarea').css('display', 'block');
        //***************************************** put name of user ***********************************************
        db.collection("chat_groups").doc(chat).get().then((doc) => {
            if (doc.exists) {
                if (doc.data().name != myName) {
                    $('#name_chat').text(doc.data().users[0])
                    otherUser = (doc.data().users[0])
                } else {
                    $('#name_chat').text(doc.data().users[1])
                    otherUser = (doc.data().users[1])

                }
            } else {
                // doc.data() will be undefined in this case
                console.log("No such document!");
            }
        }).catch((error) => {
            console.log("Error getting document:", error);
        });
        $('#message2').html('');

        //**************** on change //*****************************************************
        db.collection("chat_groups").doc(chat).collection('group_messages').orderBy('time', 'desc').onSnapshot(function (snapshot) {
            db.collection("chat_groups").doc(chat).update({

                "seen_admin": true,
            });
            $('#seen-' + chat).css('display', 'none');
            snapshot.docChanges().forEach(function (change) {

                if (change.type === "added") {
                    var msg = change.doc.data().message || '<img onclick="onClick(this)" class="img-message" src="' + change.doc.data().src + '">';
                    if (change.doc.data().sender_id == 0) {

                        $('<div class="d-flex flex-column mb-5 align-items-end">\n' +
                            '<div class="d-flex align-items-center">\n' +
                            '<div>\n' +
                            '<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>\n' +
                            '</div>\n' +
                            '<div class="symbol symbol-circle symbol-40 ml-3">\n' +
                            '</div>\n' +
                            '</div>\n' +
                            '<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">' +
                            msg + '</div>' +
                            '<span class="text-muted font-size-sm">' + change.doc.data().time + '</span>\n' +

                            '</div>').appendTo($('#message2')).addClass('new');
                        $('.message-input').val(null);


                    } else {

                        $('   <div class="d-flex flex-column mb-5 align-items-start">\n' +
                            '                                    <div class="d-flex align-items-center">\n' +
                            '                                        <div class="symbol symbol-circle symbol-40 mr-3">\n' +
                            '                                        </div>\n' +
                            '                                        <div  id="message-' + change.doc.id + '">' +
                            '                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6" >' + otherUser + '</a>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">'
                            + msg + '</div>\n' +
                            '                                            <span class="text-muted font-size-sm">' + change.doc.data().time + '</span>\n' +
                            '                                </div>').appendTo($('#message2')).addClass('new');
                    }
                    var objDiv = document.getElementById("message2");
                    objDiv.scrollTop = objDiv.scrollHeight;
                }
                // if (change.type === "modified") {
                //     console.log("Modified city: ", change.doc.data());
                // }
                // if (change.type === "removed") {
                //     console.log("Removed city: ", change.doc.data());
                // }
            });
        });


    }


    function insertMessage() {
        msg = $('.message-input').val();
        img = $('#imgupload').val();
        if ($.trim(msg) == '' && img == '') {
            return false;
        }
        sendMessage();
    }

    $('.message-submit').click(function () {
        insertMessage();
    });

    $(window).on('keydown', function (e) {
        if (e.which == 13) {
            insertMessage();
            return false;
        }
    });

    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
    }

    function timeSince(date) {

        var seconds = Math.floor((new Date() - date) / 1000);
        var myDate = new Date(date * 1000);
        console.log(myDate.toLocaleString());
        return myDate.toLocaleString();
        var interval = Math.floor(seconds / 31536000);

        if (interval > 1) {
            return interval + " years";
        }
        interval = Math.floor(seconds / 2592000);
        if (interval > 1) {
            return interval + " months";
        }
        interval = Math.floor(seconds / 86400);
        if (interval > 1) {
            return interval + " days";
        }
        interval = Math.floor(seconds / 3600);
        if (interval > 1) {
            return interval + " hours";
        }
        interval = Math.floor(seconds / 60);
        if (interval > 1) {
            return interval + " minutes";
        }
        return Math.floor(seconds) + " seconds";
    }


</script>
