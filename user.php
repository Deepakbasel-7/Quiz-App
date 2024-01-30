
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
    font-family: 'Arial, sans-serif';
    background-color: #2b2b2b;
;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 20px auto;
}

.category-buttons {
    text-align: center;
}

.category-button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 15px 20px;
    font-size: 1em;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    cursor: pointer;
    margin: 100px;
}

.category-button:hover {
    background-color: #0056b3;
}
h1{
    color: white;
}

/* Add additional styling as needed */

    </style>
<body>
<form action="quiz.php" method="post" id="categoryForm">
    <div class="category-buttons">
        <h1>Choose your category:</h1>
        <?php
        include_once('conn.php');

        $sqlCategories = "SELECT * FROM categories";
        $resCategories = mysqli_query($conn, $sqlCategories);

        if (mysqli_num_rows($resCategories)) {
            while ($rowCategory = mysqli_fetch_assoc($resCategories)) {
                ?>
                <button class="category-button" onclick="selectCategory('<?php echo $rowCategory['cat']; ?>')">
                    <?php echo $rowCategory['cat']; ?>
                </button>
                <?php
            }
        }
        ?>
        <!-- Hidden input field to store the selected category -->
        <input type="hidden" name="selectedCategory" id="selectedCategory">
    </div>
    <!-- Include a submit button to trigger the form submission -->
    <button type="submit" style="display:none;"></button>
</form>

</body>
<script>
    function selectCategory(category) {
        document.getElementById("selectedCategory").value = category;
        document.getElementById("categoryForm").submit();
    }
</script>
</html>
