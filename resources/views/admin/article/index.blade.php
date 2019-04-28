@include('admin.header')
<title>文章列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文章管理 <span class="c-gray en">&gt;</span> 文章列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
	 <span class="select-box inline">
		<select name="" class="select">
			<option value="0">全部分类</option>
			<option value="1">分类一</option>
			<option value="2">分类二</option>
		</select>
		</span> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" name="" id="" placeholder="文章名称" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜文章</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" data-title="添加文章" onclick="article_add('添加文章','{{route('admin_article_add')}}','','610')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加文章</a></span> <span class="r">共有数据：<strong>{{$data->count()}}</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="20">ID</th>
					<th width="50">排序值</th>
					<th>标题</th>
					<th>作者</th>
					<th width="75">分类</th>
					<th width="50">浏览次数</th>
					<th width="50">收藏数</th>
					<th width="50">评论数</th>
					<th width="120">创建时间</th>
					<th width="60">发布状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<tr class="text-c">
					@foreach($data as $val)
					<td><input type="checkbox" value="" name=""></td>
					<td>{{$val -> id}}</td>
					<td>{{$val->article_sort}}</td>
					<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_show('查看文章','{{route('admin_article_page')}}','{{$val -> id}}')" title="查看文章">{{$val->title}}</u></td>
					<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_show('查看作者','{{route('admin_user_page')}}','{{$val -> author_id}}')" title="查看作者">{{$val->rel_author->name}}</u></td>
					<td>{{$val->rel_type->typename}}</td>
					<td>{{$val->read_num}}</td>
					<td>{{$val->favorites_num}}</td>
					<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_show('查看评论','{{route('admin_comment_page')}}','{{$val -> id}}')" title="查看评论">{{$val->rel_comment->count()}}</u></td>
					<td>{{$val->created_at}}</td>
					<td class="td-status">
					@switch($val->article_status)
						@case('1')
							<span class="label radius">已下架</span>
							@break
						@case('2')
							<span class="label label-success radius">已发布</span>
							@break
						@case('3')
							<span class="label label-primary radius">待审核</span>
							@break
						@case('4')
							<span class="label label-danger radius">审核未通过</span>
							@break
					@endswitch
					</td>
					<td class="f-14 td-manage">
						@switch($val->article_status)
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
							@case('4')
								<a style="text-decoration:none" onClick="article_shenhe(this,'{{$val -> id}}')" href="javascript:;" title="审核">
								<i class="Hui-iconfont">&#xe637;</i></a>
								@break
						@endswitch
						<a style="text-decoration:none" class="ml-5" onClick="article_edit('文章编辑','{{route('admin_article_edit')}}','{{$val -> id}}')" href="javascript:;" title="编辑">
							<i class="Hui-iconfont">&#xe6df;</i>
						</a>
						<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'{{$val -> id}}')" href="javascript:;" title="删除">
							<i class="Hui-iconfont">&#xe6e2;</i>
						</a>
					</td>
					@endforeach
				</tr>
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
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"pading":false,
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,11]}// 不参与排序的列
	]
});

/*文章-查看*/
function article_show(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*文章-添加*/
function article_add(title,url,w,h){
	layer_show(title,url,w,h);
}

/*文章-编辑*/
function article_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*文章-停用*/
function article_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type:'POST',
			url:'{{ route("admin_article_stop") }}',
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

/*文章-启用*/
function article_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type:'POST',
			url:'{{ route("admin_article_start") }}',
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

/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$.ajax({
			type: 'POST',
			url: '{{ route("admin_article_start") }}',
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
				url: '{{ route("admin_article_notpass") }}',
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

/*文章-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{ route("admin_article_delete") }}',
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