<!DOCTYPE html>
<html lang="ja" id="search">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="{{$skindir}}css/mono_dev.css">
	<link rel="stylesheet" href="{{$skindir}}css/mono_dark.css" id="css1" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_deep.css" id="css2" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_mayo.css" id="css3" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_main.css" id="css4" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_reita.css" id="css5" disabled>

	<script>
		var colorIdx = GetCookie("_monodev_colorIdx");
		switch (Number(colorIdx)) {
			case 1:
				document.getElementById("css1").removeAttribute("disabled");
				break;
			case 2:
				document.getElementById("css2").removeAttribute("disabled");
				break;
			case 3:
				document.getElementById("css3").removeAttribute("disabled");
				break;
			case 4:
				document.getElementById("css4").removeAttribute("disabled");
				break;
			case 5:
				document.getElementById("css5").removeAttribute("disabled");
				break;
		}

		function SetCss(obj) {
			var idx = obj.selectedIndex;
			SetCookie("_monodev_colorIdx", idx);
			window.location.reload();
		}

		function GetCookie(key) {
			var tmp = document.cookie + ";";
			var tmp1 = tmp.indexOf(key, 0);
			if (tmp1 != -1) {
				tmp = tmp.substring(tmp1, tmp.length);
				var start = tmp.indexOf("=", 0) + 1;
				var end = tmp.indexOf(";", start);
				return (decodeURIComponent(tmp.substring(start, end)));
			}
			return ("");
		}

		function SetCookie(key, val) {
			document.cookie = key + "=" + encodeURIComponent(val) + ";max-age=31536000;";
		}
	</script>
	@if(!$imgsearch)
	<style>
		.article {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			padding: 3px 0;
			border-bottom: 1px dashed #8a8a8a;
			line-height: 3em;
		}

		img {
			max-width: 300px;
			margin: 12px 0 0;
		}
	</style>
	@endif
	<title>{{$title}}{{$pageno}}</title>
</head>

<body>
	<div id="main">
		<div class="title">
			<h1>{{$h1}}<span class="title_wrap">{{$img_or_com}}{{$pageno}}</span></h1>
		</div>
		<nav>
			<div class="menu">
				[<a href="./@if($php_self2){{$php_self2}} @endif">掲示板にもどる</a>]
				@if($imgsearch)
				[<a href="?page=1&imgsearch=off{{$query_l}}">コメント</a>]
				@else
				[<a href="?page=1&imgsearch=on{{$query_l}}">イラスト</a>]
				@endif


			</div>
		</nav>
		<p></p>
		<form method="get" action="./search.php">
			<span class="radio">
				<input type="radio" name="radio" id="author" value="1" {{$radio_chk1}}><label for="author"
					class="label">名前</label>
				<input type="radio" name="radio" id="exact" value="2" {{$radio_chk2}}><label for="exact"
					class="label">完全一致</label>
				<input type="radio" name="radio" id="fulltext" value="3" {{$radio_chk3}}><label for="fulltext"
					class="label">本文題名</label>
			</span>
			<br>
			@if($imgsearch)
			<input type="hidden" name="imgsearch" value="on">
			@else
			<input type="hidden" name="imgsearch" value="off">
			@endif
			<input type="text" name="query" placeholder="検索" value="{{$query}}">
			<input type="submit" value="検索" />
		</form>
		<p></p>
		<!-- 反復 -->
		@if($comments)
		@if($imgsearch)
		<div class="newimg">
			<ul>@foreach ($comments as $comment)<li class="catalog"><a href="{{$comment['link']}}" target="_blank"><img
							src="{{$comment['img']}}"
							alt="「{{$comment['sub']}}」イラスト/{{$comment['name']}}{{$comment['postedtime']}}"
							title="「{{$comment['sub']}}」by {{$comment['name']}} {{$comment['postedtime']}}"
							loading="lazy"></a></li>@endforeach</ul>

		</div>
		@else
		@foreach ($comments as $comment)
		<div>
			<div class="article">
				<div class="comments_title_wrap">
					<h2><a href="{{$comment['link']}}" target="_blank">{{$comment['sub']}}</a></h2>
					{{$comment['postedtime']}}<br><span class="name"><a
							href="?page=1&query={{$comment['encoded_name']}}&radio=2"
							target="_blank">{{$comment['name']}}</a></span>
				</div>
				@if ($comment['img'])
				<a href="{{$comment['link']}}" target="_blank"><img src="{{$comment['img']}}"
						alt="{{$comment['sub']}} by {{$comment['name']}}" loading="lazy"></a><br>
				@endif
				{{$comment['com']}}
				<div class="res_button_wrap">
					<form action="{{$comment['link']}}" method="post" target="_blank"><input type="submit" value="返信"
							class="res_button"></form><span class="page_top"><a href="#top">△</a></span>
				</div>
			</div>
		</div>
		@endforeach
		@endif
		@endif
		<p></p>

		<!-- 最終更新日時 -->
		@if($lastmodified)
		<p>last modified: {{$lastmodified}}</p>
		@endif
		<p>掲示板から新規投稿順に{{$img_or_com}}を呼び出しています。</p>

		<footer>
			<nav>
				<div class="leftbox">
					<!-- ページング -->
					{!!$prev!!}@if($nxet) | {!!$nxet!!} @endif
				</div>
				<!-- 著作表示 消さないでください -->
				<div class="rightbox">- <a href="https://paintbbs.sakura.ne.jp/poti/"
						target="_blank">search</a> -</div>
				<div class="clear"></div>
			</nav>
		</footer>

	</div>
</body>

</html>