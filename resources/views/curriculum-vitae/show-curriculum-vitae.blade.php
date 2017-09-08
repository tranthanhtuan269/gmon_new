@extends('layouts.layout')

@section('content')
    <div class="container show-curriculum-vitae-page" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-8">            
                <div class="row curriculumvitae">
                    <div class="col-md-12">
                        <div class="row main-top">
                            <div class="col-md-5">
                                @if(strlen($curriculumvitae->avatar) > 1)
                                <img src="http://test.gmon.com.vn/?image={{ $curriculumvitae->avatar }}" width="200" height="200" class="img-circle
                                ">
                                @else
                                <img src="http://test.gmon.com.vn/?image=avatar.png" width="200" height="200" class="img-circle
                                ">
                                @endif
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="text-upper">{{ $curriculumvitae->name }}</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Ngày sinh: {{ $curriculumvitae->birthday }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Giới tính: @if($curriculumvitae->gender == 0) Nữ @else Nam @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Tỉnh / Thành phố: {{ $curriculumvitae->city }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Quận / Huyện: {{ $curriculumvitae->district }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(strlen($curriculumvitae->education) > 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Quá trình học tập</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->education = ltrim($curriculumvitae->education, ';');
                                            $educations = explode(";",$curriculumvitae->education);
                                            foreach ($educations as $education) {
                                            $edu = json_decode($education);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-4">Trường học </div>
                                            <div class="col-md-4">{{ $edu->truong_hoc }}</div>
                                            <div class="col-md-4">@if( $edu->student_process == 0) Đang học @else Đã tốt nghiệp @endif</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Thời gian học </div>
                                            <div class="col-md-4">Từ {{ $edu->thang_bat_dau }}/{{ $edu->nam_bat_dau }} </div>
                                            <div class="col-md-4">@if( $edu->student_process == 0) Đến nay @else Đến {{ $edu->thang_ket_thuc }}/{{ $edu->nam_ket_thuc }} @endif </div>
                                        </div>
                                        @if( $edu->bang_cap != 2)
                                        <div class="row">
                                            <div class="col-md-4">Chuyên ngành </div>
                                            <div class="col-md-8">{{ $edu->chuyen_nganh }} </div>
                                        </div>
                                        @endif
                                        @if(isset($edu->loai_tot_nghiep))
                                        <div class="row">
                                            <div class="col-md-4">Thành tích học tập </div>
                                            <div class="col-md-8">{{ $edu->loai_tot_nghiep }}</div>
                                        </div>
                                        <hr>
                                        @endif
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->word_experience) > 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Kinh nghiệm làm việc</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->word_experience = ltrim($curriculumvitae->word_experience, ';');
                                            if(substr($curriculumvitae->word_experience, -1) == ';'){
                                                $curriculumvitae->word_experience=rtrim($curriculumvitae->word_experience,";");
                                            }
                                            $word_experiences = explode(";",$curriculumvitae->word_experience);
                                            foreach ($word_experiences as $word_experience) {
                                            $exp = json_decode($word_experience);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-4"><img src="{{ $exp->company_image }}" width="100%" height="192"></div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-5">Vị trí công việc</div>
                                                    <div class="col-md-7">{{ $exp->vi_tri }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">Tên đơn vị đã làm</div>
                                                    <div class="col-md-7">{{ $exp->ten_cong_ty }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">Địa chỉ</div>
                                                    <div class="col-md-7">{{ $exp->dia_chi_cong_ty }} - {{ $exp->quan_huyen }} - {{ $exp->thanh_pho }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">Thời gian làm</div>
                                                    <div class="col-md-7">Từ {{ $exp->thang_bat_dau_lam_viec }}/{{ $exp->nam_bat_dau_lam_viec }} Đến {{ $exp->thang_ket_thuc_lam_viec }}/{{ $exp->nam_ket_thuc_lam_viec }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">Mô tả công việc</div>
                                                    <div class="col-md-7"><?php echo $exp->mo_ta; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->qualification) > 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Kỹ năng</div>
                                    <div class="panel-body">
                                        <div class="row">
                                        <?php 
                                            $curriculumvitae->qualification = ltrim($curriculumvitae->qualification, ';');
                                            $qualifications = explode(";",$curriculumvitae->qualification);
                                        ?>
                                            <div class="col-md-12">Thành thạo 
                                                @if(count($qualifications) > 1)
                                                @for ($i = 0; $i < count($qualifications); $i++)
                                                    <?php 
                                                        $qual = json_decode($qualifications[$i]);
                                                        if($i+1 == count($qualifications))
                                                            echo ' và ' . $qual->ten_ky_nang;
                                                        elseif($i+2 == count($qualifications))
                                                            echo $qual->ten_ky_nang;
                                                        else
                                                            echo $qual->ten_ky_nang . ',';
                                                    ?>
                                                @endfor
                                                @else
                                                    <?php 
                                                    $qual = json_decode($qualifications[0]);
                                                    echo $qual->ten_ky_nang;
                                                    ?>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->language) > 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Ngoại ngữ</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->language = ltrim($curriculumvitae->language, ';');
                                            $languages = explode(";",$curriculumvitae->language);
                                            foreach ($languages as $language) {
                                            $lang = json_decode($language);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">{{ $lang->ten_ngoai_ngu }}</div>
                                            <div class="col-md-6">{{ $lang->trinh_do_ngoai_ngu }}</div>
                                        </div>
                                        <hr>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Sở thích / Tính cách</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6"><?php echo $curriculumvitae->interests; ?></div>
                                            <div class="col-md-6"><?php echo $curriculumvitae->references; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(strlen($curriculumvitae->career_objective) > 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Mục đích làm việc?</div>
                                    <div class="panel-body">
                                        <div class="row">
                                        <?php 
                                            $curriculumvitae->career_objective = ltrim($curriculumvitae->career_objective, ';');
                                            $career_objectives = explode(";",$curriculumvitae->career_objective);
                                            foreach ($career_objectives as $career_objective) {
                                                switch ($career_objective) {
                                                    case 'career_objective_0':
                                                        echo '<div class="col-md-12">- Muốn được trải nghiệm trong môi trường làm việc tại Doanh nghiệp!</div>';
                                                        break;
                                                    case 'career_objective_1':
                                                        echo '<div class="col-md-12">- Học hỏi kinh nghiệm và các kỹ năng xử lý tình huống trong công việc!</div>';
                                                        break;
                                                    case 'career_objective_2':
                                                        echo '<div class="col-md-12">- Rèn luyện thêm khả năng giao tiếp!</div>';
                                                        break;
                                                    case 'career_objective_3':
                                                        echo '<div class="col-md-12">- Rèn luyện tác phong làm việc chuyên nghiệp!</div>';
                                                        break;
                                                    case 'career_objective_4':
                                                        echo '<div class="col-md-12">- Thử đi làm thêm để trải nghiệm!</div>';
                                                        break;
                                                    case 'career_objective_5':
                                                        echo '<div class="col-md-12">- Kiếm thêm thu nhập để đi du lịch!</div>';
                                                        break;
                                                    case 'career_objective_6':
                                                        echo '<div class="col-md-12">- Kiếm thêm thu nhập trang trải chi tiêu cá nhân!</div>';
                                                        break;
                                                    case 'career_objective_7':
                                                        echo '<div class="col-md-12">- Kiếm thêm thu nhập hỗ trợ gia đình!</div>';
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Hoạt động ngoại khóa</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12"><?php echo $curriculumvitae->active; ?></div>
                                        </div>
                                        <div class="row">
                                            <?php 
                                                if(strlen($curriculumvitae->images) > 0){
                                                    $curriculumvitae->images = rtrim($curriculumvitae->images,";");
                                                    $images = explode(";",$curriculumvitae->images);
                                                    $i = 0;
                                                    foreach ($images as $image) {
                                                        $i++;
                                                        if($i%4 == 0) break;
                                            ?>
                                            <div class="col-md-4"><img src="http://test.gmon.com.vn/?image={{ $image }}" width="100%" height="102"></div>
                                            <?php 
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn btn-danger pull-right" style="display:none;">In hồ sơ</div>
                                <div class="btn btn-primary pull-right" style="display:none;">Lưu hồ sơ</div>
                                @if(Auth::check())
                                @if($curriculumvitae->user == Auth::user()->id)
                                <a class="btn btn-primary pull-right" href="{{ url('/') }}/curriculumvitae/{{ $curriculumvitae->id }}/edit">Sửa hồ sơ</a>
                                @else
                                <div class="btn btn-primary pull-right" data-toggle="modal" data-target="#danh-gia">Đánh giá ứng viên</div>
                                @endif
                                @else
                                <div class="btn btn-primary pull-right" data-toggle="modal" data-target="#danh-gia">Đánh giá ứng viên</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cv-btn-holder">
                            <div class="btn btn-primary">Lưu hồ sơ</div>
                            <div class="btn btn-warning pull-right">Xem thông tin liên hệ ( -3 điểm )</div>
                        </div>
                    </div>
                </div>
                <div class="row cv-info-holder">
                    <div class="col-md-2 cv-info">Xem <div>160</div></div>
                    <div class="col-md-3 text-center cv-info">Tải xuống <div>160</div></div>
                    <div class="col-md-4 text-center cv-info">Tải thành công <div>100%</div></div>
                    <div class="col-md-3 text-right cv-info">Cập nhật <div>07/2017</div></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="cv-rate-holder">
                            <div class="rate-holder-label">Đánh giá ứng viên</div>
                            <p class="star-vote text-center" id="star-vote-current">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="vote">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="vote">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="vote">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="vote">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="cv-rates-holder">
                            <div class="rate-holders-label">Nhà tuyển dụng nói gì?</div>
                            <div class="content-rates">
                                @foreach($commentCurriculumVitaes as $commentCurriculumVitae)
                                <div class="content-rate">
                                    <p class="star-vote" id="star-vote-by-company">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="@if(intval($commentCurriculumVitae->star) > 1) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="@if(intval($commentCurriculumVitae->star) > 2) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="@if(intval($commentCurriculumVitae->star) > 3) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="@if(intval($commentCurriculumVitae->star) > 4) vote @else no-vote @endif">
                                    </p>
                                    <div class="rate-comment">
                                        {{ $commentCurriculumVitae->description }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="cv-rates-holder">
                            <div class="rate-holders-label">Ứng viên khác nói gì?</div>
                            <div class="content-rates">
                                @foreach($commentCurriculumVitaes as $commentCurriculumVitae)
                                <div class="content-rate">
                                    <p class="star-vote" id="star-vote-by-company">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="@if(intval($commentCurriculumVitae->star) > 1) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="@if(intval($commentCurriculumVitae->star) > 2) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="@if(intval($commentCurriculumVitae->star) > 3) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="@if(intval($commentCurriculumVitae->star) > 4) vote @else no-vote @endif">
                                    </p>
                                    <div class="rate-comment">
                                        {{ $commentCurriculumVitae->description }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="danh-gia" tabindex="-1" role="dialog" aria-labelledby="danhgiaLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">Đánh giá ứng viên</h4>
          </div>
          <div class="modal-body">
                <form class="form-horizontal">
                <input type="hidden" name="curriculumvitae" value="{{ $curriculumvitae->id }}">
                <input type="hidden" name="score" value="3">
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <p class="star-vote" id="star-vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="no-vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="no-vote">
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="5" id="inputDescription">Nói cho mọi người biết điều bạn nghĩ về ứng viên</textarea>
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="pull-left message-danh-gia">Hãy cho chúng tôi biết về điều bạn thích và không thích</div>
            <button type="button" class="btn btn-primary" id="send-message">Gửi đánh giá</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#inputDescription').click(function(){
                if($('#inputDescription').val() == 'Nói cho mọi người biết điều bạn nghĩ về ứng viên'){
                    $('#inputDescription').val('');
                }
            });

            $('#star-vote img').click(function () {
                switch ($(this).attr('id')) {
                    case 'star-vote-1':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-3').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-2':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-3').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-3':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-4':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-4').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-5':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-4').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-5').removeClass('no-vote').addClass('vote');
                        break;
                    default:
                        break;
                }
            });

            $('#send-message').click(function(){
                var countStar = $('#star-vote>img.vote').length;
                var description = $('#inputDescription').val();
                var curriculumvitae = $('input[name=curriculumvitae]').val()
                var request = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/') }}/curriculumvitae/send-comment",
                    method: "POST",
                    data: {
                        'curriculumvitae': curriculumvitae,
                        'description': description,
                        'countStar': countStar,
                    },
                    dataType: "json"
                });

                request.done(function (msg) {
                    if (msg.code == 200) {
                        $('#add-comment').modal('toggle');
                        swal("Thông báo", "Thêm đánh giá thành công!", "success");
                    } else {
                        $('#add-comment').modal('toggle');
                        swal("Cảnh báo", msg.message, "error");
                    }
                });

                request.fail(function (jqXHR, textStatus) {
                    swal("Cảnh báo", textStatus, "error");
                });
            });
        });
    </script>
@endsection