<html>
<head>
    <title>Kalkulator_BMI</title>
</head>
<body>
    <form method="POST" action= "">
        Podaj płeć:
        <input type="radio" value= "m" name="plec"/>Mężczyzna
        <input type="radio" value= "k" name="plec"/>Kobieta
        <br><br>Podaj wzrost:
        <input type="text" name="wzrost"/>
        <br><br>
        Podaj wagę:
        <input type="text" name="waga"/>
        <br><br>Podaj wiek:
        <input type="text" name="wiek"/>
        <br><br>Poziom aktywności fizycznej:
        <br>
        <select name="aktywnosc">
            <option name="aktywnosc1" value="aktywnosc1">Brak aktywności</option>
            <option name="aktywnosc2" value="aktywnosc2">Bardzo lekka aktywność (1 dzień w tygodniu)</option>
            <option name="aktywnosc3" value="aktywnosc3">Lekka aktywność (2-3 dni w tygodniu)</option>
            <option name="aktywnosc4" value="aktywnosc4">Średnia aktywność (4-5 dni w tygodniu)</option>
            <option name="aktywnosc5" value="aktywnosc5">Duża aktywność (codziennie)</option>
            <option name="aktywnosc6" value="aktywnosc6">Bardzo duża aktywność</option>
        </select>
        <br>
        <input type="submit" value= "Zapisz i oblicz" name="submit"/>
    </form>
    <?php
    $akt = "";
    $CPM = 0;
    $PAL=0;
    $aktywnosc=$_POST['aktywnosc'];
    $wzrost=$_POST['wzrost'];
    $waga=$_POST['waga'];
    $wiek=$_POST['wiek'];
    $plec=$_POST['plec'];

    function calculateBMI($waga,$wzrost)
    {
        return round($waga / (($wzrost / 100) ** 2), 2);
    }
    function calculatePPM($waga,$wzrost,$wiek)
    {
        return round((10*$waga)+(6.25*$wzrost)-(5*$wiek)+5);

    }
    function calculateCPM($PAL,$PPM)
    {
        return round($PPM*$PAL);
    }

    $PPM = calculatePPM($waga,$wzrost,$wiek);
    $bmi = calculateBMI($waga,$wzrost);
    echo "Twoje BMI wynosi: ".$bmi;
    echo "Twoje PPM wynosi: ".$PPM;

    if($plec == "m")
    {
        if($aktywnosc == "aktywnosc1")
		{
			$PAL = 1.2;
			$akt = "Brak aktywności";
		}
		else if($aktywnosc == "aktywnosc2")
		{
			$PAL = 1.3;
			$akt = "Bardzo lekka aktywność (1 dzień w tygodniu)";
		}
		else if($aktywnosc == "akttwnosc3")
		{
			$PAL = 1.6;
			$akt = "Lekka aktywność (2-3 dni w tygodniu)";
		}
		else if($aktywnosc == "aktywnosc4")
		{
			$PAL = 1.7;
			$akt = "Średnia aktywność (4-5 dni w tygodniu)";
		}
		else if($aktywnosc == "aktywnosc5")
		{
			$PAL = 2.1;
			$akt = "Duża aktywność (codziennie)";
		}
		else if($aktywnosc == "aktywnosc6")
		{
			$PAL = 2.4;
			$akt = "Bardzo duża aktywność";
		}
	}
    else if($plec == "k")
	{
		if($aktywnosc == "aktywnosc1")
		{
			$PAL = 1.2;
			$akt = "Brak aktywności";
		}
		else if($aktywnosc == "aktywnosc2")
		{
			$PAL = 1.3;
			$akt = "Bardzo lekka aktywność (1 dzień w tygodniu)";
		}
		else if($aktywnosc == "aktywnosc3")
		{
			$PAL = 1.5;
			$akt = "Lekka aktywność (2-3 dni w tygodniu)";
		}
		else if($aktywnosc == "aktywnosc4")
		{
			$PAL = 1.6;
			$akt = "Średnia aktywność (4-5 dni w tygodniu)";
		}
		else if($aktywnosc == "aktywnosc5")
		{
			$PAL = 1.9;
			$akt = "Duża aktywność (codziennie)";
		}
		else if($aktywnosc == "aktywnosc6")
		{
			$PAL = 2.2;
			$akt = "Bardzo duża aktywność";
		}
	}

    $CPM = calculateCPM($PAL,$PPM);
    echo "Twoje CPM wynosi: ".$CPM."";

    $polaczenie = new mysqli('localhost', 'root', '', 'bmi_test2');
    $query = "INSERT INTO raporty values ('$wzrost', '$waga', '$wiek', '$plec','$bmi','$akt')";
    $result = mysqli_query($polaczenie,$query);
    if($bmi<16)
	{
		echo "	Wygłodzenie!";
	}
	else if($bmi>=16 && $bmi<=16.99)
	{
		echo "	Wychudzenie!";
	}
	else if($bmi>=17 && $bmi<=24.99)
	{
		echo "	Waga prawidłowa";
	}
	else if($bmi>=25 && $bmi<=29.99)
	{
		echo "	Nadwaga!";
	}
	else if($bmi>=30 && $bmi<=34.99)
	{
		echo "	I stopień otyłości";
	}
	else if($bmi>=35 && $bmi<=39.99)
	{
		echo "	II stopień otyłości";
	}
	else if($bmi>=40)
	{
		echo "	Otyłość skrajna!";
	}


    ?>
    
</body>
</html>