@extends('layouts.layout_uv')

@section('content')
<style type="text/css">
  .info span i{
    background: none;
  }
  .profile-05 .right .content{
    padding: 0 15px;
  }
</style>
<div class="col-lg-9 right">
    <div class="title">
        <i class="fa fa-address-book" aria-hidden="true"></i>
        <span>Danh sách công ty đang theo dõi</span>
    </div>
    <div class="content" id="company-list">
      @foreach($companiesFollowed as $company)
        <div class="item row">
          <div class="thumb col-lg-2">
              <img src="http://test.gmon.com.vn/?image={{ $company->logo }}" alt="avatar" />
          </div>
          <div class="text col-lg-10">
              <h3><a target="_blank" href="{{ url('/') }}/company/{{ $company->id }}/{{ $company->slug }}">{{ ucfirst($company->name) }}</a></h3>
              <p>
                  <?php
                      echo $company->description;
                  ?>
              </p>
              <div class="info">
                  <span>
                      Công việc <i class="fa fa-briefcase" aria-hidden="true"></i> {{ $company->jobNumber }}
                  </span>
                  <span>
                      Theo dõi <i class="fa fa-eye" aria-hidden="true"></i> {{ $company->followNumber }}
                  </span>
              </div>
          </div>
        </div>
      @endforeach
    </div>
</div>

<script type="text/javascript">
  var site_url = $('base').attr('href');
  var $currentCompany = 5;
  var $numberGet = 5;
  var $currentPossion = 0;
  var $newPossion = 0;
  $(window).scroll(function (event) {
      var scroll = $(window).scrollTop();
      $newPossion = scroll;
      if($newPossion - $currentPossion > 680){
          $currentPossion = $newPossion;
          $('.mass-content').show();
          $('.loader').show();
          var request = $.ajax({
              url: "{{ URL::to('/') }}/getCompanyNew/?start=" + $currentCompany  + "&number=" + $numberGet,
              method: "GET",
              dataType: "json"
          });

          request.done(function (msg) {
              $('.mass-content').hide();
              $('.loader').hide();
              if(msg['code'] == 200){
                  var $html = '';
                  var temp = '';
                  $(msg['companiesFollowed']).each(function( index ) {
                      $html += '<div class="item row">';
                        $html += '<div class="thumb col-lg-2">';
                            $html += '<img src="http://test.gmon.com.vn/?image='+ $(this)[0].logo +'" alt="avatar" />';
                        $html += '</div>';
                        $html += '<div class="text col-lg-10">';
                            $html += '<h3><a target="_blank" href="' + site_url + '/company/'+ $(this)[0].id +'/'+ $(this)[0].slug +'">'+ $(this)[0].name +'</a></h3>';
                            $html += '<p>';
                            $html += $(this)[0].description;
                            $html += '</p>';
                            $html += '<div class="info">';
                                $html += '<span>';
                                    $html += 'Công việc <i class="fa fa-briefcase" aria-hidden="true"></i>'+ $(this)[0].jobNumber;
                                $html += '</span>';
                                $html += '<span>';
                                    $html += 'Theo dõi <i class="fa fa-eye" aria-hidden="true"></i>'+ $(this)[0].followNumber;
                                $html += '</span>';
                            $html += '</div>';
                        $html += '</div>';
                      $html += '</div>';
                  });
                  $currentCompany += $numberGet;
                  $('#company-list').append($html);
              }
          });

          request.fail(function (jqXHR, textStatus) {
              alert("Request failed: " + textStatus);
          });
      }
  });
</script>
@endsection