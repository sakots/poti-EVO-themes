<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{$skindir}}css/mono_dev.css">
		<link rel="stylesheet" href="{{$skindir}}css/mono_dark.css" id="css1" disabled>
		<link rel="stylesheet" href="{{$skindir}}css/mono_deep.css" id="css2" disabled>
		<link rel="stylesheet" href="{{$skindir}}css/mono_mayo.css" id="css3" disabled>
		<link rel="stylesheet" href="{{$skindir}}css/mono_main.css" id="css4" disabled>
		<link rel="stylesheet" href="{{$skindir}}css/mono_reita.css" id="css5" disabled>
			<style>.input_disp_none{display: none;}</style>	
		
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
			function GetCookie(key){
				var tmp = document.cookie + ";";
				var tmp1 = tmp.indexOf(key, 0);
				if(tmp1 != -1){
					tmp = tmp.substring(tmp1, tmp.length);
					var start = tmp.indexOf("=", 0) + 1;
					var end = tmp.indexOf(";", start);
					return(decodeURIComponent(tmp.substring(start,end)));
					}
				return("");
			}
			function SetCookie(key, val){
				document.cookie = key + "=" + encodeURIComponent(val) + ";max-age=31536000;";
			}
		</script>

		@if($paint_mode)
		@if($pinchin)
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		@else 
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
		@endif
		@endif
		@if($pch_mode)<meta name="viewport" content="width=device-width">@endif
		@if($continue_mode)<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">@endif
		@if($useneo)
		<link rel="stylesheet" href="neo.css?{{$parameter_day}}" type="text/css">
		<script src="neo.js?{{$parameter_day}}" charset="UTF-8"></script>
		<script>
			function fixneo() {
		
				if(screen.width>767){//iPad以上の横幅の時は、NEOの網目のところでtouchmoveしない。
					console.log(screen.width);
					document.querySelector('#NEO').addEventListener('touchmove', function (e){
						e.preventDefault();
						e.stopPropagation();
					}, { passive: false });
				}
			}
			window.addEventListener('DOMContentLoaded',fixneo,false);
		</script>
		@endif
		@if($pch_mode)
		@if($type_neo)
		<link rel="stylesheet" href="neo.css?{{$parameter_day}}" type="text/css">
		<script src="neo.js?{{$parameter_day}}" charset="UTF-8"></script>
		@endif
		@endif
		@if($chickenpaint)
		<style>
		:not(input),div#chickenpaint-parent :not(input){
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		</style>
		
		<script>
		function fixchicken() {
			document.addEventListener('dblclick', function(e){ e.preventDefault()}, { passive: false });
			const chicken=document.querySelector('#chickenpaint-parent');
			chicken.addEventListener('contextmenu', function (e){
				e.preventDefault();
				e.stopPropagation();
			}, { passive: false });
		}
		window.addEventListener('DOMContentLoaded',fixchicken,false);
		</script>
		

