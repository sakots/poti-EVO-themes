<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="{{$skindir}}css/mono_dev.css">
	<link rel="stylesheet" href="{{$skindir}}css/mono_dark.css" id="css1" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_deep.css" id="css2" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_mayo.css" id="css3" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_main.css" id="css4" disabled>
	<link rel="stylesheet" href="{{$skindir}}css/mono_reita.css" id="css5" disabled>
	<style>
		.input_disp_none {
			display: none;
		}
	</style>

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

	<title>{{$title}}</title>
</head>

<body>
	<header>
		<h1><a href="{{$self2}}">{{$title}}</a></h1>
		<div>
			<a href="{{$home}}" target="_top">[ホーム]</a>
			<a href="{{$self}}?mode=admin">[管理モード]</a>
		</div>
		<hr>
		<div>
			<nav class="menu">
				<a href="{{$self2}}">[トップ]</a>
				@if($for_new_post)
				<a href="{{$self}}?mode=newpost">[投稿]</a>
				@endif
				[カタログ]
				<a href="{{$self}}">[通常モード]</a>
				<a href="{{$self}}?mode=piccom">[投稿途中の絵]</a>
				<a href="#footer" title="一番下へ">[↓]</a>
			</nav>
			<hr>
			<h2><span class="oyano"></span>カタログモード</h2>
		</div>
	</header>
	<main>
		<div id="catalog">
			<hr>
			<div>
				@if(isset($oya) and !(empty($oya)))
				@foreach ($oya as $ress)
				@foreach ($ress as $res)
				<div>
					@if($res['imgsrc'])
					<p><a href="{{$self}}?res={{$res['no']}}" title="{{$res['sub']}} by {{$res['name']}}"><img
								src="{{$res['imgsrc']}}" alt="{{$res['sub']}} by {{$res['name']}}" width="{{$res['w']}}"
								@if($res['h']) height="{{$res['h']}}" @endif loading="lazy"></a></p>
					@endif
					@if($res['txt'])
					<p><a href="{{$self}}?res={{$res['no']}}"
							title="{{$res['sub']}} by {{$res['name']}}">{{$res['sub']}} by {{$res['name']}}</a></p>
					@endif
					<p>[{{$res['no']}}] {{$res['now']}}@if($res['updatemark']){{$res['updatemark']}}@endif
						@if($res['id']) ID:{{$res['id']}}@endif</p>
				</div>
				@endforeach @endforeach
				@endif

			</div>
			<hr>
		</div>
	</main>
	<footer id="footer">
		<div>
			{{-- 前、次のナビゲーション --}}
			@include('parts.monoev_prev_next')

			{{-- <!-- メンテナンスフォーム欄 --> --}}
			@include('parts.monoev_mainte_form')

			<script src="loadcookie.js"></script>
			<script>
				l(); //LoadCookie
			</script>
		</div>
		<!--著作権表示 削除しないでください-->
		@include('parts.monoev_copyright')
	</footer>
	<script>
		colorIdx = GetCookie('colorIdx');
		document.getElementById("mystyle").selectedIndex = colorIdx;
	</script>
</body>

</html>