<?php 
    // echo '<h1>Hello,</h1>' . 'Devs! <br>';
    // echo 'Welcome to PHP class';

    $name = 'John';
    $isMarried = true;
    $age = 0;
    // echo 'Welcome,'. $name;
    // echo "<h3>Welcome, $name </h3>";

    // echo 'My name is ' . $name . '. I am ' . $age . 'years old.';
    // echo '<br>';
    // echo "My name $name. I am $age years old";

    // if ($isMarried && $age > 18){
    //     echo "$name is Married and old enough";

    // }
    // elseif ($isMarried && $age < 18){
    //     echo "$name is Married and not old enough";
    // }
    // else{
    //     echo "$name is not married";
    // }
    // echo '<br>';

    // index array
    $students = ['Kemi', 'Lola', 'Shola', 'Ade'];
    // print_r($students);
    // echo $students[0];

    // array_shift($students);
    // array_pop($students);
    // array_unshift($students, 'Tunde');
    // $new = array_slice($students, 0, 2);
    // print_r($new);

    // associative array 
    $student = [
        'name' => 'Kemi',
        'age' => 20,
        'isMarried' => false
    ];

    // print_r($student)
    // echo $student['name'];

    // multidimentional array
    $students = [
        ['name' => 'Kemi', 'age' => 20],
        ['name' => 'Lola', 'age' => 25],
        ['name' => 'Shola', 'age' => 30]
    ];

    $name = $students[2]['name'];
    $age = $students[2]['age'];
    // echo "$name is $age years old";

    
    

    // for($i = 0; $i < count($students); $i++){
    //     // echo $i . '<br>';
    //     $name = $students[$i]['name'];
    //     $age = $students[$i]['age'];
    //     echo "<h3>$name is  $age years old</h3> <br>";
    // };

    $customers = [
        [
            'customer' => 'Kemi', 
            'amount' => 2000, 
            'items' =>['toothpaste', 'Noodles']
        ],
        [
            'customer' => 'Lola',
            'amount' => 5000,
            'items' => ['Bread', 'Lipstick', 'Shampoo']
        ],
        [
            'customer' => 'Segun',
            'amount' => 1000,
            'items' => ['Razor', 'Soap']
        ]
   
    ];

    // for ($i=0; $i < count($customers); $i++) { 
    //     // print_r($customers[$i]);
    //     // echo '<br>';
    //     $customer = $customers[$i]['customer'];
    //     $amount = $customers[$i]['amount'];
    //     $items = $customers[$i]['items'];
    //     echo "<div>
    //         <p><b>Customer:</b> $customer</p>
    //         <p><b>Amount:</b> $amount</p>
    //         </div>
    //         <p><b>Items:</b></p>
            
    //     ";

    //     for ($x=0; $x < count($items); $x++) { 
    //         $item = $items[$x];
    //         echo "<p>$item</p>" ;
    //     };
    //     echo '<hr>';

    // }


    $items= ['Kemi', 'Lola', 'Shola', 'Ade'];

    // foreach($items as $itm){
    //     echo "$itm <br>";
    // }

    // CRUD = create, read, update, delete 

    function callme($name){
        return "Hello, $name <br>";
    }

    // callme('Dami')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($items as $itm) {?>
        <h4><?php echo $itm ?> </h4>
    <?php }?>

    <h1><?php echo callme('Dami') ?></h1>
</body>
</html>