<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token() }}">

    <title>Ivac Guestbook</title>

    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/dots.css')}}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body>
    <main class="container-fluid px-0 py-3">
        <div class="container">
            <div class="">
                <!-- <div class="col-xl-6 col-lg-7 col-md-10 col-12 mx-auto mb-5"> -->
                      <p class="welcome_text mb-0">Welcome to the Guest Book of the Virtual Exhibition, supporting the
                    Co-Creating Impact Summit 2021!
                    <br> Use this Guest Book by clicking on the dots to leave your reactions, impressions, thoughts and ideas.
                </p>
               
            </div>
        </div>

        <div class="frame animate__animated animate__zoomIn" id="frame">



        </div>


        <div class="modal fade dataModal" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" >Leave your message</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body" id="usermodel">

                    </div>

                    <div class="modal-footer" id="hidefooter">
                        <button type="button" class="btn customBtn shadow-sm" id="submitcomment">Share <i
                                class="fas fa-angle-right ml-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{url('public/assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('public/assets/js/popper.min.js')}}"></script>
    <script src="{{url('public/assets/js/bootstrap.min.js')}}"></script>

    <script>
    $(document).ready(function() {
        $("div.ring-1 div.dot a.fill, div.ring-2 div.dot a.fill, div.ring-3 div.dot a.fill, div.ring-4 div.dot a.fill, div.ring-5 div.dot a.fill, div.ring-6 div.dot a.fill, div.ring-7 div.dot a.fill, div.ring-8 div.dot a.fill, div.ring-9 div.dot a.fill, div.ring-10 div.dot a.fill, div.ring-11 div.dot a.fill, div.ring-12 div.dot a.fill, div.ring-13 div.dot a.fill")
            .hover(
                function() {
                    $("a.fill").addClass("animation_forward");
                },
                function() {
                    $("a.fill").removeClass("animation_forward");
                }
            );

        $("div.ring-14 div.dot a.fill, div.ring-15 div.dot a.fill, div.ring-16 div.dot a.fill,div.ring-17 div.dot a.fill,div.ring-18 div.dot a.fill")
            .hover(
                function() {
                    $("a.fill").addClass("animation_reverse");
                },
                function() {
                    $("a.fill").removeClass("animation_reverse");
                }
            );

        $("div.bg_box").hover(
            function() {
                $("a.fill").addClass("bg_box_animation");
            },
            function() {
                $("a.fill").removeClass("bg_box_animation");
            }
        );
    });
    </script>

    <script>
    $(document).ready(function() {
        $("a.fill").hover(
            function() {
                $(this).parent().addClass("index_1");
                $(this).parent().parent().addClass("index_1");
            },
            function() {
                $(this).parent().removeClass("index_1");
                $(this).parent().parent().removeClass("index_1");
            }
        );
    });
    </script>

    <script>
    // $(document).ready(function() {
    //     $('[data-toggle="tooltip"]').tooltip();
    // });
    </script>

    <script>
    $('body').on('click', '.fill', function() {
         $('#hidefooter').show();
        //  //$('#imgbox').before('<div class="text_box reply_box" ><p class="text reply_text">hldkf</p></div>');
        // $('#submitcomment').show();
        // $('#imgbox').before('<div class="text_box reply_box" ><p class="text reply_text">hldkf</p></div>');
        var id = $(this).attr('data-id');
        var url = '{{url("show_frm")}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $.ajax({
            type: 'post',
            url: url,
            data: {
                'id': id
            },
            success: function(data) {
                if(data.av==1){
                $('#hidefooter').hide();

                // if (data.av == 1) {
                //     $('#submitcomment').hide();
                 }
                $('#usermodel').html(data.htmls);
                $('#myModal').modal('show');

            }
        });

    })

    $('body').on('click', '.files', function() {
        var type = $(this).attr('data-id');
        $('#type').val(type);
        // $('#file').click();
        // var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');  
        //           $('.file_error').text(filename);
        $('#file').trigger('click');
        $('#file').change(function() {
            var filename = $('#file').val();
            if (filename.substring(3, 11) == 'fakepath') {
                filename = filename.substring(12);
            } // Remove c:\fake at beginning from localhost chrome
            $('.files_error').text(filename);
            $('.file_error').text(' ');
        });

    })
    // $('body').on('change','#file',function(){
    //     var i=$("#file")[0].files[0].size/ 1024 / 1024;
    //     if(i>10){

    //     }
    //     console.log('This file size is: ' + i + "MB");
    // })


    $('body').on('click', '#submitcomment', function() {
        var f_name = $("#f_name").val();
        if (f_name == "" || f_name == null) {
            $('.f_name_error').text('Enter First Name');
            $("#f_name").focus();
            return false;
        } else {
            $('.f_name_error').text(' ');

        }
        // var l_name = $("#l_name").val();
        // if (l_name == "" || l_name == null) {
        //     $('.l_name_error').text('Enter Last Name');
        //     $("#l_name").focus();
        //     return false;
        // } else {
        //     $('.l_name_error').text(' ');

        // }
        var title = $("#message").val();
        if (title == "" || title == null) {
            $('.message_error').text('Enter Message');
            $("#message").focus();
            return false;
        } else {
            $('.message_error').text(' ');

        }
        var image = document.getElementById("file").value;
        var ext = image.split('.').pop().toLowerCase();
        // if(image=="")
        // {
        //     $('.file_error').text('Please Select File');
        //     document.getElementById("file").focus();
        //     return false;
        // }
        var type = $('#type').val();
        if (type == 1) {
            var i = $("#file")[0].files[0].size;
            var numb =$("#file")[0].files[0].size / 1024 / 1024;
            numb = numb.toFixed(2);
            if (numb > 5) {
                $('.file_error').text('Maximum is 5MB. You file size is: ' + numb + ' MB');
                return false;
            } 
            
            if (image != "['pdf', 'doc', 'docx', 'xls']") {
                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                    $('.file_error').text('Wrong File Format!..Please Select Right Format');
                    document.getElementById("file").value = '';
                    document.getElementById("file").focus();
                    return false;
                }
            }
        } else if (type == 3) {
            var numb =$("#file")[0].files[0].size / 1024 / 1024;
            numb = numb.toFixed(2);
            if (numb > 5) {
                $('.file_error').text('Maximum is 5MB. You file size is: ' + numb + ' MB');
                return false;
            }
        }

        var form_data = new FormData();
        form_data.append("file", document.getElementById('file').files[0]);
        form_data.append('message', $("#message").val());
        form_data.append('f_name', $("#f_name").val());
        form_data.append('l_name', $("#l_name").val());
        form_data.append('type', $("#type").val());
        form_data.append('id', $("#id").val());
        var url = '{{url("add_comment")}}';
        var msg = $("#message").val();
        var id = $("#id").val();
        $('#' + id).addClass('submit');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $.ajax({
            type: 'post',
            url: url,
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                if (data.sucess == true) {


                    $('#' + id).html(
                        '<div class="info_box" style="background-image: url(https://i.ibb.co/KW2YFRh/Microsoft-Teams-image-44.jpg);"><h6 class="name_text"><span class="first_name">' +
                        f_name + '</span></h6></div>');
                    $('#addcomment')[0].reset();
                    $('#myModal').modal('hide');
                    $('.success_error').html(
                        '<div class="alert alert-success" role="alert">Form Submit Successfully</div>'
                    );
                } else {
                    $('.success_error').html(
                        '<div class="alert alert-danger" role="alert">Something went wrong</div>'
                    );
                }
                $('.msg').prepend(
                    '<div class="text_box message_box"><p class="text message_text msg" >' +
                    msg + '</p></div>');



            }
        });
    })
    setInterval(function() {
        var url = '{{url("show_graph")}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $.ajax({
            type: 'post',
            url: url,
            dataType: 'html',
            success: function(data) {

                $('#frame').html(data);
                $("div.ring-1 div.dot a.fill, div.ring-2 div.dot a.fill, div.ring-3 div.dot a.fill, div.ring-4 div.dot a.fill, div.ring-5 div.dot a.fill, div.ring-6 div.dot a.fill, div.ring-7 div.dot a.fill, div.ring-8 div.dot a.fill, div.ring-9 div.dot a.fill, div.ring-10 div.dot a.fill, div.ring-11 div.dot a.fill, div.ring-12 div.dot a.fill, div.ring-13 div.dot a.fill")
                    .hover(
                        function() {
                            $("a.fill").addClass("animation_forward");
                        },
                        function() {
                            $("a.fill").removeClass("animation_forward");
                        }
                    );

                $("div.ring-14 div.dot a.fill, div.ring-15 div.dot a.fill, div.ring-16 div.dot a.fill,div.ring-17 div.dot a.fill,div.ring-18 div.dot a.fill")
                    .hover(
                        function() {
                            $("a.fill").addClass("animation_reverse");
                        },
                        function() {
                            $("a.fill").removeClass("animation_reverse");
                        }
                    );

                $("div.bg_box").hover(
                    function() {
                        $("a.fill").addClass("bg_box_animation");
                    },
                    function() {
                        $("a.fill").removeClass("bg_box_animation");
                    }
                );
                $("a.fill").hover(
                    function() {
                        $(this).parent().addClass("index_1");
                        $(this).parent().parent().addClass("index_1");
                    },
                    function() {
                        $(this).parent().removeClass("index_1");
                        $(this).parent().parent().removeClass("index_1");
                    }
                );
                $('[data-toggle="tooltip"]').tooltip();

            }
        });
    }, 30000);

    $('body').on('click', '#submitreply', function() {
        var message = $('#reply_message').val();
        var reply_name = $('#reply_name').val();

        var id = $('#frm_id').val();
        var url = '{{url("submit_reply")}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $.ajax({
            type: 'post',
            url: url,
            data: {
                'id': id,
                'message': message,
                'reply_name': reply_name
            },
            success: function(data) {
                
               
             $('#appendmsg').append('<div class="text_box reply_box"><h6 class="replier_name mb-1">'+reply_name+'</h6><p class="text reply_text">'+message+'</p></div>');
            //  $('#submitreplyfrm')[0].reset();
            //      $('#wrar').click();
                 //   $('#imgbox').after('<div class="text_box reply_box"><p class="text reply_text">'+message+'</p></div>');
                


                // $('#appendmsg').append(

                //     '<div class="replyname"><div class="text_box reply_box"><p class="text reply_text">' +
                //     message +
                //     '</p></div>');
                $('#submitreplyfrm')[0].reset();
                $('#wrar').click();
                //   $('#imgbox').after('<div class="text_box reply_box"><p class="text reply_text">'+message+'</p></div>');


            }
        });

    })
    $(document).ready(function() {




        var url = '{{url("show_graph")}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $.ajax({
            type: 'post',
            url: url,
            dataType: 'html',
            success: function(data) {

                $('#frame').html(data);
                $("div.ring-1 div.dot a.fill, div.ring-2 div.dot a.fill, div.ring-3 div.dot a.fill, div.ring-4 div.dot a.fill, div.ring-5 div.dot a.fill, div.ring-6 div.dot a.fill, div.ring-7 div.dot a.fill, div.ring-8 div.dot a.fill, div.ring-9 div.dot a.fill, div.ring-10 div.dot a.fill, div.ring-11 div.dot a.fill, div.ring-12 div.dot a.fill, div.ring-13 div.dot a.fill")
                    .hover(
                        function() {
                            $("a.fill").addClass("animation_forward");
                        },
                        function() {
                            $("a.fill").removeClass("animation_forward");
                        }
                    );

                $("div.ring-14 div.dot a.fill, div.ring-15 div.dot a.fill, div.ring-16 div.dot a.fill,div.ring-17 div.dot a.fill,div.ring-18 div.dot a.fill")
                    .hover(
                        function() {
                            $("a.fill").addClass("animation_reverse");
                        },
                        function() {
                            $("a.fill").removeClass("animation_reverse");
                        }
                    );

                $("div.bg_box").hover(
                    function() {
                        $("a.fill").addClass("bg_box_animation");
                    },
                    function() {
                        $("a.fill").removeClass("bg_box_animation");
                    }
                );
                $("a.fill").hover(
                    function() {
                        $(this).parent().addClass("index_1");
                        $(this).parent().parent().addClass("index_1");
                    },
                    function() {
                        $(this).parent().removeClass("index_1");
                        $(this).parent().parent().removeClass("index_1");
                    }
                );
                // $('[data-toggle="tooltip"]').tooltip();

            }
        });




    });
    </script>
    <style type="text/css">
    span.error {
        color: red;
    }
    </style>

</body>

</html>
