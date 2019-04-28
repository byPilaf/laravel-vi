@include('admin.header')
<title>文章类别管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文章管理 <span class="c-gray en">&gt;</span> 文章类别管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加文章类别','{{route('admin_articleType_add')}}','500','200')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加文章类别</a></span> <span class="r">共有数据：<strong>{{ $data -> count()}}</strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="8">文章类别</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="200">文章类别</th>
				<th width="200">上级类别</th>
				<th width="200">是否作为导航显示</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $val)
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>{{ $val -> id }}</td>
				<td>{{ $val -> typename }}</td>
				<td>{{ $val -> parentType["typename"] }}</td>
				<td>{{ $val -> display }}</td>
				<td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('编辑类别','{{ route('admin_articleType_edit') }}','{{ $val -> id }}','','480')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,'{{ $val -> id }}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript">
$(function(){
	//datatables初始化
	$('table').DataTable({
		"columnDefs" : [{"orderable": false,"targets":0}],
		"order": [[1,"asc"]]
	});
});
/*管理员-文章类别-添加*/
function admin_permission_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-文章类别-编辑*/
function admin_permission_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*管理员-文章类别-删除*/
function admin_permission_del(obj,id){
	layer.confirm('文章类别删除须谨慎，确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{ route("admin_articleType_delete") }}',
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