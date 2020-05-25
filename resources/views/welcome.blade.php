<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{csrf_token()}}" />
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
    </head>
    <body>
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Send queue email with an attachment</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"></div>
                </div>

                <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    <div style="display:none" class="alert alert-success col-sm-12"></div>

                    <form class="form-horizontal">

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <select id="emails" name="emails[]" class="form-control" multiple>
                                @foreach($emails as $email=>$name)
                                    <option value="{{ $email }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <button class="btn btn-success sub1" id="submit">Send Email</button>
                                <button class="buttonload btn btn-success sub2" style="display: none" disabled>
                                    <i class="fa fa-spinner fa-spin"></i> Send Email
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#submit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/send-emails') }}",
                    method: 'post',
                    data: {
                        emails: $('#emails').val(),
                    },
                    beforeSend: function() {
                        $('.alert-success,.alert-danger').html('');
                        $('.alert-success,.alert-danger,.sub1').hide();
                        $('.sub2').show();
                    },
                    success: function(data){
                        $('.sub2').hide();
                        $('.sub1').show();
                        $.each(data.error, function(key, value){
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>'+value+'</p>');
                        });
                        if(data.success) {
                            $('.alert-success').show();
                            $('.alert-success').append(data.success);
                        }

                    }
                });
            });
        });
    </script>

    </body>
</html>
