<?
	if(isset ($_POST['title'])) {$title=$_POST['title'];}
	if(isset ($_POST['name'])) {$fio=$_POST['name'];}
	if(isset ($_POST['phone'])) {$phonenum=$_POST['phone'];}

	if(isset ($_POST['step1'])) {$step1=$_POST['step1'];}
	if(isset ($_POST['step2'])) {$step2=$_POST['step2'];}
	if(isset ($_POST['step3'])) {$step3=$_POST['step3'];}
	if(isset ($_POST['step4'])) {$step4=$_POST['step4'];}
	if(isset ($_POST['step5'])) {$step5=$_POST['step5'];}
	if(isset ($_POST['step6'])) {$step6=$_POST['step6'];}

	$to = "mashtalir_sasha@ukr.net"; // Замениь на емаил клиента

	$message = "Форма: $title <br><br>";
	if ( $fio || $phonenum || $step1 || $step2 || $step3 || $step4 || $step5 || $step6 ) {
		$message .= ""
			. ( $fio ?" Имя:  $fio <br>" : "")
			. ( $phonenum ?" Телефон:  $phonenum <br><br>" : "")
			. ( $step1  ? " Сколько Вам/ребенку лет?: $step1 <br>" : "")
			. ( $step2  ? " Вы ранее занимались танцами?: $step2 <br>" : "")
			. ( $step3  ? " Какие танцы Вам больше всего нравятся?: $step3 <br>" : "")
			. ( $step4  ? " Какую цель Вы преследуете, занимаясь танцами?: $step4 <br>" : "")
			. ( $step5  ? " Какой абонемент Вам больше всего подойдет?: $step5 <br>" : "")
			. ( $step6  ? " Выберите подарок от школы танцев  «Dream Team»: $step6 <br>" : "");
	}

	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= "From: no-reply@site.ua"; // Заменить домен на домен клиента

	if (!$title && !$phonenum) {
	} else {
		mail($to,"New lead(site)",$message,$headers); // Заменить домен на домен клиента
	}
?>