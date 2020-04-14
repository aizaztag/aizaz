<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <title>Laravel Image Upload Tutorial Example From Scratch</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <style class="">
        @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css);
        @import url("https://fonts.googleapis.com/css?family=Roboto");
        html, body, * {
            box-sizing: border-box;
            font-size: 16px;
        }
        html, body {
            height: 100%;
            text-align: center;
        }
        body {
            padding: 2rem;
            background: #f8f8f8;
        }
        h2 {
            font-family: "Roboto", sans-serif;
            font-size: 26px;
            line-height: 1;
            color: #454cad;
            margin-bottom: 0;
        }
        p {
            font-family: "Roboto", sans-serif;
            font-size: 18px;
            color: #5f6982;
        }
        .uploader {
            display: block;
            clear: both;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
        }
        .uploader label {
            float: left;
            clear: both;
            width: 100%;
            padding: 2rem 1.5rem;
            text-align: center;
            background: #fff;
            border-radius: 7px;
            border: 3px solid #eee;
            transition: all .2s ease;
            user-select: none;
        }
        .uploader label:hover {
            border-color: #454cad;
        }
        .uploader label.hover {
            border: 3px solid #454cad;
            box-shadow: inset 0 0 0 6px #eee;
        }
        .uploader label.hover #start i.fa {
            transform: scale(0.8);
            opacity: 0.3;
        }
        .uploader #start {
            float: left;
            clear: both;
            width: 100%;
        }
        .uploader #start.hidden {
            display: none;
        }
        .uploader #start i.fa {
            font-size: 50px;
            margin-bottom: 1rem;
            transition: all .2s ease-in-out;
        }
        .uploader #response {
            float: left;
            clear: both;
            width: 100%;
        }
        .uploader #response.hidden {
            display: none;
        }
        .uploader #response #messages {
            margin-bottom: .5rem;
        }
        .uploader #file-image {
            display: inline;
            margin: 0 auto .5rem auto;
            width: auto;
            height: auto;
            max-width: 180px;
        }
        .uploader #file-image.hidden {
            display: none;
        }
        .uploader #notimage {
            display: block;
            float: left;
            clear: both;
            width: 100%;
        }
        .uploader #notimage.hidden {
            display: none;
        }
        .uploader progress,
        .uploader .progress {
            display: inline;
            clear: both;
            margin: 0 auto;
            width: 100%;
            max-width: 180px;
            height: 8px;
            border: 0;
            border-radius: 4px;
            background-color: #eee;
            overflow: hidden;
        }
        .uploader .progress[value]::-webkit-progress-bar {
            border-radius: 4px;
            background-color: #eee;
        }
        .uploader .progress[value]::-webkit-progress-value {
            background: linear-gradient(to right, #393f90 0%, #454cad 50%);
            border-radius: 4px;
        }
        .uploader .progress[value]::-moz-progress-bar {
            background: linear-gradient(to right, #393f90 0%, #454cad 50%);
            border-radius: 4px;
        }
        .uploader input[type="file"] {
            display: none;
        }
        .uploader div {
            margin: 0 0 .5rem 0;
            color: #5f6982;
        }
        .uploader .btn {
            display: inline-block;
            margin: .5rem .5rem 1rem .5rem;
            clear: both;
            font-family: inherit;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            text-transform: initial;
            border: none;
            border-radius: .2rem;
            outline: none;
            padding: 0 1rem;
            height: 36px;
            line-height: 36px;
            color: #fff;
            transition: all 0.2s ease-in-out;
            box-sizing: border-box;
            background: #454cad;
            border-color: #454cad;
            cursor: pointer;
        }
        .text-danger{
            color: red;
        }
    </style>

</head>
<body>
<div class="container">
    <br><br><br>
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        <br>
    @endif
    <h2>File Upload &amp; Image Preview</h2>
    <p class="lead">No Plugins <b>Just Javascript</b></p>
    <!-- Upload  -->
    <form id="file-upload-form" class="uploader" action="{{url('save')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
        <input id="file-upload" type="file" name="fileUpload" accept="image/*" onchange="readURL(this);">
        <input id="extension" type="text" name="extension" value="{{Request::old('extension')}}">
        <label for="file-upload" id="file-drag">
            <img id="file-image" src="#" alt="Preview" class="hidden">
            <div id="start" >
                <i class="fa fa-download" aria-hidden="true"></i>
                <div>Select a file or drag here</div>
                <div id="notimage" class="hidden">Please select an image</div>
                <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                <br>
                <span class="text-danger">{{ $errors->first('fileUpload') }}</span>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </label>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>

</body>
</html>