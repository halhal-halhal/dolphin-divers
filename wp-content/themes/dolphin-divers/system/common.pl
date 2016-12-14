use utf8;
use lib './lib';
use CGI::Carp qw(fatalsToBrowser);
use File::Basename;
use File::Copy;
use Jcode;
use Unicode::Japanese;	#文字コード
use Date::Simple (':all');
use Time::Local 'timelocal';
use XML::Simple;

use XML::FeedPP;
use HTTP::Date;
use HTML::Entities;
use LWP::UserAgent;
use HTTP::Request::Common qw(POST);
use LWP::Simple;
use XML::Simple;

if($cgifile eq ""){$cgifile = "webpal.cgi";}
$sitetitle = "ドルフィンダイバーズ";
$sitefulladr = "http://dolphin-divers.jp/";
$cookiename = "dolphindivers";
$dbname = "dolphindivers";

%ID = (
	"dolphin" => "SagrhQWGM23f",
);
%IDNAME = (
	"dolphin" => "管理者",
);
$webpalname = "- WebPal -ウェブパル　[サイトコンテンツ管理]";

@CONTENTSNAME = ();
$CONTENTSNAME[0] = "ツアースケジュール作成";
$CONTENTSNAME[1] = "インフォメーション作成";
$CONTENTSNAME[2] = "お問い合わせ履歴";
$CONTENTSNAME[3] = "祝日の設定";

@FORMFILE = ();
$FORMFILE[0] = "form_tour.html";
$FORMFILE[1] = "form_info.html";
$FORMFILE[2] = "form_toiawase.html";
$FORMFILE[3] = "form_holiday.html";

@ONOFFFLAG = ("OFF","ON");

#休日の枠数
$holidaycount = 24;	#0〜　なので＋１個になる
# -----------------------------------------------------------------

use CGI;
$query = new CGI;
$query->charset('utf-8');
# -----------------------------------------------------------------
# CGI.pm 文字化け対策（サーバーのバージョンで動作）
for my $p ($query->param) {
	$paramlist .= $p."<br>\n";
	my $v = $query->param($p);
	utf8::decode($v);
	$paramhash{$p} = $v;
#文字のURLエンコード
	$s = $v;
	utf8::encode($s);
	$s =~ s/([^￥w])/'%'.unpack("H2", $1)/ego;
	$s =~ tr/ /+/;
	utf8::decode($s);
	$paramhash_enc{$p} = $s;
#文字のURLデコード
	$s = $v;
	utf8::encode($s);
	$s =~ tr/+/ /;
	$s =~ s/%([0-9A-Fa-f][0-9A-Fa-f])/pack('H2', $1)/eg;
	utf8::decode($s);
	$paramhash_dec{$p} = $s;
	
}	#for

@WEEKDAY = ("（日）","（月）","（火）","（水）","（木）","（金）","（土）");
@KOUKAIFLAG = ("公開中","非公開");
@TOURFLAG = ("日帰り","夜行日帰り","国内泊","国内リゾート","海外リゾート","ピクニック","イベント","その他");
@FONTCOLOR = ("color:#0000FF;","color:#151515;","color:#C100C1;","color:#800080;","color:#ff2894;","color:#f27900;","color:#ff0000;","color:#000080;");

# -----------------------------------------------------------------
#以下初期設定
# -----------------------------------------------------------------
$id = $query->param('id');
$pw = $query->param('pw');
$code = $query->param('code');

($sec,$min,$hour,$mday,$month,$year,$wno) = localtime(time);
$month++;
$year += 1900;

@GETUMATU = (0,31,28,31,30,31,30,31,31,30,31,30,31);
# 閏年計算
# 入力年がうるう年の場合は $flag に 1 をセットする
if ($year % 400 == 0) {			# ← 400の倍数年の場合
  $flag = 1;
} elsif ($year % 100 == 0) {	# ← 100の倍数年の場合
  $flag = 0;
} elsif ($year % 4 == 0) {		# ← 4の倍数年の場合
  $flag = 1;
} else {						# ← その他の場合
  $flag = 0;
}
if($flag == 1){$GETUMATU[2] = 29;}
$nowdate = sprintf("%04d-%02d-%02d %02d:%02d:%02d",$year,$month,$mday,$hour,$min,$sec);

$webrightbar = << "HTML_VIEW";
<br>
<div align=center style="font-size: 10px;">
<hr width=600>
<a target=_blank href=http://www.net-friends.co.jp/webpal/support/form/form.cgi?c=$sitetitle>【技術サポート窓口】</a><br>
&copy;2013 NET FRIENDS INC. All Rights Reserved.
</div>
HTML_VIEW

