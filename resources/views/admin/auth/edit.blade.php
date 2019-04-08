@include('admin.header')
<title>添加权限 - 权限管理</title>
</head>
<body>
<article class="page-container">
	@foreach($data as $val)
	<form class="form form-horizontal" action="" method="post" id="form-admin-add">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{ $val -> authname }}" placeholder="" id="authname" name="authname">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>控制器名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{ $val -> controller }}" id="controller" name="controller">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">方法名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" id="action" name="action" value="{{ $val -> action }}">
		</div>
  </div>
  <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>父级权限：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="pid" size="1">
				
				<option value="0" @if($val -> pid == 0) selected="selected" @endif>作为顶级权限</option>
				@foreach($parents as $nameval)
				<option @if($val -> pid == $nameval -> id) selected="selected" @endif value="{{ $nameval -> id }}">{{ $nameval -> authname }}</option>
				@endforeach
			</select>
			</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>作为导航：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="is_nav" type="radio" id="is_nav-1" value="1" @if($val -> is_nav == "1") checked @endif>
				<label for="is_nav-1" value="1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="is_nav-2" name="is_nav" value="2" @if($val -> is_nav == "2") checked @endif>
				<label for="is_nav-2" value="2">否</label>
			</div>
		</div>
	</div>
	<!-- <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)"></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div> -->
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
			authname:{
				required:true,
			},
			controller:{
				required:true,
			},
			is_nav:{
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