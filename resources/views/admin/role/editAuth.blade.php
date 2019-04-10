@include('admin.header')
<title>新建角色 - 管理员管理</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$data -> rolename}}" disabled="disabled" placeholder="" id="rolename" name="rolename">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$data -> description}}" disabled="disabled" placeholder="" id="description" name="description">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站角色：</label>
			<div class="formControls col-xs-8 col-sm-9">
				@foreach($topAuth as $val)
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="{{$val -> id}}" name="auth_id[]" @foreach($data -> auths as $value) @if($value['id'] == $val -> id) checked @endif @endforeach>
							{{$val -> authname}}</label>
					</dt>
					<dd>
						
						<dl class="cl permission-list2">
							@foreach($val -> childAuth as $child)
							<dt>
								<label class="">
									<input type="checkbox" value="{{$child -> id}}" name="auth_id[]" @foreach($data -> auths as $value) @if($value['id'] == $child -> id) checked @endif @endforeach>
									{{$child -> authname}}</label>
							</dt>
							@endforeach							
						</dl>
					</dd>
				</dl>
				@endforeach
			</div>
		</div>
		{{csrf_field()}}
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
	
	$("#form-admin-role-add").validate({
		rules:{
			rolename:{
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
					// alert(json.errors.username);
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