<?php
/**
 * @package Joostina
 * @copyright Авторские права (C) 2008-2010 Joostina team. Все права защищены.
 * @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */


// Set flag that this is a parent file
define("_VALID_MOS", 1);
/** Include common.php*/
require_once ('common.php');
echo $DBhostname = mosGetParam($_POST, 'DBhostname', '');
$DBuserName = mosGetParam($_POST, 'DBuserName', '');
$DBpassword = mosGetParam($_POST, 'DBpassword', '');
$DBname = mosGetParam($_POST, 'DBname', '');
$DBPrefix = mosGetParam($_POST, 'DBPrefix', 'jos_');
$DBDel = intval(mosGetParam($_POST, 'DBDel', 0));
$DBBackup = intval(mosGetParam($_POST, 'DBBackup', 0));
$DBSample = intval(mosGetParam($_POST, 'DBSample', 1));
$DBexp = intval(mosGetParam($_POST, 'DBexp', 0));
// заменить на 1 для возможности выбора экспериментального типа базы данных
$YA_UVEREN = 0;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Joostina Lotos - Web-установка. Конфигурация базы данных.</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="shortcut icon" href="../images/favicon.ico"/>
	<link rel="stylesheet" href="install.css" type="text/css"/>
	<script type="text/javascript">
		<!--
		function check() {
// форма основной конфигурации
			var formValid = false;
			var f = document.form;
			if (f.DBhostname.value == '') {
				alert('Пожалуйста, введите имя Хоста MySQL');
				f.DBhostname.focus();
				formValid = false;
			} else if (f.DBuserName.value == '') {
				alert('Пожалуйста, введите имя пользователя Базы Данных MySQL');
				f.DBuserName.focus();
				formValid = false;
			} else if (f.DBname.value == '') {
				alert('Пожалуйста, введите Имя для своей новой БД');
				f.DBname.focus();
				formValid = false;
			} else if (f.DBPrefix.value == '') {
				alert('Для правильной работы Joostina Вы должны ввести префикс таблиц БД MySQL.');
				f.DBPrefix.focus();
				formValid = false;
			} else if (f.DBPrefix.value == 'old_') {
				alert('Вы не можете использовать префикс таблиц "old_", так как Joostina использует его для создания резервных таблиц.');
				f.DBPrefix.focus();
				formValid = false;
			} else if (confirm('Вы уверены, что правильно ввели данные? \Joostina будет заполнять таблицы в БД, параметры которой Вы указали.')) {
				formValid = true;
			}
			return formValid;
		}
		//-->
	</script>
</head>
<body onload="document.form.DBhostname.focus();">
<div id="ctr" align="center">
	<form action="install2.php" method="post" name="form" id="form" onsubmit="return check();">
		<div class="install">
			<div id="header">
				<p><?php echo $version; ?></p>
				<p class="jst"><a href="http://joostina-cms.ru">Joostina Lotos CMS</a> - свободное программное обеспечение (лицензия GNU/GPL)</p>
			</div>

			<div id="navigator">
				<h1>Установка Joostina Lotos CMS</h1>
				<ul>
					<li class="step"><strong>1</strong><span>Проверка системы</span></li>
					<li class="arrow">&nbsp;</li>
					<li class="step"><strong>2</strong><span>Лицензионное соглашение</span></li>
					<li class="arrow">&nbsp;</li>
					<li class="step step-on"><strong>3</strong><span>Конфигурация базы данных</span></li>
					<li class="arrow">&nbsp;</li>
					<li class="step"><strong>4</strong><span>Название сайта</span></li>
					<li class="arrow">&nbsp;</li>
					<li class="step"><strong>5</strong><span>Конфигурация сайта</span></li>
					<li class="arrow">&nbsp;</li>
					<li class="step"><strong>6</strong><span>Завершение установки</span></li>
				</ul>
			</div>

			<div class="buttons">
				<input class="button" type="submit" name="next" value="Далее &gt;&gt;"/>
			</div>
			<div id="wrap">
				<div class="install-form">
					<div class="form-block">

						<table class="content2" width="100%">

							<tr>
								<th>Имя хоста MySQL</th>
								<td>
									<input class="inputbox" type="text" name="DBhostname"
										   value="<?php echo ($DBhostname == '') ? 'localhost' : $DBhostname; ?>"/>
									Обычно это &nbsp;<b>localhost</b>
								</td>
							</tr>

							<tr>
								<th>Имя пользователя MySQL</th>
								<td>
									<input class="inputbox" type="text" name="DBuserName"
										   value="<?php echo ($DBuserName == '') ? 'root' : $DBuserName; ?>"/>
									Для установки на домашнем компьютере чаще всего используется имя&nbsp; <b><span
									style="color:green">root</span></b>
									, а для установки в Интернете, введите данные, полученные у Хостера.
								</td>
							</tr>

							<tr>
								<th>Пароль доступа к БД MySQL</th>
								<td>
									<input class="inputbox" type="text" name="DBpassword"
										   value="<?php echo $DBpassword; ?>"/>
									Оставьте поле пустым для домашней установки или введите пароль доступа к Вашей БД,
									полученный у хостера.
								</td>
							</tr>

							<tr>
								<th>Имя БД MySQL</th>
								<td>
									<input class="inputbox" type="text" name="DBname" value="<?php echo $DBname; ?>"/>
									Имя существующей или новой БД, которая будет использоваться для сайта
								</td>
							</tr>

							<tr>
								<th>Префикс таблиц БД MySQL</th>
								<td>
									<input class="inputbox" type="text" name="DBPrefix"
										   value="<?php echo $DBPrefix; ?>"/>
									Используйте префикс таблиц для установки в одну БД.
									Не используйте <span style="color:#ff0000">'old_'</span> - это зарезервированное
									значение.
								</td>
							</tr>

							<tr>
								<th>Удалить существующие таблицы</th>
								<td>
									<input type="checkbox" name="DBDel" id="DBDel" value="1" <?php if($DBDel)
										echo 'checked="checked"'; ?> />
									<br/> Все существующие таблицы от предыдущих установок Joostina будут удалены.
								</td>
							</tr>

							<tr>
								<th>Создать резервные копии существующих таблиц</th>
								<td>
									<input type="checkbox" name="DBBackup" id="DBBackup" value="1" <?php if($DBBackup)
										echo 'checked="checked"'; ?> />
									<br/> Все существующие резервные копии таблиц от предыдущих установок Joostina будут
									заменены.
								</td>
							</tr>

							<tr>
								<th>Создать базу данных, если её нет</th>
								<td>
									<input type="checkbox" name="create_db" id="create_db" value="1" checked="checked"/>
									<br/> Внимание! Не на всех хостингах создание БД таким способом будет возможно. В
									случае возникновения ошибок - создайте пустую БД стандартным для вашего хостинга
									способом и выберите её
								</td>
							</tr>

							<tr>
								<th>Установить демонстрационные данные</th>
								<td>
									<input type="checkbox" name="DBSample" id="DBSample" value="1" <?php if($DBSample)
										echo 'checked="checked"'; ?> />
									<br/><span style="color: #ff0000">Не выключайте это, если Вы ещё не знакомы с Joostina Lotos! Вы всегда можете легко удалить примеры!</span>
								</td>
							</tr>

						</table>


					</div>
				</div>
			</div>
			<div class="clr">
			</div>
		</div>
	</form>
</div>
<div class="clr"></div>
<div class="ctr" id="footer"><a href="http://joostina-cms.ru" target="_blank">Joostina Lotos</a> - свободное программное обеспечение, распространяемое по лицензии GNU/GPL.</div>
</body>
</html>
