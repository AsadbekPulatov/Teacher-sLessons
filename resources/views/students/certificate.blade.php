<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center; /* Ensure text is centered horizontally */
    }

    .container img {
        margin: 0 10px; /* Adjust margin as needed */
        vertical-align: middle; /* Align the image vertically */
    }

    .text {
        font-size: 14pt;
    }
    body{
        background-image: url('{{public_path('3.png')}}');
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh; /* This will make the background cover the entire viewport height */
        display: flex;
        justify-content: center;
        align-items: center;
        background-size: cover;
    }

    .pm-certificate-block{
        margin-top: 140px;
    }
</style>
<body style="font-weight:bold; background-color:#F2F2EE">
<div class="container pm-certificate-container">
    <div class="outer-border"></div>
    <div class="inner-border"></div>

    <div class="pm-certificate-border col-xs-12">
        <div class="row pm-certificate-header">
            <div class="pm-certificate-title cursive col-xs-12 text-center">
{{--                <span style="margin:0px 200px; position: absolute; top: 90px">UDK: 123456789 </span>--}}
{{--                <img src="{{public_path('logo2.png')}}" style="margin-top: 50px; margin-right:500px" width="80px" alt="">--}}
{{--                <img src="{{public_path('logo1.png')}}" style="margin-top: 60px" width="80px" alt="">--}}
            </div>
        </div>

        <div class="row pm-certificate-body">

            <div class="pm-certificate-block">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                        <div class="pm-course-title col-xs-8 text-center" style="margin-top: 20px">
                            <span class="pm-earned-text block cursive" style="font-size: 70px; color: goldenrod ">Certificate of Completion</span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                        <div class="pm-course-title underline col-xs-8 text-center">
                            <span class="pm-credits-text block bold sans" style="font-weight: normal; font-size: 20px">This is to certify that</span>
                        </div>
                        <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="row">
                        <div class="pm-earned text-center" style="margin-top: 10px">
                            <span class="pm-earned-text padding-0 block cursive" style="font-size: 40px"><i>{{$user->name.' '.$user->surname}}</i></span>
                        </div>
                        <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                        <div class="col-xs-12"></div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                        <div class="pm-course-title underline col-xs-8 text-center" style="margin-top: 20px; ">
                            <span class="pm-credits-text block sans" style="font-weight: normal; font-size: 20px">has completed the course</span>
                        </div>
                        <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                        <div class="pm-course-title underline col-xs-8 text-center" style="margin-top: 10px; ">
                            <span class="pm-earned-text block cursive" style="font-size: 70px;">{{ $course->title }}</span>
{{--                            <span class="pm-credits-text block bold sans" style="font-size: 20px">{{ $course->title }}</span>--}}
                        </div>
                        <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12" style="position: relative;">
                <div class="row">
                    <div class="pm-certificate-footer">

{{--                        <div class="container">--}}
{{--                            <span class="text" style="font-size: 16px;margin-left: 50px;">Urganch davlat pedagogika instituti rektori</span>--}}
{{--                            <img src="{{ public_path('pechat.png') }}" style="margin-top: -80px; margin-left: 50px; position:relative; top: 50px" width="200px" alt="">--}}
{{--                            <span class="text" style="font-size: 16px; margin-left: 0px; margin-top: 100px">F.R.Madraximova</span>--}}
{{--                        </div>--}}



                        <div class="col-xs-4">
                            <!-- LEAVE EMPTY -->
                        </div>
                        <div class="col-xs-4 pm-certified col-xs-4 text-center" style="margin-top: 180px">
{{--                            <span class="pm-credits-text block sans">11-mart, 2024-yil </span>--}}
                            <p class="bold block">Date: {{ date('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
</body>
</html>