<script src="chickenpaint/js/chickenpaint.min.js?{{$parameter_day}}"></script>
<link rel="stylesheet" type="text/css" href="chickenpaint/css/chickenpaint.css?{{$parameter_day}}">

		@else 
		{{-- <!-- Javaが使えるかどうか判定 使えなければcheerpJをロード --> --}}
		<script>
			function cheerpJLoad() {
			var jEnabled = navigator.javaEnabled();
			if(!jEnabled){
				var sN = document.createElement("script");
				sN.src = "{{$cheerpj_url}}";
				var s0 = document.getElementsByTagName("script")[0];
				s0.parentNode.insertBefore(sN, s0);
				sN.addEventListener("load", function(){ cheerpjInit(); }, false);
				}
			}
			window.addEventListener("load", function() { cheerpJLoad(); }, false);
		</script>

	@endif
	@if($paint_mode)
	<style>body{overscroll-behavior-x: none !important; }</style>
	@endif

		<title>{{$title}}</title>
		<style id="for_mobile"></style>
		<script>
			function is_mobile() {
			if (navigator.maxTouchPoints && ( window.matchMedia && window.matchMedia('(max-width: 768px)').matches))  return true;
			return false;
			}
			if(is_mobile()){
				document.getElementById("for_mobile").textContent=".for_pc{display: none;}";
			}
			</script>

	</head>
	<body id="paintmode">
		
		
		@if(!$chickenpaint)
		<header>
			<h1><a href="{{$self2}}">{{$title}}</a></h1>
			<div>
				<a href="{{$home}}" target="_top">[ホーム]</a>
				<a href="{{$self}}?mode=admin">[管理モード]</a>
			</div>
			<hr>
			<div>
				<p class="menu">
					<a href="{{$self2}}">[もどる]</a>
				</p>
			</div>
			<hr>
			@if($paint_mode)
			<h2 class="oekaki">OEKAKI MODE</h2>
			@endif
			@if($continue_mode)
			<h2 class="oekaki">CONTINUE MODE</h2>
			@endif
		</header>
		@endif

		<main>
			@if($paint_mode)

		@if($chickenpaint)

		<div id="chickenpaint-parent"></div>
		<p></p>
		
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				new ChickenPaint({
					uiElem: document.getElementById("chickenpaint-parent"),
					canvasWidth: {{$picw}},
				canvasHeight: {{$pich}},
			
				@if($imgfile) loadImageUrl: "{{$imgfile}}",@endif
				@if($img_chi) loadChibiFileUrl: "{{$img_chi}}",@endif
				saveUrl: "save.php?usercode={!!$usercode!!}",
				postUrl: "?mode={!!$mode!!}&stime={{$stime}}",
				exitUrl: "?mode={!!$mode!!}&stime={{$stime}}",
			
					allowDownload: true,
					resourcesRoot: "chickenpaint/",
					disableBootstrapAPI: true,
					fullScreenMode: "auto"
				});
			})
			</script>
			@else 
			{{-- <!-- (========== PAINT MODE(お絵かきモード) start ==========) --> --}}
			<script>
				var DynamicColor = 1;	// パレットリストに色表示
				var Palettes = new Array();
				<!--パレット配列作成-->
				@if($palettes) 
				{!!$palettes!!}
				@endif
				function setPalette(){d=document;d.paintbbs.setColors(Palettes[d.Palette.select.selectedIndex]);d.grad.view.checked&&GetPalette()}function PaletteSave(){Palettes[0]=String(document.paintbbs.getColors())}var cutomP=0;
				function PaletteNew(){d=document;p=String(d.paintbbs.getColors());s=d.Palette.select;Palettes[s.length]=p;cutomP++;str=prompt("パレット名","パレット "+cutomP);null==str||""==str?cutomP--:(s.options[s.length]=new Option(str),30>s.length&&(s.size=s.length),PaletteListSetColor())}function PaletteRenew(){d=document;Palettes[d.Palette.select.selectedIndex]=String(d.paintbbs.getColors());PaletteListSetColor()}
				function PaletteDel(){p=Palettes.length;s=document.Palette.select;i=s.selectedIndex;if(-1!=i&&(flag=confirm("「"+s.options[i].text + "」を削除してよろしいですか？"))){for(s.options[i]=null;p>i;)Palettes[i]=Palettes[i+1],i++;30>s.length&&(s.size=s.length)}}
				function P_Effect(a){a=parseInt(a);x=1;255==a&&(x=-1);d=document.paintbbs;p=String(d.getColors()).split("\n");l=p.length;var f="";for(n=0;l>n;n++)R=a+parseInt("0x"+p[n].substr(1,2))*x,G=a+parseInt("0x"+p[n].substr(3,2))*x,B=a+parseInt("0x"+p[n].substr(5,2))*x,255<R?R=255:0>R&&(R=0),255<G?G=255:0>G&&(G=0),255<B?B=255:0>B&&(B=0),f+="#"+Hex(R)+Hex(G)+Hex(B)+"\n";d.setColors(f);PaletteListSetColor()}
				function PaletteMatrixGet(){d=document.Palette;p=Palettes.length;s=d.select;m=d.m_m.selectedIndex;t=d.setr;switch(m){default:t.value="";for(c=n=0;p>n;)null!=s.options[n]&&(t.value=t.value+"\n!"+s.options[n].text+"\n"+Palettes[n],c++),n++;alert("パレット数："+c+"\nパレットマトリクスを取得しました");break;case 1:t.value="!Palette\n"+String(document.paintbbs.getColors())
				alert("現在使用されているパレット情報を取得しました")}t.value=
				t.value.trim()+"\n!Matrix"}
				function PalleteMatrixSet(){m=document.Palette.m_m.selectedIndex;str="パレットマトリクスをセットします。";switch(m){default:flag=confirm(str+"\n現在の全パレット情報は失われますがよろしいですか？");break;case 1:flag=confirm(str+"\n現在使用しているパレットと置き換えますがよろしいですか？");break;
				case 2:flag=confirm(str+"\n現在のパレット情報に追加しますがよろしいですか？")}flag&&(PaletteSet(),s.size=30>s.length?s.length:30,DynamicColor&&PaletteListSetColor())}
				function PalleteMatrixHelp(){alert("★PALETTE MATRIX\nパレットマトリクスとはパレット情報を列挙したテキストを用いる事により\n自由なパレット設定を使用する事が出来ます。\n\n□マトリクスの取得\n1)「取得」ボタンよりパレットマトリクスを取得します。\n2)取得された情報が下のテキストエリアに出ます、これを全てコピーします。\n3)このマトリクス情報をテキストとしてファイルに保存しておくなりしましょう。\n\n□マトリクスのセット\n1）コピーしたマトリクスを下のテキストエリアに貼り付け(ペースト)します。\n2)ファイルに保存してある場合は、それをコピーし貼り付けます。\n3)「セット」ボタンを押せば保存されたパレットが使用できます。\n\n余分な情報があるとパレットが正しくセットされませんのでご注意下さい。")}
				function PaletteSet(){d=document.Palette;se=d.setr.value;s=d.select;m=d.m_m.selectedIndex;l=se.length;if(1>l)alert("マトリクス情報がありません。");else{e=o=n=0;switch(m){default:for(n=s.length;0<n;)n--,s.options[n]=null;case 2:i=s.options.length;n=se.indexOf("!",0)+1;if(0==n)return;Matrix1=1;for(Matrix2=-1;n<l;){e=se.indexOf("\n#",n);if(-1==e)return;pn=se.substring(n,e+Matrix1);o=se.indexOf("!",e);if(-1==o)return;pa=se.substring(e+1,o+Matrix2);
				"Palette"!=pn?(0<=i&&(s.options[i]=new Option(pn)),Palettes[i]=pa,i++):document.paintbbs.setColors(pa);n=o+1}break;case 1:n=se.indexOf("!",0)+1;if(0==n)return;e=se.indexOf("\n#",n);o=se.indexOf("!",e);0<=e&&(pa=se.substring(e+1,o-1));document.paintbbs.setColors(pa)}PaletteListSetColor()}}function PaletteListSetColor(){var a=document.Palette.select;for(i=1;a.options.length>i;i++){var f=Palettes[i].split("\n");a.options[i].style.background=f[4];a.options[i].style.color=GetBright(f[4])}}
				function GetBright(a){r=parseInt("0x"+a.substr(1,2));g=parseInt("0x"+a.substr(3,2));b=parseInt("0x"+a.substr(5,2));a=r>=g?r>=b?r:b:g>=b?g:b;return 128>a?"#FFFFFF":"#000000"}function Chenge_(){var a=document.grad.pst.value,f=document.grad.ped.value;isNaN(parseInt("0x"+a))||isNaN(parseInt("0x"+f))||GradView("#"+a,"#"+f)}
				function ChengeGrad(){var a=document,f=a.grad.pst.value,h=a.grad.ped.value;Chenge_();var u=parseInt("0x"+f.substr(0,2)),v=parseInt("0x"+f.substr(2,2));f=parseInt("0x"+f.substr(4,2));var k=parseInt((u-parseInt("0x"+h.substr(0,2)))/15),q=parseInt((v-parseInt("0x"+h.substr(2,2)))/15);h=parseInt((f-parseInt("0x"+h.substr(4,2)))/15);isNaN(k)&&(k=1);isNaN(q)&&(q=1);isNaN(h)&&(h=1);var w=new String;cnt=0;m1=u;m2=v;for(m3=f;14>cnt;cnt++,m1-=k,m2-=q,m3-=h){if(255<m1||0>m1)k*=-1,m1-=k;if(255<m2||0>m2)q*=-1,
				m2-=q;if(255<m3||0>m3)h*=-1,m2-=h;w+="#"+Hex(m1)+Hex(m2)+Hex(m3)+"\n"}a.paintbbs.setColors(w)}function Hex(a){a=parseInt(a);0>a&&(a*=-1);for(var f=new String,h;16<a;)h=a,16<a&&(a=parseInt(a/16),h-=16*a),h=Hex_(h),f=h+f;h=Hex_(a);for(f=h+f;2>f.length;)f="0"+f;return f}function Hex_(a){isNaN(a)?a="":10==a?a="A":11==a?a="B":12==a?a="C":13==a?a="D":14==a?a="E":15==a&&(a="F");return a}
				function GetPalette(){d=document;p=String(d.paintbbs.getColors());"null"!=p&&""!=p&&(ps=p.split("\n"),st=d.grad.p_st.selectedIndex,ed=d.grad.p_ed.selectedIndex,d.grad.pst.value=ps[st].substr(1.6),d.grad.ped.value=ps[ed].substr(1.6),GradSelC(),GradView(ps[st],ps[ed]),PaletteListSetColor())}
				function GradSelC(){if(d.grad.view.checked){d=document.grad;l=ps.length;pe="";for(n=0;l>n;n++)R=255+-1*parseInt("0x"+ps[n].substr(1,2)),G=255+-1*parseInt("0x"+ps[n].substr(3,2)),B=255+-1*parseInt("0x"+ps[n].substr(5,2)),255<R?R=255:0>R&&(R=0),255<G?G=255:0>G&&(G=0),255<B?B=255:0>B&&(B=0),pe+="#"+Hex(R)+Hex(G)+Hex(B)+"\n";pe=pe.split("\n");for(n=0;l>n;n++)d.p_st.options[n].style.background=ps[n],d.p_st.options[n].style.color=pe[n],d.p_ed.options[n].style.background=ps[n],d.p_ed.options[n].style.color=pe[n]}}function GradView(a,f){d=document}function showHideLayer(){d=document;var a=d.layers?d.layers.psft:d.all("psft").style;d.grad.view.checked||(a.visibility="hidden");d.grad.view.checked&&(a.visibility="visible",GetPalette())};
			</script>
			<noscript>
				<p>JavaScriptが有効でないため正常に動作致しません。</p>
			</noscript>
		
						<div id="appstage">
							<div class="app">
			

					@if($paintbbs)
					@if($useneo)
					<applet-dummy code="pbbs.PaintBBS.class" archive="./PaintBBS.jar" name="paintbbs" width="{{$w}}" height="{{$h}}" mayscript>
						<param name="neo_confirm_unload" value="true">
						<param name="neo_show_right_button" value="true">
					@else 
					<applet code="pbbs.PaintBBS.class" archive="./PaintBBS.jar" name="paintbbs" width="{{$w}}" height="{{$h}}" mayscript>
					@endif
					@endif
					<!--(========== しぃペインター個別設定 ==========)-->
					@if($normal)
					<applet code="c.ShiPainter.class" archive="spainter_all.jar" name="paintbbs" WIDTH="{{$w}}" HEIGHT="{{$h}}" mayscript>
						<param name=dir_resource value="./">
						<param name="tt.zip" value="tt_def.zip">
						<param name="res.zip" value="res.zip">
						<!--(しぃペインターv1.05_9以前を使うなら res_normal.zip に変更)-->
						<param name=tools value="normal">
						<param name=layer_count value="{{$layer_count}}">
						@if($quality) 
						<param name=quality value="{{$quality}}">
						@endif
						@endif
						<!--(========== しぃペインターPro個別設定 ==========)-->
					@if($pro)
					<applet code="c.ShiPainter.class" archive="spainter_all.jar" name="paintbbs" width="{{$w}}" height="{{$h}}" mayscript>
						<param name=dir_resource value="./">
						<param name="tt.zip" value="tt_def.zip">
						<param name="res.zip" value="res.zip"><!--(しぃペインターv1.05_9以前を使うなら res_pro.	zip に変更)-->
						<param name=tools value="pro">
						<param name=layer_count value="{{$layer_count}}">
						@if($quality) 
						<param name=quality value="{{$quality}}">
						@endif
						@endif
						<!--(========== 共通設定(変更不可) ==========)-->
						<param name="image_width" value="{{$picw}}">
						<param name="image_height" value="{{$pich}}">
						<param name="image_jpeg" value="{{$image_jpeg}}">
						<param name="image_size" value="{{$image_size}}">
						<param name="compress_level" value="{{$compress_level}}">
						<param name="undo" value="{{$undo}}">
						<param name="undo_in_mg" value="{{$undo_in_mg}}">
						<param name="url_save" value="picpost.php">
						<param name="url_exit" value="{{$self}}?mode={{$mode}}&amp;stime={{$stime}}">
						@if($anime)
						<param name="thumbnail_type" value="animation">
						@endif
						@if($pchfile)
						<param name="pch_file" value="{{$pchfile}}">
						@endif
						@if($imgfile)
						<param name="image_canvas" value="{{$imgfile}}">
						@endif
						<param name="send_header" value="usercode={{$usercode}}">
						<param name="poo" value="false">
						<param name="send_advance" value="true">
						<param name="thumbnail_width" value="100%">
						<param name="thumbnail_height" value="100%">
						<param name="tool_advance" value="true">
						@if($security)
						@if($security_click)
						<param name="security_click" value="{{$security_click}}">
						@endif
						@if($security_timer)
						<param name="security_timer" value="{{$security_timer}}">
						@endif
						<param name="security_url" value="{{$security_url}}">
						<param name="security_post" value="false">
						@endif
					@if($useneo)
					</applet-dummy>
					@else 
					</applet>
					@endif
				</div>
				<div class="palette">
					<form name="Palette">
						@if($useneo)
						<fieldset>
							<legend>TOOL</legend>
							<input class="button" type="button" value="左" onclick="Neo.setToolSide(true)">
							<input class="button" type="button" value="右" onclick="Neo.setToolSide(false)">
						</fieldset>
						@endif
						<fieldset>
							<legend>PALETTE</legend>
							<select class="form palette_select" name="select" size="13" onchange="setPalette()">
								<option>一時保存パレット</option>
								@if($dynp) 
								@foreach ($dynp as $p)
									<option>{{$p}}</option>
								@endforeach
								@endif
							</select><br>
							<input class="button" type="button" value="一時保存" onclick="PaletteSave()"><br>
							<input class="button" type="button" value="作成" onclick="PaletteNew()">
							<input class="button" type="button" value="変更" onclick="PaletteRenew()">
							<input class="button" type="button" value="削除" onclick="PaletteDel()"><br>
							<input class="button" type="button" value="明＋" onclick="P_Effect(10)">
							<input class="button" type="button" value="明－" onclick="P_Effect(-10)">
							<input class="button" type="button" value="反転" onclick="P_Effect(255)">
						</fieldset>
						<fieldset>
							<legend>MATRIX</legend>
							<select class="form" name="m_m">
								<option value="0">全体</option>
								<option value="1">現在</option>
								<option value="2">追加</option>
							</select>
							<input type="button" class="button" name="m_g" value="GET" onclick="PaletteMatrixGet()">
							<input type="button" class="button" name="m_h" value="SET" onclick="PalleteMatrixSet()">
							<input type="button" class="button" name="1" value=" ? " onclick="PalleteMatrixHelp()"><br>
							<textarea class="form" name="setr" rows="1" cols="13" onmouseover="this.select()"></textarea>
						</fieldset>
					</form>
					<form name="grad">
						<fieldset>
							<legend>GRADATION</legend>
							<input type="checkbox" name="view" onclick="showHideLayer()">
							<input type="button" class="button" value=" OK " onclick="ChengeGrad()"><br>
							<select class="form" name="p_st" onchange="GetPalette()">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
							</select>
							<input class="form" type="text" name="pst" size="8" onkeypress="Chenge_()" onchange="Chenge_()"><br>
							<select class="form" name="p_ed" onchange="GetPalette()">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option selected>12</option>
								<option>13</option>
								<option>14</option>
							</select>
							<input class="form" type="text" name="ped" size="8" onkeypress="Chenge_()" onchange="Chenge_()">
							<div id="psft"></div>
							<script>
								if(DynamicColor) PaletteListSetColor();
							</script>
						</fieldset>
						<p class="c">DynamicPalette &copy;NoraNeko</p>
					</form>
				</div>
			</div>
			@if($paint_mode)
			<section>
				<div class="thread">
					<hr>
					<div class="timeid">
						<form class="watch" action="index.html" name="watch">
							<p>
								PaintTime :
								<input type="text" size="24" name="count">
							</p>
							<script>
								timerID = 10;
								stime = new Date();
								function SetTimeCount() {
									now = new Date();
									s = Math.floor((now.getTime() - stime.getTime())/1000);
									disp = '';
									if(s >= 86400){
										d = Math.floor(s/86400);
										disp += d+"day ";
										s -= d*86400;
									}
									if(s >= 3600){
										h = Math.floor(s/3600);
										disp += h+"hr ";
										s -= h*3600;
									}
									if(s >= 60){
										m = Math.floor(s/60);
										disp += m+"min ";
										s -= m*60;
									}
									document.watch.count.value = disp+s+"sec";
									clearTimeout(timerID);
									timerID = setTimeout('SetTimeCount()',250);
								}
								SetTimeCount();
							</script>
						</form>
					<hr>
					</div>
				</div>
			</section>
			@endif
			<section>
				<div class="thread siihelp">
					<p>
						ミスしてページを変えたりウインドウを消してしまったりした場合は落ちついて同じキャンバスの幅で編集ページを開きなおしてみて下さい。大抵は残っています。
					</p>
					<h2>基本の動作(恐らくこれだけは覚えておいた方が良い機能)</h2>
						<h3>基本</h3>
							<p>
								PaintBBSでは右クリック、ctrl+クリック、alt+クリックは同じ動作をします。<br>
								基本的に操作は一回のクリックか右クリックで動作が完了します。(ベジエやコピー使用時を除く)
							</p>
						<h3>ツールバー</h3>
							<p>
								ツールバーの殆どのボタンは複数回クリックして機能を切り替える事が出来ます。<br>
								右クリックで逆周り。その他パレットの色、マスクの色、一時保存ツールに現在の状態を登録、レイヤー表示非表示切り替え等全て右クリックです。<br>
								逆にクリックでパレットの色と一時保存ツールに保存しておいた状態を取り出せます。
							</p>
						<h3>キャンバス部分</h3>
						<p>
							右クリックで色をスポイトします。<br>
							ベジエやコピー等の処理の途中で右クリックを押すとリセットします。
						</p>
					<h2>特殊動作(使う必要は無いが慣れれば便利な機能)</h2>
						<h3>ツールバー</h3>
							<p>
								値を変更するバーはドラッグ時バーの外に出した場合変化が緩やかになりますのでそれを利用して細かく変更する事が出来ます。パレットはShift+クリックで色をデフォルトの状態に戻します。
							</p>
						<h3>キーボードのショートカット</h3>
							<ul>
								<li>+で拡大-で縮小。</li>
								<li>Ctrl+ZかCtrl+Uで元に戻す、Ctrl+Alt+ZかCtrl+Yでやり直し。</li>
								<li>Escでコピーやベジエのリセット。（右クリックでも同じ） </li>
								<li>スペースキーを押しながらキャンバスをドラッグするとスクロールの自由移動。</li>
								<li>Ctrl+Alt+ドラッグで線の幅を変更。</li>
							</ul>
						<h3>コピーツールの特殊な利用方法</h3>
							<p>
								レイヤー間の移動は現時点ではコピーとレイヤー結合のみです。コピーでの移動方法は、まず移動したいレイヤー上の長方形を選択後、移動させたいレイヤーを選択後に通常のコピーの作業を続けます。そうする事によりレイヤー間の移動が可能になります。
							</p>
						<h2>ツールバーのボタンと特殊な機能の簡単な説明</h2>
							<dl>
								<dt>ペン先(通常ペン,水彩ペン,テキスト)</dt>
								<dd>
									メインのフリーライン系のペンとテキスト
								</dd>
								<dt>ペン先2(トーン,ぼかし,他)</dt>
								<dd>
									特殊な効果を出すフリーライン系のペン
								</dd>
								<dt>図形(円や長方形)</dt>
								<dd>
									長方形や円等の図形
								</dd>
								<dt>特殊(コピーやレイヤー結合,反転等)</dt>
								<dd>
									コピーは一度選択後、ドラッグして移動、コピーさせるツールです。
								</dd>
								<dt>マスクモード指定(通常,マスク,逆マスク）</dt>
								<dd>
									マスクで登録されている色を描写不可にします。逆マスクはその逆。<br>
									通常でマスク無し。また右クリックでマスクカラーの変更が可能。
								</dd>
								<dt>消しゴム(消しペン,消し四角,全消し)</dt>
								<dd>
									透過レイヤー上を白で塗り潰した場合、下のレイヤーが見えなくなりますので上位レイヤーの線を消す時にはこのツールで消す様にして下さい。<br>
									全消しはすべてを透過ピクセル化させるツールです。<br>
									全消しを利用する場合はこのツールを選択後キャンバスをクリックでOK。
								</dd>
								<dt>描写方法の指定。(手書き,直線,ベジエ曲線)</dt>
								<dd>
									ペン先,描写機能指定ではありません。<br>
									また適用されるのはフリーライン系のツールのみです。
								</dd>
								<dt>カラーパレット郡</dt>
								<dd>
									クリックで色取得。右クリックで色の登録。Shift+クリックでデフォルト値。
								</dd>
								<dt>RGBバーとalphaバー</dt>
								<dd>
									細かい色の変更と透過度の変更。Rは赤,Gは緑,Bは青,Aは透過度を指します。<br>
									トーンはAlphaバーで値を変更する事で密度の変更が可能です。
								</dd>
								<dt>線幅変更ツール</dt>
								<dd>
									水彩ペンを選択時に線幅を変更した時、デフォルトの値がalpha値に代入されます。
								</dd>
								<dt>線一時保存ツール</dt>
								<dd>
									クリックでデータ取得。右クリックでデータの登録。(マスク値は登録しません)
								</dd>
								<dt>レイヤーツール</dt>
								<dd>
									PaintBBSは透明なキャンバスを二枚重ねたような構造になっています。<br>
									つまり主線を上に書き、色を下に描くと言う事も可能になるツールです。<br>
									通常レイヤーと言う種類の物ですので鉛筆で描いたような線もキッチリ透過します。<br>
									クリックでレイヤー入れ替え。右クリックで選択されているレイヤーの表示、非表示切り替え。
								</dd>
							</dl>
						<h2>投稿に関して</h2>
							<p>
								絵が完成したら投稿ボタンで投稿します。絵の投稿が成功した場合は指定されたURLへジャンプします。失敗した場合は失敗したと報告するのみでどこにも飛びません。単に重かっただけである場合少し間を置いた後、再度投稿を試みて下さい。この際二重で投稿される場合があるかもしれませんが、それはWebサーバーかCGI側の処理ですのであしからず。
							</p>
				</div>
			</section>
			<!-- (========== PAINT MODE(お絵かきモード) end ==========) -->
			@endif
			@endif
			@if($pch_mode)

			<!-- (========== 動画表示モード ==========) -->
			<div id="appstage">
				<div class="app">
					<div style="width:{{$w}}px; height:{{$h}}px">
					@if($paintbbs)
					@if($type_neo)
					<applet-dummy code="pch.PCHViewer.class" archive="PCHViewer.jar,PaintBBS.jar" name="pch" width="{{$w}}" height="{{$h}}" mayscript>
						@else 
					<applet code="pch.PCHViewer.class" archive="PCHViewer.jar,PaintBBS.jar" name="pch" width="{{$w}}" height="{{$h}}" mayscript>
					@endif
					@endif
					@if($normal)
					<applet name="pch" code="pch2.PCHViewer.class" archive="PCHViewer.jar,spainter_all.jar" codebase="./" width="{{$w}}" height="{{$h}}">
					@endif
						@if($normal)
						<param name="res.zip" value="res.zip"><!--(しぃペインターv1.05_9以前を使うなら res_normal.zip に変更)-->
						<param name="tt.zip" value="tt_def.zip">
						<param name="tt_size" value="31">
						@endif
						<param name="image_width" value="{{$picw}}">
						<param name="image_height" value="{{$pich}}">
						<param name="pch_file" value="{{$pchfile}}">
						<param name="speed" value="{{$speed}}">
						<param name="buffer_progress" value="false">
						<param name="buffer_canvas" value="false">
						@if($type_neo)
						</applet-dummy>
						@else 
						</applet>
						@endif
					</div>
					<p>
						<a href="{{$pchfile}}" target="_blank">Download</a> - Datasize : {{$datasize}} KB
					</p>
					<p>
						<a href="javascript:close()">閉じる</a>
					</p>
				</div>
			</div>
			<!-- (========== 動画表示モード ここまで ==========) -->
			@endif
			@if($continue_mode)
			<!-- (========== CONTINUE MODE(コンティニューモード) start ==========) -->
			<section>

			<script type="text/javascript" src="loadcookie.js"></script>
				<div class="thread">
					<figure>
						<img src="{{$picfile}}" width="{{$picw}}" height="{{$pich}}" alt="@if($sub){{$sub}} @endif @if($name) by {{$name}} @endif{{$picw}} x {{$pich}}" title="@if($sub){{$sub}} @endif @if($name) by {{$name}} @endif{{$picw}} x {{$pich}}">
						
						<figcaption>{{$picfile_name}}@if($painttime) PaintTime : {{$painttime}}@endif</figcaption>
					</figure>
					<hr class="hr">
						{{-- ダウンロード --}}
						@if($download_app_dat)
						<form action="{{$self}}" method="post">
								<input type="hidden" name="mode" value="download">
								<input type="hidden" name="no" value="{{$no}}">
								<input type="hidden" name="pch_ext" value="{{$pch_ext}}">
								<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
								Pass <input class="form" type="password" name="pwd" value="">
								<input class="button" type="submit" value="{{$pch_ext}}ファイルをダウンロード">
								</form>
							<hr class="hr">
						@endif	  
					<form action="{{$self}}" method="post">
						<input type="hidden" name="mode" value="contpaint">
						<input type="hidden" name="anime" value="true">
						<input type="hidden" name="picw" value="{{$picw}}">
						<input type="hidden" name="pich" value="{{$pich}}">
						<input type="hidden" name="no" value="{{$no}}">
						<input type="hidden" name="pch" value="{{$pch}}">
						<input type="hidden" name="ext" value="{{$ext}}">
						<select class="form" name="ctype">
							@if($ctype_pch)<option value="pch">from animation</option>@endif
							@if($ctype_img)<option value="img">from picture</option>@endif
						</select>
						<select class="form" name="type">
							<option value="rep">replace</option>
							<option value="new">newpost</option>
						</select>
						@if($select_app)

						<select name="shi">
							<option value="neo">PaintBBS NEO</option>
							@if($use_shi_painter)<option value="1" class="for_pc">しぃペインター</option>@endif
							@if($use_chickenpaint)<option value="chicken">ChickenPaint</option>@endif
							@if($use_klecks)<option value="klecks">Klecks</option>@endif
						</select>
						@endif
						@if($app_to_use)
						<input type="hidden" name="shi" value="{{$app_to_use}}">
						@endif

						@if($use_select_palettes)
							パレット：<select name="selected_palette_no" title="パレット" class="form">{!!$palette_select_tags!!}</select>
							@endif

						<span class="input_disp_none"><input type="text" value="" autocomplete="username"></span>
						Pass <input class="form" type="password" name="pwd" value="">
						<input class="button" type="submit" value="続きを描く">

					</form>
						
					<ul>
						@if($newpost_nopassword)
						<li>新規投稿なら削除キーがなくても続きを描く事ができます。</li>
						@else 
						<li>続きを描くには描いたときの削除キーが必要です。</li>
						@endif
					</ul>
				
				</div>
				<script type="text/javascript">
				l(); //LoadCookie
				</script>
			</section>
			<!-- (========== CONTINUE MODE(コンティニューモード) end ==========) -->
			@endif
		</main>
		<footer>
		{{-- <!-- 著作権表示 削除しないでください --> --}}
							@include('parts.monoev_copyright')

			</footer>
	</body>
</html>
