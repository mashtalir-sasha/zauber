<?
	if(isset ($_POST['title'])) {$title=$_POST['title'];}
	if(isset ($_POST['name'])) {$fio=$_POST['name'];}
	if(isset ($_POST['phone'])) {$phonenum=$_POST['phone'];}

	if(isset ($_POST['step1'])) {$step1=$_POST['step1'];}
	if(isset ($_POST['step2'])) {$step2=$_POST['step2'];}
	if(isset ($_POST['step3'])) {$step3=$_POST['step3'];}
	if(isset ($_POST['step4'])) {$step4=$_POST['step4'];}
	if(isset ($_POST['step5'])) {$step5=$_POST['step5'];}

	$to = "zaubergroup@gmail.com"; // Замениь на емаил клиента

	$message = "Форма: $title <br><br>";
	if ( $fio || $phonenum || $step1 || $step2 || $step3 || $step4 || $step5 ) {
		$message .= ""
			. ( $fio ?" Имя:  $fio <br>" : "")
			. ( $phonenum ?" Телефон:  $phonenum <br><br>" : "")
			. ( $step1  ? " Выберите (укажите) возраст: $step1 <br>" : "")
			. ( $step2  ? " Вы ранее занимались танцами?: $step2 <br>" : "")
			. ( $step3  ? " Какие танцы Вам больше всего нравятся?: $step3 <br>" : "")
			. ( $step4  ? " Какой абонемент Вам больше всего подойдет?: $step4 <br>" : "")
			. ( $step5  ? " Где Вам удобнее всего заниматься?: $step5 <br>" : "");
	}

	$dopInfo = "Форма: $title \n\n";
	if ( $step1 || $step2 || $step3 || $step4 || $step5 || $step6 ) {
		$dopInfo .= ""
			. ( $step1  ? " Сколько Вам/ребенку лет?: $step1 \n" : "")
			. ( $step2  ? " Вы ранее занимались танцами?: $step2 \n" : "")
			. ( $step3  ? " Какие танцы Вам больше всего нравятся?: $step3 \n" : "")
			. ( $step4  ? " Какую цель Вы преследуете, занимаясь танцами?: $step4 \n" : "")
			. ( $step5  ? " Какой абонемент Вам больше всего подойдет?: $step5 \n" : "")
			. ( $step6  ? " Где Вам удобнее всего заниматься?: $step6 \n" : "");
	}

	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= "From: no-reply@zauber.sumy.ua"; // Заменить домен на домен клиента

	if (!$title && !$phonenum) {
	} else {
		mail($to,"New lead(zauber.sumy.ua)",$message,$headers); // Заменить домен на домен клиента

		require_once __DIR__ . '/vendor/autoload.php';
		$googleAccountKeyFilePath = __DIR__ . '/assets/zauber-sumy-ua-6fcc29d99c67.json';
		putenv( 'GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath );
		$client = new Google_Client();
		$client->useApplicationDefaultCredentials();
		$client->addScope( 'https://www.googleapis.com/auth/spreadsheets' );
		$service = new Google_Service_Sheets( $client );
		$spreadsheetId = '1nmAM1E-9u6ofb7Yj8fnx-8f9bdrGUFS1t5NiT0qghSw';

		date_default_timezone_set('UTC+3');
		$date = date('d.m.Y h:i');

		$values = [
			["$date", "$fio", "$phonenum", "$dopInfo"]
		];

		$body    = new Google_Service_Sheets_ValueRange( [ 'values' => $values ] );
		$options = array( 'valueInputOption' => 'RAW' );
		$service->spreadsheets_values->append( $spreadsheetId, 'Лиды!A2', $body, $options );
	}
?>