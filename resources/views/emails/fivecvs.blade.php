<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="margin: 20px;">
	<h1 style="text-align: center;">Chào mừng bạn tới với dịch vụ của Gmon</h1>
	<h3 style="margin-left: 10px;">Một ứng viên vừa ứng tuyển 1 vị trí công việc bạn tạo ra!</h3>
	<div class="cvs-component">
		<div style="margin: 10px; border: 1px solid #eee; border-radius: 5px; padding: 16px; font-size: 16px; line-height: 25px;" class="cv-component">
			@if(isset($cv->avatarCv) && strlen($cv->avatarCv) > 3)
			<div style="width: 15%; float: left;"><a href="http://gmon.vn/curriculumvitae/view/{{ $cv->id }}"><img src="http://test.gmon.com.vn/?image={{ $cv->avatarCv }}" class="img-responsive" alt="http://test.gmon.com.vn/?image={{ $cv->avatarCv }}" style="width: 100%; border:3px solid #eee; border-radius:50%;"></a></div>
			@else
			<div style="width: 15%; float: left;"><a href="http://gmon.vn/curriculumvitae/view/{{ $cv->id }}"><img src="http://test.gmon.com.vn/?image={{ $cv->avatarU }}" class="img-responsive" alt="http://test.gmon.com.vn/?image={{ $cv->avatarU }}" style="width: 100%; border:3px solid #eee; border-radius:50%;"></a></div>
			@endif
			<div style="width: 82%; float: left; margin-left: 3%;">
			<div style="font-size: 26px; font-weight: bold; color:#ff00a3; margin-bottom: 5px;"><a href="http://gmon.vn/curriculumvitae/view/{{ $cv->id }}" style="text-decoration: none; color:#ff00a3;">{{ $cv->username }}</span></a></div>
			<div style="">Ngày sinh: {{ $cv->birthday }}</div>
			<div style="">Địa chỉ: {{ $cv->district }}, {{ $cv->city }}</div>
			<div style="">Công việc mong muốn: {{ $cv->jobs }}</div>
			<div style="">Mức lương mong muốn: <span style="font-size:20px; font-weight: bold; color:red;">{{ $cv->salary }}</span></div>
			<div style="">Chi tiết tại: <a href="http://gmon.vn/curriculumvitae/view/{{ $cv->id }}">http://gmon.vn/curriculumvitae/view/{{ $cv->id }}</a></div>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div style="margin: -4px; padding: 16px; font-size: 16px; line-height: 25px;" class="cv-component">
			Cùng hàng ngàn ứng viên khác chỉ có tại <a href="http://gmon.vn">http://gmon.vn</a>
			<div style="clear:both;"></div>
		</div>
	</div>
</body>
</html>