# -----------------------------------------------------------------
#データベースオープン
# -----------------------------------------------------------------
use DBI;
$database = "dolphin-divers_nf";
$dbhostname ="mysql463.db.sakura.ne.jp";
$dbuser = "dolphin-divers";
$dbpassword = "95eXCwmR";

$sqldsn="DBI:mysql:$database:$dbhostname";
$dbh = DBI->connect($sqldsn,$dbuser,$dbpassword);
$dbh->do("set names utf8");
# ----------------------------------
sub sqlcheck {
my ($sql_str)=(@_);
my $s1 = $dbh->err;
my $s2 = $dbh->errstr;
if($s1 ne ""){
print "$sql_str<br>\n";
print "$s1:$s2<br>\n";
exit;
}	#if
}	#sub

# -----------------------------------------------------------------
# 閏年計算
# -----------------------------------------------------------------
sub urudays {
my ($year,$mm)=(@_);
my $flag;
my @GETUMATU = (0,31,28,31,30,31,30,31,31,30,31,30,31);
# 閏年計算
# 入力年がうるう年の場合は $flag に 1 をセットする
if ($year % 400 == 0) {			# ← 400の倍数年の場合
  $flag = 1;
} elsif ($year % 100 == 0) {	# ← 100の倍数年の場合
  $flag = 0;
} elsif ($year % 4 == 0) {		# ← 4の倍数年の場合
  $flag = 1;
} else {						# ← その他の場合
  $flag = 0;
}
if($flag == 1){$GETUMATU[2] = 29;}
return $GETUMATU[$mm];
}	#sub
#---------------------------

