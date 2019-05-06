@include('admin.header')
<title>查看文章详情</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
	<dl style="color:#fff">
		<dt>
			<span class="f-18">{{$article -> title}}</span><br>
			<span class="pl-10 f-12">作者：{{$article->rel_author->name}}</span>
		</dt>
	</dl>
</div>
<div class="pd-20">
@if($article -> article_status === '4')
	<p style="font-weight:bold">审核未通过原因:</p>
	<p>{{$article -> reason}}</p>
	<p style="font-weight:bold">文章内容:</p>
@endif
{{$article -> article_content}}
</div>
@include('admin.footer')
<!--请在下方写此页面业务相关的脚本-->
</body>
</html>