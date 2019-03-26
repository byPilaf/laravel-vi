@include('admin.header')
<title>编辑管理员 - 管理员管理</title>
</head>
<body>
<article class="page-container">
	@foreach($data as $val)
	
	<form class="form form-horizontal" action="" method="post" id="form-admin-add">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员账号：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$val -> username}}" disabled="disabled" placeholder="" id="adminName" name="username">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="gender" type="radio" id="sex-1" @if($val -> gender == '男') checked @endif>
				<label for="sex-1" value="男">男</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2"  value="女" name="gender" @if($val -> gender == '女') checked @endif>
				<label for="sex-2" value="女">女</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-3" value="保密" name="gender" @if($val -> gender == '保密') checked @endif>
				<label for="sex-3" value="保密" >保密</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$val -> mobile}}" placeholder="" id="mobile" name="mobile">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="email" id="email" value="{{$val -> email}}">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">角色：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="role_id" size="1">
				@foreach($role as $a)
				<option @if($val -> role_id == $a -> id) selected="selected" @endif value="{{$a -> id}}">{{$a -> rolename}}</option>
				@endforeach
			</select>
			</span> </div>
	</div>
	{{csrf_field()}}
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
	
	@endforeach
</article>
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		rules:{
			adminName:{
				required:true,
				minlength:3,
				maxlength:20
			},
			password:{
				required:true,
				minlength:6,
			},
			password2:{
				required:true,
				minlength:6,
				equalTo: "#password"
			},
			gender:{
				required:true,
			},
			mobile:{
				required:true,
				isPhone:true,
			},
			email:{
				required:true,
				email:true,
			},
			role_id:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "" ,
				dataType:"json",
				success: function(data){
					//判断是否成功
					if(data.code == '0'){
						layer.msg(data.msg,{icon:1,time:1000},function(){
							var index = parent.layer.getFrameIndex(window.name);
							// parent.$('.btn-refresh').click();
							parent.location.href = parent.location.href;
							parent.layer.close(index);
						});
					}else{
						layer.msg(data.msg,{icon:2,time:1000});
					}
					
				},
                // error: function(XmlHttpRequest, textStatus, errorThrown){
                error: function(data){
					var json = JSON.parse(data.responseText);
					alert(json.errors.username);
					// layer.msg(json.errors.username);
				}
			});			
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>