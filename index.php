<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css"> 
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php include 'php/main.php'?>
    <title>English</title>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <p class="navbar-total-vocab"><?php TotalVocab(); ?></p>
            <p class="navbar-addvocab">Add Vocab</p>
        </div>
    </div>
    <div class="container">
        <!-- <div class="container-vocab">
            <div class="container-vocab-top">
                <h2 class="vocabulary">General</h2>
                <p class="typevocab">(N)</p>
                <p class="speling">/123/</p>
                <p class="mean">Chung</p>
            </div>
            <div class="container-vocab-mid">
                <p class="example">His general knowledge is good although he is not good at mathematics.</p>
                <p class="mean-example">Kiến thức chung của anh ấy là tốt mặc dù anh ấy không giỏi toán học</p>
            </div>
            <div class="container-vocab-bottom">
                <div class="like" onclick="">
                    <div class="icon" icon="like"></div>
                    <span>1</span>
                </div>
                <span class="date">9 days</span>
            </div>
        </div> -->
        <?php Select2(); ?>
    </div>
</body>
</html>