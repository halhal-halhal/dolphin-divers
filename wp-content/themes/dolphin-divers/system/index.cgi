#!/usr/local/bin/perl

use utf8;

require 'common.pl';
$cgifile = "index.cgi";

# -----------------------------------------------------------------
# フォームデータGET
# -----------------------------------------------------------------
$code = $paramhash{'code'};
# -----------------------------------------------------------------
# HTML
# -----------------------------------------------------------------
print "Content-type: text/html;\n\n";

# -----------------------------------------------------------------

if($code eq "top_info"){&top_info;exit;}
if($code eq "blog"){&blog;exit;}
if($code eq "tour"){&tour;exit;}
if($code eq "toiawase"){&toiawase;exit;}
if($code eq "toiawase_chk"){&toiawase_chk;exit;}
if($code eq "toiawase_ok"){&toiawase_ok;exit;}


exit;

# -----------------------------------------------------------------
# TopページのInformation
# -----------------------------------------------------------------
sub top_info {
# <script src="http://dolphin-divers.jp/system/?code=top_info" ></script>
$sql_str = "SELECT * FROM $dbname  WHERE contents = 1 and koukaiflag = 0 ORDER BY sortnum DESC,lastupdated DESC ";
$rs = $dbh->prepare($sql_str);
$rs->execute();
$count = $rs->rows;	# Hit件数を確保

$disp =<< "END_HTML";
    <dl>
END_HTML

for($i = 0;$i < $count;$i++){	# データベース１件ずつ
$REFHASH = $rs->fetchrow_hashref;
$title = &paramsetsql0('title');
@TEMP = split(/ /,$REFHASH->{'nichiji'});
($y,$m,$d) = split(/-/,$TEMP[0]);
$nichiji = sprintf("%d\.%d\.%d",$y,$m,$d);
$linkurl = &paramsetsql0('linkurl');
if($linkurl ne ""){
$title_str = "<a href='$linkurl'>$title</a>";
}else{
$title_str = $title;
}	#if
#
$disp .=<< "END_HTML";
        <dt>$nichiji</dt>
        <dd>$title_str</dd>
END_HTML
}	#for_loop

$disp .=<< "END_HTML";
	</dl>
END_HTML

#差し込み表示
$disp =~ s/\"//g;	#"削除
$mes = &crlfreset0($disp);
print "document.write(\"$mes\");\n";
#print "$mes";

}	#sub

