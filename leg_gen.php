Регистрация завершена.
<!--
<table>
<tr><td width="50%">
<h1>Зарегистрироваться легионером:</h1><br>
<div id="error"></div>
<form action="do_reg.php" method="POST" onsubmit="return check_form(this, ['igrok', 'email'])">
<input type="hidden" name="regtype" value="legion">
<table>
<tr>
<td>Игрок:</td><td><input type="text" name="igrok" size="60"></td>
</tr><tr>
<tr>
<td>Email:</td><td><input type="text" name="email" size="60"></td>
</tr><tr>
<td>Защита от роботов:</td><td>
    <div class="g-recaptcha" data-sitekey="6LemAYwUAAAAAOgSeK0ewqMDHq9vERYJ1QryR-8A"></div>

</td></tr><tr>
<td></td><td><input type="submit" value="Зарегистрироваться!"></td>
</tr>
</table>
</form>
</td>
<td style='vertical-align: top; padding-left: 50px'>
<h1>Текущий список легионеров:</h1>
<i>Если вы зарегистрировались как легионер, и уже нашли себе команду, пожалуйста, <a href="contacts">сообщите Оргкомитету</a> для обновления списка.</i>
<p/>
<- Our name is legion ->
<?= file_get_contents('legioner'); ?>
</td>
</tr>
</table>
Заполнение всех полей формы обязательно для регистрации.
<script>
function check_form(form, els) {
	var bad = false
	for(var i in els) {
		var el = els[i]
		if(form[el].value == '') {
			form[el].style['border-color'] = 'red'
			bad = true
		} else {
			form[el].style['border-color'] = ''
		}

}
	if(bad) {
		error = document.getElementById('error')
		error.innerHTML="Пожалуйства, заполните все поля формы!"
		return false
	}
	return true
}
</script>
-->

