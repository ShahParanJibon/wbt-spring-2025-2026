//1 no
<?php
$length = 10;
$width = 5;
$area=$length * $width;
$perimeter = 2*($length+$width);

echo "Area = " . $area . "<br>";
echo "Perimeter = " . $perimeter . "<br>";

//2 no
$amount = 1000;
$vat = $amount * 0.15;

echo "Amount = " . $amount . "<br>";
echo "VAT (15%) = " . $vat . "<br>";

//3 no
$number = 7;

if ($number % 2 == 0) 
{
    echo $number . " is Even<br>";
} 
else 
{
    echo $number . " is Odd<br>";
}

//4 no
$a = 15;
$b = 25;
$c = 10;

if ($a >= $b && $a >= $c) 
{
    echo"Largest Number = " . $a . "<br>";
} 
elseif ($b >= $a && $b >= $c) 
{
    echo"Largest Number = " . $b . "<br>";
} 
else 
{
    echo"Largest Number = " . $c . "<br>";
}

//5 no
for ($i=10; $i<=100; $i++) 
{
    if ($i % 2 != 0) 
    {
        echo $i ." ";
    }
}
echo "<br>";

$arr = array(5,10,15,20,25);
$search = 20;

for ($i = 0; $i < count($arr); $i++) 
{
    if ($arr[$i] == $search) 
    {
        echo "Element found<br>";
        break;
    } 
}

for ($i=1; $i<=3; $i++) 
{        
    for ($j=1; $j<=$i; $j++)
    {   
        echo "* ";
    }
    echo "<br>";  
}

echo "<br>";

for ($i=3; $i>=0; $i--) 
{        
    for ($j=1; $j<=$i; $j++)
    {   
        echo "* ";
    }
    echo "<br>";  
}

echo "<br>";


$char = 'A';
for ($i=1; $i<=3; $i++) 
{        
    for ($j=1; $j<=$i; $j++)
    {   
        echo "$char ";
        $char++;
    }
    echo "<br>";  
}


?>