# -----------------------------------------------------------------
# Topページのblog（FC2のRSSを引っ張ってくる）表示3件
# -----------------------------------------------------------------
sub blog {
# <script src="http://dolphin-divers.jp/system/?code=blog" ></script>
my $feed = XML::FeedPP->new('http://nagoyadolphindivers.blog.fc2.com/?xml') or die;
my @list = $feed->get_item();
my @inp = ();
$site_title = $feed->title;
$site_url = $feed->link;
$cnt = 0;

$rss =<<"END_HTML";
    <dl>
END_HTML

foreach my $item (@list) {
$title = $item->title;
utf8::decode($title);
$linkadr = $item->link;
$description = $item->description;
$tix = $item->pubDate;
$tix = str2time($tix);
($sec,$min,$hour,$mday,$mon,$year,$wno) = localtime($tix);
if($year < 1900 ){$year += 1900;}
my $timex_sp = sprintf("%d年%d月%d日",$year,$mon+1,$mday);
$rss .=<<"END_HTML";
        <dt>$timex_sp</dt>
        <dd><a href='$linkadr' target=_blank >$title</a></dd>
END_HTML
if( ++$cnt > 2){last;}
}	#foreach

$rss .=<<"END_HTML";
    </dl>
END_HTML

#差し込み表示
$rss =~ s/\"//g;	#"削除
$mes = &crlfreset0($rss);
print "document.write(\"$mes\");\n";
#print "$mes";

}	#sub
# -----------------------------------------------------------------
# ダイビングツアースケジュール
# -----------------------------------------------------------------
sub tour {
# <script src="http://dolphin-divers.jp/system/?code=tour" ></script>
$tyear = $paramhash{'tyear'};
$tmonth = $paramhash{'tmonth'};
#日付情報がなければ当月
if($tyear eq ""){$tyear = $year;}	#if
if($tmonth eq ""){$tmonth = $month;}	#if
$lastdays = &urudays($tyear,$tmonth);
#祝日をGET
$nichiji = sprintf("%04d-%02d-%s",$tyear,$tmonth,'%');
$sql_str = "SELECT * FROM holiday WHERE hnichiji like '$nichiji' ORDER BY hnichiji ASC";
$rs = $dbh->prepare($sql_str);
$rs->execute();
&sqlcheck;	#SQLエラーチェック
$count = $rs->rows;	# Hit件数を確保
@SM = @SD = ();
for($i=0;$i<$count;$i++){
$REFHASH = $rs->fetchrow_hashref;
($y,$m,$d) = split(/-/,&paramsetsql('hnichiji'));
$SD[$d] = 1;
}	#for

#ツアー情報をGET
$sql_str = "SELECT * FROM $dbname  WHERE contents = 0 and koukaiflag = 0 and nichiji like '$nichiji' ORDER BY nichiji ASC, sortnum ASC ";
$rs = $dbh->prepare($sql_str);
$rs->execute();
$count = $rs->rows;	# Hit件数を確保

for($i = 0;$i < $count;$i++){	# データベース１件ずつ
$REFHASH = $rs->fetchrow_hashref;
@TEMP = split(/ /,$REFHASH->{'nichiji'});
($y,$m,$d) = split(/-/,$TEMP[0]);
$DATECOUNT[$d] = $DATECOUNT[$d] + 1;
}	#for_loop

#もう一度ツアー情報をGET（上の処理で一度fetchしてしまったため）
$sql_str = "SELECT * FROM $dbname  WHERE contents = 0 and koukaiflag = 0 and nichiji like '$nichiji' ORDER BY nichiji ASC, sortnum ASC ";
$rs = $dbh->prepare($sql_str);
$rs->execute();
$count = $rs->rows;	# Hit件数を確保

$tour = "";
@CALSTR = ("")x32;

for($i = 0;$i < $count;$i++){	# データベース１件ずつ
$REFHASH = $rs->fetchrow_hashref;
@TEMP = split(/ /,$REFHASH->{'nichiji'});
($y,$m,$d) = split(/-/,$TEMP[0]);
$nichiji = sprintf("%d\.%d\.%d",$y,$m,$d);
$d_str = sprintf("%02d", $d);
#
$basho = &paramsetsql0('title');
$jikan = &paramsetsql0('linkurl');
if($jikan eq "00:00"){$jikan = "";}
$syubetu = &paramsetsql0('sortnum');
$body = &paramsetsql0('body');
$youbi = &wday($y,$m,$d);
$tour_str = "";
$youbiclass = "";
if($youbi eq "0"){$youbiclass = "class=\"sun\"";}
if($youbi eq "6"){$youbiclass = "class=\"sat\"";}
#ツアー種類で文字色を変える
#if($syubetu ne ""){$sc = " style=$FONTCOLOR[$syubetu]";}
$sc = "style=$FONTCOLOR[$syubetu]";
#日付セルの処理
$date_str =<< "END_HTML";
        <td class="day"><p $youbiclass>$d_str<br />$WEEKDAY[$youbi]</p></td>
END_HTML
#日付セルの、セルを結合させる処理
if($DATECOUNT[$d] > 1 && $d ne $mae_date){		#日付が変わった最初の行
$date_str =<< "END_HTML";
        <td class="day" rowspan=$DATECOUNT[$d]><p $youbiclass>$d_str<br />$WEEKDAY[$youbi]</p></td>
END_HTML
}
if($DATECOUNT[$d] > 1 && $d eq $mae_date){		#2行目以降
$date_str = "";
}
#
$tour_str .=<< "END_HTML";
    <tr>
$date_str
        <td><p $youbiclass><span $sc>$body</span></p></td>
        <td><p $youbiclass><font $sc>$basho<br />$jikan</font></p></td>
    </tr>
END_HTML

$CALSTR[$d] .= $tour_str;

$mae_date = $d;		#日付が変わる変わらないを制御するためにコピー

}	#for_loop $i


#ここからはカレンダー作成 =========================================
$nichiji_str = "<select name=syear>\n";
$nichiji_str .= &makeselect($tyear-1,$tyear+2,$tyear);
$nichiji_str .= "</select>年\n";
$nichiji_str .= "<select name=smonth>\n";
$nichiji_str .= &makeselect(1,12,$tmonth);
$nichiji_str .= "</select>月\n";
#前月／翌月のリンクを作成する
$pre_m = $tmonth -1;
$pre_y = $tyear;
if($pre_m == 0){$pre_y = $tyear - 1;$pre_m = 12;}
$next_m = $tmonth +1;
$next_y = $tyear;
if($next_m == 13){$next_y = $tyear + 1;$next_m = 1;}
$pre_url = "<a href=\"index.cgi?code=tour&tyear=$pre_y&tmonth=$pre_m\">前月</a>";
$next_url = "<a href=\"index.cgi?code=tour&tyear=$next_y&tmonth=$next_m\">翌月</a>";
#

$tour .=<< "END_HTML";
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>カレンダー</title>
<meta http-equiv="content-style-type" content="text/css" />
<link rel="stylesheet" href="test.css" type="text/css" />
<script language="JavaScript">
function iframeResize(){
var PageHight = document.body.scrollHeight + 0; // ページの高さを取得
window.parent.document.getElementById('disp').style.height = PageHight + 'px'; // iframeの高さを変更
}
window.onload = iframeResize;
</script>
</head>
<body>
<table id="scheduleTable" cellspacing="2" cellpadding="9">
    <tr>
        <td align="center">$pre_url</td>
        <td align="center">$tyear 年 $tmonth 月</td>
        <td align="center">$next_url</td>
    </tr>
    <tr>
        <td colspan=3 align="left">
            <span style=$FONTCOLOR[0]>日帰り</span>
            <span style=$FONTCOLOR[1]>夜行日帰り</span>
            <span style=$FONTCOLOR[2]>国内泊</span>
            <span style=$FONTCOLOR[3]>国内リゾート</span>
            <span style=$FONTCOLOR[4]>海外リゾート</span><br />
            <span style=$FONTCOLOR[5]>ピクニック</span>
            <span style=$FONTCOLOR[6]>イベント</span>
            <span style=$FONTCOLOR[7]>その他</span>
        <td>
    </tr>
    <tr>
        <th width="75" id="day">日</th>
        <th style="width:344px;" id="area">開催地／備考</th>
        <th style="width:97px;" id="time">集合／時間</th>
    </tr>
END_HTML

for($j = 1;$j <= $lastdays;$j++){		#1日から月末までのループ処理
if($CALSTR[$j] ne ""){
$tour .= $CALSTR[$j];
}else{
$youbi = &wday($tyear,$tmonth,$j);
$j_str = sprintf("%02d",$j);
$youbiclass = "";
if($youbi eq "0"){$youbiclass = "class=\"sun\"";}
if($youbi eq "6"){$youbiclass = "class=\"sat\"";}
$tour .=<< "END_HTML";
    <tr>
        <td class="day"><p $youbiclass>$j_str<br />$WEEKDAY[$youbi]</p></td>
        <td><p $youbiclass>　</p></td>
        <td><p $youbiclass>　</p></td>
    </tr>
END_HTML
}	#if
}	#for $j

$tour .=<< "END_HTML";
</TABLE>
<p></p>
</body>
</html>
END_HTML

#差し込み表示
$tour =~ s/\"//g;	#"削除
$mes = &crlfreset0($tour);
#print "document.write(\"$mes\");\n";
print "$mes";


}	#sub

