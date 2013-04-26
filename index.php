<?php include 'pages.php'; ?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <link rel='stylesheet' href='images/styles.css' type='text/css' />
 <link rel="alternate" type="application/rss+xml" title="RSS" href="news.xml" />
 <title><?= $title ?></title>
</head>


<body>
<table width="95%" border="0" cellspacing="0" cellpadding="0" height="100%">
<tbody><tr> 
<td class="logo"><a href="news"><img src="images/logo_2013_143x84.png" border="0" width="143" alt="Домой" vspace="1"></a></td>
    <td valign="middle"> 
        <table class="header">
          <tbody><tr>
            <td class="tdheader <?= $current ?>"><?= $title ?></td>
          </tr>
        </tbody></table>
    </td>
  </tr>
  <tr> 
    <td class="nav"> 
	<?php navigation(); ?>
    </td>
    <td class="content"><div class="contentdiv"> <?php content(); ?>
    </div></td>
  </tr>
  <tr> 
    <td class="logo"><img src="images/ptica.gif" width="143" height="79" vspace="5" alt="Птица"></td>
    <td class="bottom">
        <a href="news">Домой</a> - 
        <a href="contacts">Контакты</a>
    </td>
  </tr>
</tbody>
</table>      
</body>
</html>

