	<td width="50%"><table class="teamdata">
	<tbody><tr bgcolor="beige"><td colspan="2" align="center"><font size="+1"><a href="http://ratingnew.chgk.info/teams.php?displayteam=<?= $row['nomer'] ?>"><?= $row['komanda'] ?></a>
<?php if($row['zachet'] == -1) { ?> <sup><a href="#zach">*</a></sup><?php } ?>
</font></td></tr>
	<tr><td colspan="2" align="center"><?= $row['gorod'] ?></td></tr>
	<tr valign="top">
	<td>
	<?php
	$c = count($igroki);
	$h = ($c>6?4:3);
	for($i=0; $i<$h; $i++) {
		if(empty($igroki[$i])) break;
		echo $igroki[$i]."<br>";
	}?>
	</td>
	<td>
	<?php for(; $i<$c; $i++) {
		if(empty($igroki[$i])) break;
		echo $igroki[$i]."<br>";
	}?>
	</td>
	</tr>
	</tbody></table>
</td>
