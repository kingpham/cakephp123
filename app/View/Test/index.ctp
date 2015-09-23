<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.mobile-1.4.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.mobile-1.4.4.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>ログイン</title>
</head>
<body>
    <div data-role="page">
        <div class="head-title">
            Sumatyu</div>
        <header data-role="header">
            <!--<div class="logo"></div>-->
            <div class="title">
                〓 ログイン</div>
        </header>
        <section data-role="main" class="ui-content">
            <div class="bread">
                <a href="#myPopup" data-rel="popup" class="ui-btn ui-btn-inline">ログイン</a></div>
            <div class="main">
                <div class="para-text">
                    <span>正しいログインIDとパスワードを入力してください。</span>
                </div>
				<table>
					<?php foreach($data as $value) :?>
					<tr>
						<td><?php echo h($value['Student']['name']) ?></td>
					</tr>
					<?php  endforeach; ?>
				</table>
                <table class="tbl-login" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th width="30%">
                            ログインID
                        </th>
                    </tr>
                    <tr>
                        <td width="70%">
                            <input type="text" />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            パスワード
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" />
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</body>
</html>