# -----------------------------------------------------------------
# 問い合わせフォーム表示
# -----------------------------------------------------------------
sub toiawase {
#<iframe src="http://dolphin-divers.jp/system/?code=toiawase" name="a" frameborder="no" scrolling="auto" marginwidth="0" marginheight="0" width="580" height="700" align="left"> <font color="#000000">当サイトはインラインフレームを使用しております。 </font></iframe>
print <<"END_HTML";
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>お問い合わせフォーム</title>
<meta http-equiv="content-style-type" content="text/css" />
<link rel="stylesheet" href="test.css" type="text/css" />
<SCRIPT LANGUAGE="JavaScript">
<!--
function kakunin() {
if (document.form1.namae.value == '') {
alert('お名前が入力されていません。');
document.form1.namae.focus();
return(false);
}

if (document.form1.yomi.value == '') {
alert('フリガナが入力されていません。');
document.form1.yomi.focus();
return(false);
}

if (document.form1.email.value == '' ) {
alert('メールアドレスが入力されておりません。');
document.form1.email.focus();
return(false);
}

if (document.form1.email2.value == '') {
alert('メールアドレス確認が入力されておりません。');
document.form1.email2.focus();
return(false);
}

if (document.form1.email.value != document.form1.email2.value) {
alert('メールアドレスが異なっております。');
return(false);
}

if (document.form1.naiyou.value == '') {
alert('お問合せ内容が入力されておりません。');
document.form1.naiyou.focus();
return(false);
}

return true;
}
// -->
</SCRIPT>
</head>
<body>

<form action="index.cgi" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return kakunin()">
<input type="hidden" name="code" value="toiawase_chk" />
<table width="100%" border="0" cellspacing="2" cellpadding="5">
<tr>
  <th width="140px" align="left">お名前 <font color="red">※</font></th>
  <td><input name="namae" type="text" id="namae" size="30" /></td>
</tr>
<tr>
  <th align="left">フリガナ <font color="red">※</font></th>
  <td><input name="yomi" type="text" id="yomi" size="30" /></td>
</tr>
<tr>
  <th align="left">お電話番号</th>
  <td><input name="tel" type="text" id="tel" size="20" /></td>
</tr>
<tr>
  <th align="left">メールアドレス <font color="red">※</font></th>
  <td><input name="email" type="text" id="email" size="40"  /></td>
</tr>
<tr>
  <th align="left">メールアドレス確認 <font color="red">※</font></th>
  <td><input name="email2" type="text" id="email2" size="40"  /></td>
</tr>
<tr>
  <th align="left" valign="top">お問合せ内容 <font color="red">※</font></th>
  <td><textarea name="naiyou" cols="50" rows="15" id="naiyou"></textarea></td>
</tr>
</table>
<div class="submit_btn"><input type="submit" value="送信確認画面へ" /></div>
</form>
</body>
</html>
END_HTML
}	#sub
# -----------------------------------------------------------------
# 問い合わせフォーム内容チェック
# -----------------------------------------------------------------
sub toiawase_chk {
$namae = &paramset2('namae');
$namae = "<input type=hidden name='namae' value='$paramhash_enc{'namae'}' >$namae";
$yomi = &paramset2('yomi');
$yomi = "<input type=hidden name='yomi' value='$paramhash_enc{'yomi'}' >$yomi";
$tel = $paramhash{'tel'};
$tel = "<input type=hidden name='tel' value='$paramhash_enc{'tel'}' >$tel";
$email = $paramhash{'email'};
$email = "<input type=hidden name='email' value='$paramhash_enc{'email'}' >$email";
$naiyou = &paramset2('naiyou');
$naiyou = "<input type=hidden name='naiyou' value='$paramhash_enc{'naiyou'}' >$naiyou";


#　テンプレートの読み込み　>> @TEMPLATE
open IN,"template/toiawase_chk.html";
@TEMPLATE = <IN>;
close IN;

my @TEMPLATE_AFTER = ();
foreach my $line(@TEMPLATE){
#utf8::decode($line);
$line =~ s/\%namae\%/$namae/;
$line =~ s/\%yomi\%/$yomi/;
$line =~ s/\%email\%/$email/;
$line =~ s/\%tel\%/$tel/;
$line =~ s/\%naiyou\%/$naiyou/;
push(@TEMPLATE_AFTER,$line);
}
print @TEMPLATE_AFTER;

}	#sub
# -----------------------------------------------------------------
# 問い合わせデータ登録＆メール送信
# -----------------------------------------------------------------
sub toiawase_ok {
$code = $paramhash_dec{'code'};

$namae = $paramhash_dec{'namae'};
$yomi = $paramhash_dec{'yomi'};
$email = $paramhash_dec{'email'};
$tel = $paramhash_dec{'tel'};
$naiyou = $paramhash_dec{'naiyou'};

$namae_str = $namae."<>".$yomi;

# 新規登録
$sql_str = qq{INSERT INTO $dbname(contents ,koukaiflag ,sortnum ,title ,body, nichiji, linkurl) VALUES (?,?,?,?,?,?,?);};
$rs = $dbh->prepare($sql_str);
$rs->execute(
2,
0,
0,
$namae_str,
$naiyou,
$tel,
$email
);
&sqlcheck;	#SQLエラーチェック
#　テンプレートの読み込み　>> @TEMPLATE
open IN,"template/toiawase_ok.html";
@TEMPLATE = <IN>;
close IN;
print @TEMPLATE;


##確認メールの準備
$err = 0;
open(MAIL, "| /usr/sbin/sendmail -t") or $err = 1;
if($err == 1){
&errormessage("現在メールシステムに障害が発生しております。<p>申し訳ありませんがしばらくお待ちください。");
}	#if

$fr = "ドルフィンダイバーズ";
Jcode::convert(\$fr,'jis','utf8');
$fr = jcode($fr)->mime_encode;

$sb = "ドルフィンダイバーズ【お問合せフォームより自動返信】";
Jcode::convert(\$sb,'jis','utf8');
$sb = jcode($sb)->mime_encode;
##
#$youbi =~ s/<>/、/g;
#chop($youbi);
### ユーザーに送るメール
$mes =<< "END_HTML";
From: $fr<no-reply\@dolphin-divers.jp>
To: $email
Subject: $sb

END_HTML
print MAIL $mes;
$mes =<< "END_HTML";
お問合せいただき、ありがとうございます。

折り返しご連絡を差し上げますので、今しばらくお待ちください。


【お急ぎの場合】
お問合せの内容によりご返信までに時間がかかる場合がございます。
お急ぎの場合はお電話でお問合せください。

【連絡がない場合】
数日しても弊社から連絡がない場合は、電話番号・メールアドレスの誤記入が
考えられます。　再度お問合せください。


※このメールのアドレスは送信専用です。

連絡先：
「ドルフィンダイバーズ」
TEL＆FAX：052-876-2105
営業時間：11時30分〜21時00分（年中無休）
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
【問い合わせ内容】
□連絡先電話番号：$tel
□お問合せ内容：

$naiyou

=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

END_HTML
Jcode::convert(\$mes,'jis','utf8');
print MAIL $mes;
close MAIL;

### 医院に送るメール
$err = 0;
open(MAIL, "| /usr/sbin/sendmail -t") or $err = 1;
if($err == 1){
&errormessage("現在メールシステムに障害が発生しております。<p>申し訳ありませんがしばらくお待ちください。");
}	#if

$fr = Unicode::Japanese->new("ドルフィンダイバーズ")->jis;
$fr = jcode($fr)->mime_encode;

$sb = Unicode::Japanese->new("ドルフィンダイバーズ【問合せフォームより自動送信】")->jis;
$sb = jcode($sb)->mime_encode;

#To: info\@dolphin-divers.jp

$mes =<< "END_HTML";
From: $fr
To: info\@dolphin-divers.jp
Subject: $sb

END_HTML
print MAIL $mes;
$mes =<< "END_HTML";
ホームページより問い合わせがありました。
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
【問い合わせ内容】
□氏名：$namae
□ふりがな：$yomi
□メールアドレス：$email
□連絡先電話番号：$tel
□お問合せ内容：

$naiyou

=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
END_HTML
Jcode::convert(\$mes,'jis','utf8');
print MAIL $mes;
close MAIL;

}	#sub



1;
