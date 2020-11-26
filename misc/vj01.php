<html>
    <head>
        <meta charset="utf-8" />
        <title>Ovo je neki naslov</title>
    </head>
<body>
<?php
$broj = 10;

/* Provjera preko IF iskaza */
if ($broj > 10) {
    print("Broj je veći od 10.");
} else if ($broj < 10) {
    print("Broj je manji od 10.");
} else {
    print("Broj je jednak 10.");
}

/* Provjera preko switch case iskaza */
switch ($broj) {
    case 10:
        echo("Broj je 10");
        break;
    default:
        echo("Broj nije 10");
}

/* Korištenje for petlje */
for ($i=0; $i < 10; $i++){
    echo("<br />");
    echo("Ovo je broj " . ($i+1));
}

/* Korištenje do-while petlje */
$idx = 0;
do {
    echo ("<br />");
    echo ("Ovo je broj " . $idx);
    $idx++;
} while($idx < 10);

/* 
$niz = array(
    "kljuc" => "Ovo je string", 1, 2.3, true
);
*/

$niz = array(
    "Ovo je string", 1, 2.3, true
);

for ($i=0;$i<count($niz);$i++){
    print($niz[$i]);
    print("<br />");
}

foreach ($niz as $el){
    print($el);
    print("<br />");
}

function  zbroj ($niz) {
    $sum = 0;
    foreach ($niz as $broj) {
        $sum += $broj;
    }
    return $sum;
}

echo(zbroj (array(1,2,3,4,5)));

print(
    $_GET["kljuc1"]
);

?>
<body>
</html>