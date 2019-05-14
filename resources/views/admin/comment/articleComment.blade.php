@include('admin.header')
<title>评论列表</title>
</head>
<body>
<div class="page-container">
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="20">ID</th>
					<th width="50">作者</th>
					<th width="50">点赞数</th>
					<th>评论内容</th>
					<th width="60">发布状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $val)
				<tr class="text-c">
					<td><input type="checkbox" value="" name=""></td>
					<td>{{$val->id}}</td>
					<td>{{$val->post_user->name}}</td>
					<td>{{$val->comment_like_number}}</td>
					<td>{{$val->comment_content}}</td>
					<td class="text-l">
					@if($val->comment_status === '2')
						<span class="label label-success radius">已启用</span>
					@elseif($val->comment_status === '3')
						<span class="label radius">被举报</span>
					@else
						<span class="label label-danger radius">已停用</span>
					@endif
					</td>
					
					<td class="f-14 td-manage">
						@switch($val->comment_status)
							@case('1')
								<a style="text-decoration:none" onClick="article_start(this,'{{$val -> id}}')" href="javascript:;" title="启用">
								<i class="Hui-iconfont">&#xe615;</i>
								@break
							@case('2')
								<a style="text-decoration:none" onClick="article_stop(this,'{{$val -> id}}')" href="javascript:;" title="下架">
								<i class="Hui-iconfont">&#xe631;</i>
								@break
							@case('3')
								<a style="text-decoration:none" onClick="article_shenhe(this,'{{$val -> id}}')" href="javascript:;" title="审核">
								<i class="Hui-iconfont">&#xe637;</i></a>
								@break
						@endswitch
						<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'{{$val -> id}}')" href="javascript:;" title="删除">
							<i class="Hui-iconfont">&#xe6e2;</i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"pading":false,
		"aoColumnDefs": [
		{"bVisible": false, "aTargets": [ 0 ]}, //控制列的隐藏显示
		{"orderable":false,"aTargets":[0,6]}// 不参与排序的列
		]
	});
});

/*评论-查看*/
function article_show(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*评论-添加*/
function article_add(title,url,w,h){
	layer_show(title,url,w,h);
}

/*评论-编辑*/
function article_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*评论-停用*/
function article_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type:'POST',
			url:'{{ route("admin_comment_stop") }}',
			data:{id:id,_token:"{{csrf_token()}}"},
			dataType:"json",
			success: function(data){
				if(data.code == '0')
				{
					layer.msg(data.msg,{icon:1,time:1000},function(){
						location.href = location.href;
					});
				}
				else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
			},
			error: function(){
				layer.msg('停用请求失败',{icon:2,time:1000});
			},
		});
	});
}

/*评论-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核评论？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$.ajax({
			type: 'POST',
			url: '{{ route("admin_comment_start") }}',
			data: {id:id,_token:"{{csrf_token()}}"},
			dataType: 'json',
			success: function(data){
				if(data.code == '0')
				{
					layer.msg(data.msg,{icon:1,time:1000},function(){
						location.href = location.href;
						// $(obj).parents("tr").remove();
					});
				}
				else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
		});	
	},
	function(){
		//prompt层
		layer.prompt({title: '审核未通过的原因:', formType: 2}, function(text, index){
			$.ajax({
				type: 'POST',
				url: '{{ route("admin_comment_stop") }}',
				data: {id:id,_token:"{{csrf_token()}}",reason:text},
				dataType: 'json',
				success: function(data){
					if(data.code == '0')
					{
						layer.msg(data.msg,{icon:1,time:1000},function(){
							location.href = location.href;
						});
					}
					else{
						layer.msg(data.msg,{icon:2,time:1000});
					}
				},
				error:function(data) {
					console.log(data.msg);
				},
			});
		});

			
	});	
}

/*评论-启用*/
function article_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type:'POST',
			url:'{{ route("admin_comment_start") }}',
			data:{id:id,_token:"{{csrf_token()}}"},
			dataType:"json",
			success: function(data){
				if(data.code == '0')
				{
					layer.msg(data.msg,{icon:1,time:1000},function(){
						location.href = location.href;
					});
				}
				else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
			},
			error: function(){
				layer.msg('启用请求失败',{icon:2,time:1000});
			},
		});
	});
}

/*评论-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{ route("admin_comment_delete") }}',
			data: {id:id,_token:"{{csrf_token()}}"},
			dataType: 'json',
			success: function(data){
				if(data.code == '0')
				{
					layer.msg(data.msg,{icon:1,time:1000},function(){
						location.href = location.href;
						// $(obj).parents("tr").remove();
					});
				}
				else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
				// $(obj).parents("tr").remove();
				// layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script> 
</body>
</html>