$header = <<"END_HTML";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>$webpalname</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.s1 {
	font-size: 12px;
}
-->
</style>
<script>
function urljump(url){
top.location.href=url;
}
function windowopen(url){
if( url != ""){
w = window.open(url, "workspace", "width=600,directories=no,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=no");
}
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
END_HTML



$footer = <<"END_HTML";
$webrightbar
</body>
</html>
END_HTML


$loginuser = &getcook($cookiename);
$lang = &getcook($cookiename2);
$webpalimg = << "HTML_VIEW";
<table width="90%" border="0" cellspacing="0" cellpadding="0" class="text-12" align=center>
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

</table>
</td>
</tr>
</table><hr width=750>
HTML_VIEW

# -----------------------------------------------------------------
# 年月日のselectタグを作成
# -----------------------------------------------------------------

sub makeselect{
my ($st,$ed,$ec,$gengou) = (@_);
my $data = "";
my $f1,$f2,$gen,$h,$s,$gs;
for(my $i=$st;$i<=$ed;$i++){
if($gengou eq ""){$gengoustr = "";}else{
$h = $i - 1988;
$s = $i - 1925;
if($s > 0){$gs = "S";$gen = $s;}
if($h > 0){$gs = "H";$gen = $h;}
$gengoustr = "（".$gs.$gen."）";
}	#if
if($i == $ec){
$data .= "<option value=\"$i\" selected><p>$i$gengoustr</p></option>\n";
}else{
$data .= "<option value=\"$i\"><p>$i$gengoustr</p></option>\n";
}	#if
}	#fot
return $data;
}	#sub

# -----------------------------------------------------------------
# タグ処理
# -----------------------------------------------------------------
sub tagsyori {
my ($str) = (@_);
$str =~ s/</&lt;/g;
$str =~ s/>/&gt;/g;
$str =~ s/\x0D\x0A/<BR>/g;
$str =~ s/\x0D/<BR>/g;
$str =~ s/\x0A/<BR>/g;
return $str;
}

# -----------------------------------------------------------------
# セットクッキー　３０日有効
# -----------------------------------------------------------------
sub setcook {
my ($fn,$cook) = @_;
my($sec,$min,$hour,$mday,$mon,$year,$wday) = gmtime(time+30*24*60*60);
$wday = (Sun,Mon,Tue,Wed,Thu,Fri,Sat)[$wday];
$mon = (Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec)[$mon];
$expire = sprintf("%s, %02d-%s-%04d %02d:%02d:%02d GMT",$wday,$mday,$mon,$year+1900,$hour,$min,$sec);
print "Set-Cookie: $fn=$cook; expires=$expire;\n";
}
# -----------------------------------------------------------------
# ゲットクッキー
# -----------------------------------------------------------------
sub getcook {
my ($fn) = @_;
my @pair = split(/;/,$ENV{'HTTP_COOKIE'});
foreach (@pair) {
my ($n,$val) = split(/=/);
$n =~ s/ //g;
if($fn eq $n){return $val;}
}
return "";
}
# -----------------------------------------------------------------
# 改行対策
# -----------------------------------------------------------------
sub crlfreset {		#改行を\nに統一
my ($ss)=(@_);
$ss =~ s/\x0D\x0A/\n/g;
$ss =~ s/\t//g;
#$ss =~ s/"/&quot;/g;	#"
$ss =~ s/\<br>/\n/g;
$ss =~ s/\<br \/>/\n/g;
$ss =~ s/\<BR>/\n/g;
$ss =~ s/\<BR \/>/\n/g;
$ss =~ s/\<Br>/\n/g;
$ss =~ s/\<Br \/>/\n/g;
$ss =~ s/\<bR>/\n/g;
$ss =~ s/\<bR \/>/\n/g;
return $ss;
}
sub crlfreset2 {		#改行を<br>に統一
my ($ss)=(@_);
#$ss =~ s/"/&quot;/g;	#"
$ss =~ s/\x0D\x0A/<br>/g;
$ss =~ s/\t//g;
$ss =~ s/\n/<br \/>/g;
return $ss;
}
sub crlfreset0 {		#改行を削除
my ($ss)=(@_);
$ss =~ s/\x0D\x0A/\n/g;
$ss =~ tr/\x0D\x0A/\n/;
$ss =~ s/\t//g;
$ss =~ s/\n//g;
#$ss =~ s/"/&quot;/g;	#"
return $ss;
}
# -----------------------------------------------------------------
# パラメータの取得及びutfフラグセット
# -----------------------------------------------------------------
sub paramset {
my ($str) = (@_);
my $temp = &crlfreset($paramhash{$str});
utf8::decode($temp);
return ($temp);
}
# -----------------------------------------------------------------
# パラメータの取得及びutfフラグセット
# -----------------------------------------------------------------
sub paramset2 {
my ($str) = (@_);
my $temp = &crlfreset2($paramhash{$str});
utf8::decode($temp);
return ($temp);
}
# -----------------------------------------------------------------
# パラメータの取得及びutfフラグセット
# -----------------------------------------------------------------
sub paramsetsql {
my ($str,$REF) = (@_);
my $temp;
if($REF ne ""){
$temp = &crlfreset($REF->{$str});
}else{
$temp = &crlfreset($REFHASH->{$str});
}	#if
utf8::decode($temp);
return ($temp);
}
# -----------------------------------------------------------------
# パラメータの取得及びutfフラグセット
# -----------------------------------------------------------------
sub paramsetsql0 {
my ($str,$REF) = (@_);
my $temp;
if($REF ne ""){
$temp = &crlfreset0($REF->{$str});
}else{
$temp = &crlfreset0($REFHASH->{$str});
}	#if
utf8::decode($temp);
return ($temp);
}
# -----------------------------------------------------------------
# パラメータの取得及びutfフラグセット
# -----------------------------------------------------------------
sub paramsetsql2 {
my ($str,$REF) = (@_);
my $temp;
if($REF ne ""){
$temp = &crlfreset2($REF->{$str});
}else{
$temp = &crlfreset2($REFHASH->{$str});
}	#if
utf8::decode($temp);
return ($temp);
}
# -----------------------------------------------------------------
# パラメータの取得及びutfフラグセット
# -----------------------------------------------------------------
sub paramsetsql3 {
my $temp;
my ($str,$REF) = (@_);
if($REF ne ""){
$temp = $REF->{$str};
}else{
$temp = $REFHASH->{$str};
}	#if
$temp = &urllink($temp);
utf8::decode($temp);
return ($temp);
}
#----------------------------------------------#
#■数字を三桁ずつカンマで区切る
#----------------------------------------------#
sub ketakanma{
my ($num) = (@_);
while($num =~ s/(.*\d)(\d\d\d)/$1,$2/){} ;
return($num);
}	#sub

#------------------------------------
#エラー表示：スタッフ向け
#------------------------------------
sub error {
my ($mes) = (@_);
print << "END_HTML";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>$sitetitle システムエラー</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr><td align=cente>
$webpalimg
<center>
<p><font color=red><b>システムエラー</b></font></p>
<br>
<p>$mes</p>
</center>
</td>
</tr>
</table>
</body>
</html>
END_HTML

exit;
}	#sub
#------------------------------------
#エラー表示：ユーザー向け
#------------------------------------
sub normal_error {
my ($mes) = (@_);
#　テンプレートの読み込み　>> @TEMPLATE
open IN,"template/error_temp.html";
@TEMPLATE = <IN>;
close IN;
#
exit;
}	#sub
#------------------------------------
#エラー表示：ユーザー向け：差し込み
#------------------------------------
sub normal_error2 {
my ($str) = (@_);
my $mes =<<"END_HTML";
<table width="100%" border="0" cellspacing="1" cellpadding="1">
<tr>
<td height="400" align="center" valign="middle"> $str </td>
</tr>
</table>
END_HTML
#差し込み表示
$mes =~ s/\"//g;	#"削除
$mes = &crlfreset0($mes);
print "document.write(\"$mes\");\n";
exit;
}	#sub
#----------------------------------------------#
# ツェラーの公式
#----------------------------------------------#
sub wday {
    my ($year,$month,$day)=@_;
    if($month<3){ $month += 12; $year--; }
    return ($year+int($year/4)-int($year/100)+int($year/400)+int((13*$month+8)/5)+$day)% 7;
}	#sub


# -----------------------------------------------------------------
# 新規フォーム
# -----------------------------------------------------------------
sub newform {
$codevalue = 'formadd';
$contents = $paramhash{'contents'};
$tyear = $paramhash{'tyear'};
if($contents eq ""){print "contents error by newform.";exit;}
#
$sql_str = "SELECT MAX(sortnum) as sortnum FROM $dbname WHERE koukaiflag != 9 and contents = $contents";
$rs = $dbh->prepare($sql_str);
$rs->execute();
&sqlcheck;	#SQLエラーチェック
$count = $rs->rows;	# Hit件数を確保
$REFHASH = $rs->fetchrow_hashref;
$sortnum = $REFHASH->{'sortnum'} + 1;
#
$y = $year;$m = $month;$d = $mday;
$nichiji = "<select name=syear>\n";
$nichiji .= &makeselect($y-1,$y+2,$y);
$nichiji .= "</select>年\n";
$nichiji .= "<select name=smonth>\n";
$nichiji .= &makeselect(1,12,$m);
$nichiji .= "</select>日\n";
$nichiji .= "<select name=sday>\n";
$nichiji .= &makeselect(1,31,$d);
$nichiji .= "</select>日\n";
#
$h = 10;$mi = 0;
$jikan = "<select name=shour>\n";
$jikan .= &makeselect(0,23,$h);
$jikan .= "</select>時\n";
$jikan .= "<select name=smin>\n";
$jikan .= &makeselect(0,59,$mi);
$jikan .= "</select>分\n";

#休日設定
if($contents == 3 ){$codevalue = 'holidayformadd';}	#if
$sql_str = "SELECT * FROM holiday WHERE hnichiji like '$tyear-%' ORDER BY hnichiji ASC";
$rs = $dbh->prepare($sql_str);
$rs->execute();
&sqlcheck;	#SQLエラーチェック
$count = $rs->rows;	# Hit件数を確保
@SM = @SD = ();
for($i=0;$i<$count;$i++){
$REFHASH = $rs->fetchrow_hashref;
($y,$m,$d) = split(/-/,&paramsetsql('hnichiji'));
$SM[$i] = $m - 0;
$SD[$i] = $d - 0;
}	#for
$holidaylist ="";
foreach $i(0..$holidaycount){
$k = $i + 1;
$hnichiji = "<select name=hmonth>\n";
$hnichiji .= "<option value='' >選択</option>\n";
$hnichiji .= &makeselect(1,12,$SM[$i]);
$hnichiji .= "</select>月\n";
$hnichiji .= "<select name=hday>\n";
$hnichiji .= "<option value='' >選択</option>\n";
$hnichiji .= &makeselect(1,31,$SD[$i]);
$hnichiji .= "</select>日\n";
$holidaylist .=<<"HTML_END";
<tr>
<td bgcolor="#FFFFFF">祝日$k<br /></td>
<td bgcolor="#FFFFFF">$hnichiji</td>
</tr>
HTML_END
}	#foreach

###
#　テンプレートの読み込み　>> @TEMPLATE
open IN,"template/$FORMFILE[$contents]";
@TEMPLATE = <IN>;
close IN;
#
my @TEMPLATE_AFTER = ();
foreach my $line(@TEMPLATE){
utf8::decode($line);
$line =~ s/\%koukaiflag0\%/checked/;
$line =~ s/\%tourflag0\%/checked/;
$line =~ s/\%codevalue\%/$codevalue/;
$line =~ s/\%contents\%/$contents/;
$line =~ s/\%sortnum\%/$sortnum/;
$line =~ s/\%tyear\%/$tyear/;
$line =~ s/\%holidaylist\%/$holidaylist/;
$line =~ s/\%title\%/$title/;
$line =~ s/\%body\%/$body/;
$line =~ s/\%nichiji\%/$nichiji/;
$line =~ s/\%linkurl\%/$linkurl/;
$line =~ s/\%jikan\%/$jikan/;

$line =~ s/\%(.*)\%//g;
push(@TEMPLATE_AFTER,$line);
}
print << "END_HTML";
$header
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td>
$webpalimg
■$CONTENTSNAME[$contents] 登録フォーム
@TEMPLATE_AFTER
</td>
</tr>
</table>
$footer
END_HTML

}


# -----------------------------------------------------------------
# 休日フォーム登録
# -----------------------------------------------------------------
sub holidayformadd {
$tyear = $paramhash{'tyear'};
@SM = $query->param('hmonth');
@SD = $query->param('hday');
if($tyear eq "" || $tyear < 2012 ){&error("登録年が正しくありません。処理を中断します。");exit;}
#登録に先立ち、該当の年のデータを全部消去
$sql_str = "DELETE FROM holiday WHERE hnichiji like '$tyear-%' ";
$rs = $dbh->prepare($sql_str);
$rs->execute();
#
foreach $i(0..$holidaycount){
#登録する日時を作成
if( $SM[$i] ne "" && $SD[$i] ne "" ){
$nichiji = sprintf("%04d-%02d-%02d",$tyear,$SM[$i],$SD[$i]);
$sql_str = qq{INSERT INTO holiday(hnichiji) VALUES (?);};
$rs = $dbh->prepare($sql_str);
$rs->execute($nichiji);
&sqlcheck($sql_str);	#SQLエラーチェック
}	#if
}	#foreach
#
print << "END_HTML";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>$sitetitle</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.s1 {
	font-size: 12px;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td>
$webpalimg
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="text-12">
<tr><td>
<center>
<p>登録が完了致しました。</p>
<br><br>
<p><a href="$cgifile">【TOPに戻る】</a></p>
</center>
</td>
</tr>
</table>
</td>
</tr>
</table>
$footer
END_HTML
}


# -----------------------------------------------------------------
# フォーム登録
# -----------------------------------------------------------------
sub formadd {
$serial = $paramhash{'serial'};
$koukaiflag = $paramhash{'koukaiflag'};
if($koukaiflag eq ""){$koukaiflag = 1;}		#デフォルトは「非公開」
$tourflag = $paramhash{'tourflag'};
$contents = $paramhash{'contents'};
$sortnum = $paramhash{'sortnum'};
$title = $paramhash{'title'};
$body = $paramhash{'body'};
$linkurl = $paramhash{'linkurl'};
$nichiji = sprintf("%04d-%02d-%02d",$paramhash{'syear'},$paramhash{'smonth'},$paramhash{'sday'});
$jikan = sprintf("%02d:%02d",$paramhash{'shour'},$paramhash{'smin'});
#一部値の置き換え
if($contents eq "0"){$linkurl = $jikan; $sortnum = $tourflag}

# --------------------------
if($serial eq ""){
# 新規登録
$sql_str = qq{INSERT INTO $dbname(contents ,koukaiflag ,sortnum ,title ,body, nichiji, linkurl) VALUES (?,?,?,?,?,?,?);};
$rs = $dbh->prepare($sql_str);
$rs->execute($contents ,$koukaiflag ,$sortnum ,$title ,$body, $nichiji, $linkurl);
}else{
#変更
$title =~ s/\'/\'\'/gm;	#'
$body =~ s/\'/\'\'/gm;	#'
#
$sql_str = "UPDATE $dbname SET 
sortnum= '$sortnum',
title = '$title',
body = '$body',
nichiji = '$nichiji',
linkurl = '$linkurl',
koukaiflag = '$koukaiflag' WHERE serial = $serial ";
$rs = $dbh->prepare($sql_str);
$rs->execute();
}	#if
&sqlcheck($sql_str);	#SQLエラーチェック
#
$bunki =<<"END_HTML";
<p><a href="$cgifile">【TOPに戻る】</a>　<a href="$cgifile?code=editlist&contents=$contents">【一覧に戻る】</a></p>
<p><a href="$cgifile?code=newform&contents=$contents">【新規登録】</a></p>
END_HTML
#if($contents == 1 || $contents == 2  || $contents == 7 ){
#$bunki =<<"END_HTML";
#<p><a href="$cgifile">【TOPに戻る】</a></p>
#END_HTML
#}	#if
###
print << "END_HTML";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>$sitetitle</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.s1 {
	font-size: 12px;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td>
$webpalimg
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="text-12">
<tr><td>
<center>
<p>登録が完了致しました。</p>
$bunki
</center>
</td>
</tr>
</table>
</td>
</tr>
</table>
$footer
END_HTML
}


# -----------------------------------------------------------------
# 編集
# -----------------------------------------------------------------
sub editlist {
$contents = $paramhash{'contents'};
$newsubmitstr = "";
if($contents eq "0" || $contents eq "1"){
$newsubmitstr = <<"END_HTML";
<input type=button value="新規作成画面へ移動する" onClick="urljump(\'$cgifile?code=newform&contents=$contents\')">
END_HTML
}
#
$allstr = <<"END_HTML";
<br>
<a href="javascript:void(0);" onclick="delete_allset()">□全部を選択</a>　
<a href="javascript:void(0);" onclick="delete_allreset()">□全部の選択を解除</a>　
<input type=submit value="一括削除/公開順序の変更登録">
$newsubmitstr
END_HTML
##
print << "END_HTML";
$header
<script>
function urljump(url){
top.location.href=url;
}
function urljump_kakunin2(url){
if (window.confirm("この作業は元に戻す事が出来ません。\\n本当に削除してもよろしいですか")) {
	top.location.href=url;
}
}
function delete_kakunin(){
if (window.confirm("この作業は元に戻す事が出来ません。\\nよろしいですか")) {return true;}else{return false;}
}	// func
function delete_allset(){
if(document.form1.deleteset.length){
for(i=0;i<document.form1.deleteset.length;i++){
document.form1.deleteset[i].checked = true;
}	//for
}else{
document.form1.deleteset.checked = true;
}	//if
}	// func
function delete_allreset(){
if(document.form1.deleteset.length){
for(i=0;i<document.form1.deleteset.length;i++){
document.form1.deleteset[i].checked = false;
}	//for
}else{
document.form1.deleteset.checked = false;
}	//if
}	// func
</script>
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr><td>
$webpalimg
<form action="$cgifile" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return delete_kakunin()" >
<input name="code" type="hidden" id="code" value="deleteset" />
<input name="contents" type="hidden" id="contents" value="$contents" />
■【$CONTENTSNAME[$contents]】  一覧
$allstr
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#666666" class="s1" width=100% align=center>
<tr class="s2" bgcolor="gray"><td>
<table  border="0" cellpadding="1" cellspacing="1" class="s1" width=100%>

END_HTML
# -----------------------------------------------------------------
if($contents == 0){
$sql_str = "SELECT * FROM $dbname  WHERE contents = $contents and koukaiflag != 9 ORDER BY nichiji DESC,lastupdated DESC ";
$disp =<< "END_HTML";
<tr class="s2" bgcolor="#73d783">
<td align=center nowrap>操作</td>
<td align=center nowrap width=5% >公開の有無</td>
<td align=center nowrap width=5% >一括削除</td>
<td align=center nowrap width=5% >開催日</td>
<td align=center nowrap width=5% >ツアー種別</td>
<td align=center width=80%>開催地／備考</td>
<td align=center nowrap>最終更新日</td>
</tr>
END_HTML
}	#if

if($contents == 1){
$sql_str = "SELECT * FROM $dbname  WHERE contents = $contents and koukaiflag != 9 ORDER BY sortnum DESC,lastupdated DESC ";
$disp =<< "END_HTML";
<tr class="s2" bgcolor="#73d783">
<td align=center nowrap>操作</td>
<td align=center nowrap width=5% >公開の有無</td>
<td align=center nowrap width=5% >一括削除</td>
<td align=center nowrap width=5% >公開順序</td>
<td align=center nowrap width=5% >日付</td>
<td align=center width=80%>インフォメーション内容</td>
<td align=center nowrap>最終更新日</td>
</tr>
END_HTML
}	#if

if($contents == 2){
$sql_str = "SELECT * FROM $dbname  WHERE contents = $contents and koukaiflag != 9 ORDER BY lastupdated DESC ";
$disp =<< "END_HTML";
<tr class="s2" bgcolor="#73d783">
<td align=center nowrap>操作</td>
<td align=center nowrap width=200px >氏名（カナ）</td>
<td align=center>お問合せ内容</td>
<td align=center nowrap>問合せ時間</td>
</tr>
END_HTML
}	#if


##
print $disp;
#
$rs = $dbh->prepare($sql_str);
$rs->execute();
$count = $rs->rows;	# Hit件数を確保

for($i = 0;$i < $count;$i++){	# データベース１件ずつ
$REFHASH = $rs->fetchrow_hashref;
$serial = &paramsetsql('serial');
$koukai = $KOUKAIFLAG[$REFHASH->{'koukaiflag'}];
$sortnum = &paramsetsql2('sortnum');
$title = &paramsetsql0('title');
$body = &paramsetsql0('body');
@TEMP = split(/ /,$REFHASH->{'nichiji'});
($y,$m,$d) = split(/-/,$TEMP[0]);
$nichiji = sprintf("%04d年%02d月%02d日",$y,$m,$d);
@TEMP = split(/ /,$REFHASH->{'lastupdated'});
($y,$m,$d) = split(/-/,$TEMP[0]);
$dd = sprintf("%04d年%02d月%02d日",$y,$m,$d);
($h,$mi,$sc) = split(/:/,$TEMP[1]);
$dt = sprintf("%02d時%02d分",$h,$mi);

if($contents == 0){
$tourflag = $TOURFLAG[$sortnum];
$disp =<< "END_HTML";
<tr bgcolor="white">
<td nowrap valign="middle">
<input type=button value="編集" onClick="urljump(\'$cgifile?code=editform&serial=$serial&contents=$contents\')">
<input type=button value="削除" onClick="urljump_kakunin2(\'$cgifile?code=deleterecord&serial=$serial&contents=$contents\')">
</td>
<td align=center nowrap >$koukai </td>
<td align=center nowrap ><input type=checkbox name="deleteset" id="deleteset" value="$serial"></td>
<td align=center nowrap >$nichiji </td>
<td align=center nowrap >$tourflag </td>
<td>$body </td>
<td nowrap>$dd $dt</td>
</tr>
END_HTML
}

if($contents == 1){
$disp =<< "END_HTML";
<tr bgcolor="white">
<td nowrap valign="middle">
<input type=button value="編集" onClick="urljump(\'$cgifile?code=editform&serial=$serial&contents=$contents\')">
<input type=button value="削除" onClick="urljump_kakunin2(\'$cgifile?code=deleterecord&serial=$serial&contents=$contents\')">
</td>
<td align=center nowrap >$koukai </td>
<td align=center nowrap ><input type=checkbox name="deleteset" id="deleteset" value="$serial"></td>
<td align=center class="tdpad" width="5%"><input type=text size=4 name="sortnum" id="sortnum" value="$sortnum"><input type=hidden name="sortnumserial" id="sortnumserial" value="$serial"> </td>
<td align=center nowrap >$nichiji </td>
<td>$title </td>
<td nowrap>$dd $dt</td>
</tr>
END_HTML
}

if($contents == 2){
$body_str = substr($body, 0, 50);	#先頭から50文字だけ表示する
@NAMAE = split(/<>/,&paramsetsql0('title'));
$disp =<< "END_HTML";
<tr bgcolor="white">
<td nowrap valign="middle">
<input type=button value="詳細" onClick="urljump(\'$cgifile?code=editform&serial=$serial&contents=$contents\')">
<input type=button value="削除" onClick="urljump_kakunin2(\'$cgifile?code=deleterecord&serial=$serial&contents=$contents\')">
</td>
<td>$NAMAE[0]（$NAMAE[1]）</td>
<td>$body_str </td>
<td nowrap>$dd $dt</td>
</tr>
END_HTML
}

##
print $disp;
}	#for loop
print << "END_HTML";
</table>
</form>
</td>
</tr>
</table>

$footer
END_HTML
}	#sub



# -----------------------------------------------------------------
# 編集フォーム
# -----------------------------------------------------------------
sub editform {
$serial = $paramhash{'serial'};
$contents = $paramhash{'contents'};

if($serial eq ""){
$sql_str = "SELECT * FROM $dbname WHERE contents = '$contents' ";
}else{
$sql_str = "SELECT * FROM $dbname WHERE serial = '$serial' ";
}	#if
$rs = $dbh->prepare($sql_str);
$rs->execute();
&sqlcheck($sql_str);	#SQLエラーチェック
$REFHASH = $rs->fetchrow_hashref;
$serial = &paramsetsql('serial');
$KFLAG[&paramsetsql('koukaiflag')] = "checked=checked";
$sortnum = &paramsetsql('sortnum');
$title = &paramsetsql('title');
$linkurl = &paramsetsql('linkurl');
if($contents eq "2"){
$body = &paramsetsql2('body');
}else{
$body = &paramsetsql('body');
}	#if

($y,$m,$d) = split(/-/,$REFHASH->{'nichiji'});
if($y == 0 || $y eq ""){$y = $year;$m = $month;$d = $mday;}
$nichiji = "<select name=syear>\n";
$nichiji .= &makeselect($y-1,$y+2,$y);
$nichiji .= "</select>年\n";
$nichiji .= "<select name=smonth>\n";
$nichiji .= &makeselect(1,12,$m);
$nichiji .= "</select>月\n";
$nichiji .= "<select name=sday>\n";
$nichiji .= &makeselect(1,31,$d);
$nichiji .= "</select>日\n";
#
if($contents eq "2"){
$nichiji = $REFHASH->{'nichiji'};
@TEMP = split(/<>/,$title);
$title = $TEMP[0]."（".$TEMP[1]."）";
$lastupdated = &paramsetsql('lastupdated');
}	#if contents 2
#
if($contents eq "0"){
$TFLAG[$sortnum] = "checked=checked";
($h,$mi) = split(/:/,$linkurl);
if($h == 0 || $h eq ""){$h = 0;$mi = 0;}
$jikan = "<select name=shour>\n";
$jikan .= &makeselect(0,23,$h);
$jikan .= "</select>時\n";
$jikan .= "<select name=smin>\n";
$jikan .= &makeselect(0,59,$mi);
$jikan .= "</select>分\n";
}	#if contents 0

#　テンプレートの読み込み　>> @TEMPLATE
open IN,"template/$FORMFILE[$contents]";
@TEMPLATE = <IN>;
close IN;

my @TEMPLATE_AFTER = ();
foreach my $line(@TEMPLATE){
utf8::decode($line);
$line =~ s/\%codevalue\%/formadd/;
$line =~ s/\%contents\%/$contents/;
$line =~ s/\%serial\%/$serial/;
$line =~ s/\%sortnum\%/$sortnum/;
$line =~ s/\%koukaiflag0\%/$KFLAG[0]/;
$line =~ s/\%koukaiflag1\%/$KFLAG[1]/;
$line =~ s/\%tourflag0\%/$TFLAG[0]/;
$line =~ s/\%tourflag1\%/$TFLAG[1]/;
$line =~ s/\%tourflag2\%/$TFLAG[2]/;
$line =~ s/\%tourflag3\%/$TFLAG[3]/;
$line =~ s/\%tourflag4\%/$TFLAG[4]/;
$line =~ s/\%tourflag5\%/$TFLAG[5]/;
$line =~ s/\%tourflag6\%/$TFLAG[6]/;
$line =~ s/\%tourflag6\%/$TFLAG[7]/;
$line =~ s/\%title\%/$title/;
$line =~ s/\%body\%/$body/;
$line =~ s/\%nichiji\%/$nichiji/;
$line =~ s/\%jikan\%/$jikan/;
$line =~ s/\%linkurl\%/$linkurl/;
$line =~ s/\%lastupdated\%/$lastupdated/;

push(@TEMPLATE_AFTER,$line);
}
print << "END_HTML";
$header
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td>

<table border="0" cellpadding="4" cellspacing="0" align=center>
<tr>
<td>

$webpalimg
■【$CONTENTSNAME[$contents]】  編集
@TEMPLATE_AFTER

</td>
</tr>
</table>

</td>
</tr>
</table>
$footer
END_HTML

}	#sub

# -----------------------------------------------------------------
# データの削除処理
# -----------------------------------------------------------------
sub deleterecord {
$serial = $paramhash{'serial'};
$contents = $paramhash{'contents'};
if($serial eq ""){	# serialがないとエラー
print "serial error.";
exit;
}	#if

$sql_str = "UPDATE $dbname SET koukaiflag = 9 WHERE serial = $serial";
$rs = $dbh->prepare($sql_str);
$rs->execute();
&sqlcheck($sql_str);	#SQLエラーチェック

print << "END_HTML";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="0;URL=$cgifile?code=editlist&contents=$contents">
<title>$sitetitle</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.s1 {
	font-size: 12px;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr><td align=cente>
$webpalimg
<center>
<p>再読み込み中。。。</p>
</center>
</td>
</tr>
</table>
</body>
</html>
END_HTML
}	#sub

# -----------------------------------------------------------------
# データの一括削除処理
# -----------------------------------------------------------------
sub deleteset {
@SS = $query->param('deleteset');
@SN = $query->param('sortnum');
@SNS = $query->param('sortnumserial');
$contents = $paramhash{'contents'};
if($contents eq ""){	# contentsがないとエラー
print "contents error.";
exit;
}	#if
#一括削除
foreach $line(@SS){
$sql_str = "UPDATE $dbname SET koukaiflag = 9 WHERE serial = $line";
$rs = $dbh->prepare($sql_str);
$rs->execute();
&sqlcheck;	#SQLエラーチェック
}	#for
#表示順位
$i=0;
foreach $line(@SNS){
$sql_str = "UPDATE $dbname SET sortnum = $SN[$i] WHERE serial = $line";
$rs = $dbh->prepare($sql_str);
$rs->execute();
&sqlcheck;	#SQLエラーチェック
$i++;
}	#for

print << "END_HTML";
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="3;URL=$cgifile?code=editlist&contents=$contents">
<title>$sitetitle</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.s1 {
	font-size: 12px;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="90%" border="0" cellpadding="4" cellspacing="0" align=center>
<tr><td align=cente>
$webpalimg
<center>
<p>処理を行いました。</p>
<p>３秒後に再読み込みします。</p>
</center>
</td>
</tr>
</table>
</body>
</html>
END_HTML
}






1;