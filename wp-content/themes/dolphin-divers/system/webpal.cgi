#!/usr/bin/perl

use utf8;

$cgifile = "webpal.cgi";
require 'common.pl';

#
#　サイトコンテンツ管理CGI
#
$loginuser = "";

$webpalheader = << "HTML_VIEW";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>$webpalname</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td width=150><a href=$cgifile><img src=img/webpallogo.jpg valign=middle border="0"></a></td>
<td align=center><a href=$cgifile><font color="#666666">$webpalname</font></a></td>
<td width=150>　</td>
</tr>
<tr>
<td colspan=3>
<hr>
<center>
HTML_VIEW

$webpalfooter = << "HTML_VIEW";
</center>
</td></tr></table>
$webrightbar
</body>
</html>
HTML_VIEW
# -----------------------------------------------------------------
# ログイン管理
# -----------------------------------------------------------------
$id = $query->param('id');
$pw = $query->param('pw');
$code = $query->param('code');

$loginuser = &getcook($cookiename);

$flag = 0;
foreach  $key(keys %ID){
if($loginuser eq $key ){$flag = 1;last;}
}
if( $flag == 1 ){goto loginok;}
if( $flag == 0 && $code eq "" && $id eq "" ){goto logincheck;}
if( $flag == 0 && $code ne "" && $id ne "" ){goto logincheck2;}

if($loginuser eq "" && $code eq ""){
# ログイン処理
logincheck:
print "Content-type: text/html;\n\n";
print <<"HTML_VIEW";
$webpalheader
<a href=$cgifile><font size=+1><b>$cgititle</b></font></a>
<center>
<form name="login" method="post" action="$cgifile" enctype="multipart/form-data">
<input name=code value="login" type=hidden>
<table border=0 bgcolor="#c0e2c4" width=200>
<tr bgcolor="#59e156"><td colspan=2>ログインをお願いします</td></tr>
<tr><td>ID</td><td><input name=id type=text size=12></td></tr>
<tr><td>Password</td><td><input name=pw type=password size=12></td></tr>
<tr><td colspan=2 align=center><input type=submit value=ログイン style="width:100"></td></tr>
</table>
$footer
HTML_VIEW
exit;
}


logincheck2:
if( $ID{$id} eq $pw && $id ne "" && $pw ne ""){
&setcook($cookiename,$id);
$loginuser = $id;
$code = "";
}else{
#IDエラー
print "Content-type: text/html;\n\n";
print <<"HTML_VIEW";
$webpalheader
ログイン出来ません。<p>
ID・パスワードをお確かめの上、ログインして下さい。
<p>
<a href=$cgifile>再ログイン</a>
HTML_VIEW
$footer;
exit;
}

# -----------------------------------------------------------------
# クッキーにログインがあれば飛んでくる
loginok:

$webpalimg = << "HTML_VIEW";
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="text-12" align=center>
<tr>
<td width=75%>
<table width=100% border="0" cellspacing="0" cellpadding="0" class="text-12">
<tr>
<td width=1><a href=$cgifile><img src=img/webpallogo.jpg hspace=0 border="0" valign=middle></a></td>
<td align=center>$webpalname<p>
<font size="4"><b>「$sitetitle」</b></font>
</td>
</tr>
</table>
</td>
<td width=25%>
<table border="0" cellspacing="0" cellpadding="0" class="text-10" align=right>
<tr>
<td colspan=3>
<table border="0" cellspacing="0" cellpadding="0" class="text-10" width=100%>
<tr>
<td nowrap>■<a href=$sitefulladr target=_blank>サイトへ</a></td>
<td nowrap>□<a href=$cgifile?code=help>ヘルプ</a></td>
<td nowrap>■<a href=$cgifile?code=logout>ログアウト</a></td>
</tr>
</table>
</td>
</tr>
<tr>
<td nowrap colspan=2>□ログインユーザー</td><td nowrap>：[$IDNAME{$loginuser}]</td>
</tr>

<script>
function resetcheck(){
if (window.confirm("全てのデータを消去します。よろしいですか？")) {
if (window.confirm("本当によろしいですか？")) {location.href="$cgifile?code=masterreset";}
}
return false;
}
</script>
</table>
</td>
</tr>
</table><hr width=100%>
HTML_VIEW

#休日設定用：年
$y1 = $year + 1;
$y2 = $year + 2;
$y3 = $year + 3;
$y4 = $year + 4;
$holidaytyear =<<"HTML_END";
<select name="tyear">
<option value="$year" selected >$year\年</option>
<option value="$y1">$y1\年</option>
<option value="$y2">$y2\年</option>
<option value="$y3">$y3\年</option>
<option value="$y4">$y4\年</option>
</select>
HTML_END
# -----------------------------------------------------------------
# 分岐
# -----------------------------------------------------------------
$loginusercheck = $loginuser;
if( $code eq "logout"){&logout;}
print "Content-type: text/html;\n\n";

