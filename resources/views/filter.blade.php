@extends('layouts.layout_master')

@section('content')
<script src="{{ url('/') }}/public/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/sweetalert/sweetalert.css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=212812479241763";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css">
    .header-homepage{
        background: none;
        background-size: cover;
        height: 595px;
        position: relative;
        font-family: Roboto, sans-serif;
    }

    .obj-name:first-letter {
        text-transform: uppercase;
    }

    .single p:first-letter {
        text-transform: uppercase;
    }

</style>

<?php
  
?>

@endsection