if( $code eq "help"){&helpdisp;}

#フォーマット部更新toiawase_ichiran
if( $code eq "newform"){&newform;exit;}
if( $code eq "holidayformadd"){&holidayformadd;exit;}
if( $code eq "formadd"){&formadd;exit;}
if( $code eq "editlist"){&editlist;exit;}
if( $code eq "editform"){&editform;exit;}
if( $code eq "deleterecord"){&deleterecord;exit;}
if( $code eq "deleteset"){&deleteset;exit;}


# -----------------------------------------------------------------
# HTML処理開始
# -----------------------------------------------------------------
print <<"HTML_VIEW";
$header
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td>
$webpalimg



<table width="80%" border="0" align="center" cellpadding="2" cellspacing="1" class="text-12" bgcolor="#cccccc">


<tr valign="top">
<td bgcolor="#ffffff" nowrap width=30% >
$CONTENTSNAME[0]
</td>
<td bgcolor="#ffffff">
<form action="$cgifile" method="post" enctype="multipart/form-data" name="form2" id="form2">
<input name="contents0" type="button" id="contents0" value="新規作成" style="width:100" onClick=urljump("$cgifile?code=newform&contents=0")>
<input name="contents0" type="button" id="contents0" value="編集/更新" style="width:100" onClick=urljump("$cgifile?code=editlist&contents=0")>
</form>
</td>
</tr>
<tr valign="top">
<td bgcolor="white" colspan=2 >　</td>
</tr>



<tr valign="top">
<td bgcolor="#ffffff" nowrap width=30% >
$CONTENTSNAME[1]
</td>
<td bgcolor="#ffffff">
<form action="$cgifile" method="post" enctype="multipart/form-data" name="form2" id="form2">
<input name="contents0" type="button" id="contents0" value="新規作成" style="width:100" onClick=urljump("$cgifile?code=newform&contents=1")>
<input name="contents0" type="button" id="contents0" value="編集/更新" style="width:100" onClick=urljump("$cgifile?code=editlist&contents=1")>
</form>
</td>
</tr>
<tr valign="top">
<td bgcolor="white" colspan=2 >　</td>
</tr>



<tr valign="top">
<td  bgcolor="#ffffff" nowrap >
$CONTENTSNAME[2]
</td>
<td bgcolor="#ffffff">
<form action="$cgifile" method="post" enctype="multipart/form-data" name="form2" id="form2">
<input type="hidden" name="code" value="editlist" >
<input type="hidden" name="contents" value="2" >

<input type="submit" name="button" id="button" value="お問い合わせ一覧へ" />
</form>
</td>
</tr>
<tr valign="top">
<td bgcolor="white" colspan=2 >　</td>
</tr>



<tr valign="top">
<td bgcolor="#ffffff" nowrap width=30% >
$CONTENTSNAME[3]
</td>
<td bgcolor="#ffffff">
<form action="$cgifile" method="post" enctype="multipart/form-data" name="form2" id="form2">
<input type="hidden" name="code" value="newform" >
<input type="hidden" name="contents" value="3" >
$holidaytyear
<input type="submit" name="button" id="button" value="入力フォームへ" />
</form>
</td>
</tr>
<tr valign="top">
<td bgcolor="white" colspan=2 >　</td>
</tr>









</table>


</td>
</tr>
</table>
$footer
HTML_VIEW
exit;






# -----------------------------------------------------------------
# ログアウト処理
# -----------------------------------------------------------------
sub logout {
print "Set-Cookie: $cookiename=; expires=Thu, 1-Jan-1970 00:00:00 GMT;\n";
print "Content-type: text/html;\n\n";
print <<"END_HTML";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>$webpalname</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td width=150><a href=$cgifile><img src=img/webpallogo.jpg valign=middle border="0"></a></td>
<td align=center><a href=$cgifile><font color="#666666">$webpalname</font></a></td>
<td width=150>　</td>
</tr>
<tr>
<td colspan=3>
<hr>
<center>
ログアウトしました。<p>
<br>
<a href=$cgifile>再ログイン</a>
</td></tr></table>
</body>
</html>
END_HTML
exit;
}


# -----------------------------------------------------------------
# ヘルプ
# -----------------------------------------------------------------
sub helpdisp {
print <<"END_HTML";
$header
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td>
$webpalimg

<p>不明な点がございましたら以下の【技術サポート窓口】より問い合わせください。<p/>

</td>
</tr>
</table>
$footer
END_HTML
exit;
}





1;
